<?php
// CLP Admin Panel - Sponsored Center Form (Add / Edit).
//
// Creates and edits a single centre record in the shared centres table
// (mdl_local_centermanagement_centers) which powers the public
// "Your Sponsored Center(s)" page at /school-info.php. Mirrors the other
// dashboard record forms: grouped fields with server-side validation for
// required fields, email format and a unique centre code. Date fields are
// stored as UNIX timestamps, matching the public page's date() rendering.

require_once __DIR__ . '/includes/auth.php';

define('CLP_CENTERS_TABLE', 'mdl_local_centermanagement_centers');

$page_title = 'Sponsored Center Form';

$db = clp_db_connect();

$record = [
    'id' => '',
    'center_code' => '',
    'center_name' => '',
    'school_name' => '',
    'center_type' => 'clc',
    'division' => '',
    'district' => '',
    'upazila' => '',
    'address' => '',
    'contact_person' => '',
    'contact_number' => '',
    'email' => '',
    'establishment_date' => '',
    'start_date' => '',
    'support' => '',
    'sponsor_name' => '',
    'devices_count' => 0,
    'students_count' => 0,
    'status' => 1,
    'description' => '',
];

$isEdit = false;

// --- Load existing record for edit. ---
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("SELECT * FROM " . CLP_CENTERS_TABLE . " WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    if ($row = clp_stmt_fetch_assoc($stmt)) {
        $record = $row;
        $record['establishment_date'] = !empty($row['establishment_date']) ? date('Y-m-d', (int)$row['establishment_date']) : '';
        $record['start_date'] = !empty($row['start_date']) ? date('Y-m-d', (int)$row['start_date']) : '';
        $isEdit = true;
    } else {
        $stmt->close();
        $db->close();
        clp_set_error('Center record not found.');
        clp_redirect(CLP_ADMIN_URL . '/centers.php');
    }
    $stmt->close();
}

$errors = [];

// --- Handle submit. ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!clp_verify_csrf($_POST['csrf_token'] ?? '')) {
        clp_set_error('Invalid security token. Please try again.');
    } else {
        $record['id'] = (int)($_POST['id'] ?? 0);
        $record['center_code'] = clp_sanitize($_POST['center_code'] ?? '');
        $record['center_name'] = clp_sanitize($_POST['center_name'] ?? '');
        $record['school_name'] = clp_sanitize($_POST['school_name'] ?? '');
        $record['center_type'] = clp_sanitize($_POST['center_type'] ?? 'clc');
        $record['division'] = clp_sanitize($_POST['division'] ?? '');
        $record['district'] = clp_sanitize($_POST['district'] ?? '');
        $record['upazila'] = clp_sanitize($_POST['upazila'] ?? '');
        $record['address'] = clp_sanitize($_POST['address'] ?? '');
        $record['contact_person'] = clp_sanitize($_POST['contact_person'] ?? '');
        $record['contact_number'] = clp_sanitize($_POST['contact_number'] ?? '');
        $record['email'] = clp_sanitize($_POST['email'] ?? '');
        $record['support'] = clp_sanitize($_POST['support'] ?? '');
        $record['sponsor_name'] = clp_sanitize($_POST['sponsor_name'] ?? '');
        $record['devices_count'] = (int)($_POST['devices_count'] ?? 0);
        $record['students_count'] = (int)($_POST['students_count'] ?? 0);
        $record['status'] = (int)($_POST['status'] ?? 1);
        $record['description'] = clp_sanitize($_POST['description'] ?? '');

        // Raw date values (controlled format); sanitising would alter them.
        $estDate = trim($_POST['establishment_date'] ?? '');
        $startDate = trim($_POST['start_date'] ?? '');

        // --- Server-side validation. ---
        if ($record['center_code'] === '') {
            $errors['center_code'] = 'Center code is required.';
        } elseif (!preg_match('/^[A-Za-z0-9\-]+$/', $record['center_code'])) {
            $errors['center_code'] = 'Use letters, numbers and dashes only (e.g. CLC-DHK-001).';
        } else {
            // Ensure the code is unique (excluding the record being edited).
            $check = $db->prepare("SELECT COUNT(*) AS c FROM " . CLP_CENTERS_TABLE . " WHERE center_code = ? AND id <> ?");
            $check->bind_param("si", $record['center_code'], $record['id']);
            $check->execute();
            $exists = (int)(clp_stmt_fetch_assoc($check)['c'] ?? 0);
            $check->close();
            if ($exists > 0) {
                $errors['center_code'] = 'This center code is already in use.';
            }
        }
        if ($record['center_name'] === '') {
            $errors['center_name'] = 'Center name is required.';
        }
        if (!in_array($record['center_type'], ['clc', 'scr'], true)) {
            $errors['center_type'] = 'Please select a valid center type.';
        }
        if (!in_array($record['status'], [0, 1], true)) {
            $record['status'] = 1;
        }
        if ($record['email'] !== '' && !filter_var($record['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Please enter a valid email address.';
        }
        if ($record['contact_number'] !== '') {
            $mobileClean = preg_replace('/[\s\-\(\)]/', '', $record['contact_number']);
            if (!preg_match('/^\+?[0-9]{10,15}$/', $mobileClean)) {
                $errors['contact_number'] = 'Please enter a valid phone number (10–15 digits).';
            }
        }
        if ($record['devices_count'] < 0) {
            $record['devices_count'] = 0;
        }
        if ($record['students_count'] < 0) {
            $record['students_count'] = 0;
        }

        $estTs = 0;
        if ($estDate !== '') {
            $estTs = strtotime($estDate);
            if ($estTs === false) {
                $errors['establishment_date'] = 'Please enter a valid date.';
            }
        }
        $startTs = 0;
        if ($startDate !== '') {
            $startTs = strtotime($startDate);
            if ($startTs === false) {
                $errors['start_date'] = 'Please enter a valid date.';
            }
        }

        if (empty($errors)) {
            $now = time();

            if (!empty($record['id'])) {
                $stmt = $db->prepare(
                    "UPDATE " . CLP_CENTERS_TABLE . " SET
                        center_code=?, center_name=?, school_name=?, center_type=?, division=?, district=?,
                        upazila=?, address=?, contact_person=?, contact_number=?, email=?, establishment_date=?,
                        start_date=?, support=?, sponsor_name=?, devices_count=?, students_count=?, status=?,
                        description=?, timemodified=?
                     WHERE id=?"
                );
                $stmt->bind_param(
                    "sssssssssssiiisssiiii",
                    $record['center_code'], $record['center_name'], $record['school_name'], $record['center_type'],
                    $record['division'], $record['district'], $record['upazila'], $record['address'],
                    $record['contact_person'], $record['contact_number'], $record['email'], $estTs,
                    $startTs, $record['support'], $record['sponsor_name'], $record['devices_count'],
                    $record['students_count'], $record['status'], $record['description'], $now, $record['id']
                );
                $ok = $stmt->execute();
                $stmt->close();
                if ($ok) {
                    clp_set_success('Center record updated successfully.');
                    $db->close();
                    clp_redirect(CLP_ADMIN_URL . '/centers.php');
                } else {
                    clp_set_error('Failed to update center record.');
                }
            } else {
                $stmt = $db->prepare(
                    "INSERT INTO " . CLP_CENTERS_TABLE . "
                        (center_code, center_name, school_name, center_type, division, district, upazila, address,
                         contact_person, contact_number, email, establishment_date, start_date, support, sponsor_name,
                         devices_count, students_count, status, description, timecreated, timemodified, usermodified)
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
                );
                $usermodified = 1;
                $stmt->bind_param(
                    "sssssssssssiiisssiii",
                    $record['center_code'], $record['center_name'], $record['school_name'], $record['center_type'],
                    $record['division'], $record['district'], $record['upazila'], $record['address'],
                    $record['contact_person'], $record['contact_number'], $record['email'], $estTs,
                    $startTs, $record['support'], $record['sponsor_name'], $record['devices_count'],
                    $record['students_count'], $record['status'], $record['description'], $now, $now, $usermodified
                );
                $ok = $stmt->execute();
                $stmt->close();
                if ($ok) {
                    clp_set_success('Center record created successfully.');
                    $db->close();
                    clp_redirect(CLP_ADMIN_URL . '/centers.php');
                } else {
                    clp_set_error('Failed to create center record.');
                }
            }
        } else {
            clp_set_error('Please correct the highlighted fields.');
        }
    }
}

// Distinct districts for the datalist helper.
$districtList = [];
if ($res = $db->query("SELECT DISTINCT district FROM " . CLP_CENTERS_TABLE . " WHERE district <> '' ORDER BY district ASC")) {
    while ($r = $res->fetch_assoc()) {
        $districtList[] = $r['district'];
    }
}

$db->close();

include __DIR__ . '/includes/header.php';
?>

<div class="content-area">
    <?php $error = clp_get_message('clp_error'); ?>
    <?php if ($error): ?>
        <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> <?php echo clp_escape($error); ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-building"></i> <?php echo $isEdit ? 'Edit Sponsored Center' : 'Add New Sponsored Center'; ?></h3>
            <a href="<?php echo CLP_ADMIN_URL; ?>/centers.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to List</a>
        </div>

        <form method="POST" action="" class="clc-form" novalidate>
            <input type="hidden" name="csrf_token" value="<?php echo clp_csrf_token(); ?>">
            <input type="hidden" name="id" value="<?php echo (int)($record['id'] ?: 0); ?>">

            <!-- Identity -->
            <div class="clc-form-section">
                <h4 class="clc-form-section-title"><i class="fas fa-id-badge"></i> Identity</h4>
                <div class="clc-form-row">
                    <div class="form-group">
                        <label class="form-label">Center Code *</label>
                        <input type="text" name="center_code" class="form-control <?php echo isset($errors['center_code']) ? 'is-invalid' : ''; ?>" value="<?php echo clp_escape($record['center_code']); ?>" placeholder="e.g. CLC-DHK-001" maxlength="255" autocomplete="off">
                        <?php if (isset($errors['center_code'])): ?><div class="clc-error"><?php echo clp_escape($errors['center_code']); ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Center Name *</label>
                        <input type="text" name="center_name" class="form-control <?php echo isset($errors['center_name']) ? 'is-invalid' : ''; ?>" value="<?php echo clp_escape($record['center_name']); ?>" maxlength="255">
                        <?php if (isset($errors['center_name'])): ?><div class="clc-error"><?php echo clp_escape($errors['center_name']); ?></div><?php endif; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">School Name</label>
                    <input type="text" name="school_name" class="form-control" value="<?php echo clp_escape($record['school_name']); ?>" maxlength="255">
                </div>
                <div class="clc-form-row">
                    <div class="form-group">
                        <label class="form-label">Center Type *</label>
                        <select name="center_type" class="form-control <?php echo isset($errors['center_type']) ? 'is-invalid' : ''; ?>">
                            <option value="clc" <?php echo $record['center_type'] === 'clc' ? 'selected' : ''; ?>>Computer Literacy Center (CLC)</option>
                            <option value="scr" <?php echo $record['center_type'] === 'scr' ? 'selected' : ''; ?>>Smart Classroom (SCR)</option>
                        </select>
                        <?php if (isset($errors['center_type'])): ?><div class="clc-error"><?php echo clp_escape($errors['center_type']); ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="1" <?php echo (int)$record['status'] === 1 ? 'selected' : ''; ?>>Enabled (visible on website)</option>
                            <option value="0" <?php echo (int)$record['status'] === 0 ? 'selected' : ''; ?>>Disabled (hidden from website)</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Location -->
            <div class="clc-form-section">
                <h4 class="clc-form-section-title"><i class="fas fa-map-marker-alt"></i> Location</h4>
                <div class="clc-form-row">
                    <div class="form-group">
                        <label class="form-label">Division</label>
                        <input type="text" name="division" class="form-control" value="<?php echo clp_escape($record['division']); ?>" maxlength="255" list="center-divisions">
                    </div>
                    <div class="form-group">
                        <label class="form-label">District</label>
                        <input type="text" name="district" class="form-control" value="<?php echo clp_escape($record['district']); ?>" maxlength="255" list="center-districts">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Upazila</label>
                        <input type="text" name="upazila" class="form-control" value="<?php echo clp_escape($record['upazila']); ?>" maxlength="255">
                    </div>
                </div>
                <datalist id="center-districts">
                    <?php foreach ($districtList as $d): ?>
                        <option value="<?php echo clp_escape($d); ?>"></option>
                    <?php endforeach; ?>
                </datalist>
                <div class="form-group">
                    <label class="form-label">Address</label>
                    <textarea name="address" class="form-control" rows="2" maxlength="1000"><?php echo clp_escape($record['address']); ?></textarea>
                </div>
            </div>

            <!-- Dates & Support -->
            <div class="clc-form-section">
                <h4 class="clc-form-section-title"><i class="fas fa-calendar-alt"></i> Dates & Support</h4>
                <div class="clc-form-row">
                    <div class="form-group">
                        <label class="form-label">Establishment Date</label>
                        <input type="date" name="establishment_date" class="form-control <?php echo isset($errors['establishment_date']) ? 'is-invalid' : ''; ?>" value="<?php echo clp_escape($record['establishment_date']); ?>">
                        <?php if (isset($errors['establishment_date'])): ?><div class="clc-error"><?php echo clp_escape($errors['establishment_date']); ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Start Date</label>
                        <input type="date" name="start_date" class="form-control <?php echo isset($errors['start_date']) ? 'is-invalid' : ''; ?>" value="<?php echo clp_escape($record['start_date']); ?>">
                        <?php if (isset($errors['start_date'])): ?><div class="clc-error"><?php echo clp_escape($errors['start_date']); ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Support</label>
                        <select name="support" class="form-control">
                            <option value="">Select…</option>
                            <?php foreach (['maintained', 'activated', 'reactivated', 'supported'] as $s): ?>
                                <option value="<?php echo $s; ?>" <?php echo strtolower($record['support'] ?? '') === $s ? 'selected' : ''; ?>><?php echo ucfirst($s); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Sponsor & Contact -->
            <div class="clc-form-section">
                <h4 class="clc-form-section-title"><i class="fas fa-hand-holding-heart"></i> Sponsor & Contact</h4>
                <div class="form-group">
                    <label class="form-label">Sponsor Name</label>
                    <input type="text" name="sponsor_name" class="form-control" value="<?php echo clp_escape($record['sponsor_name']); ?>" maxlength="1000">
                </div>
                <div class="clc-form-row">
                    <div class="form-group">
                        <label class="form-label">Contact Person</label>
                        <input type="text" name="contact_person" class="form-control" value="<?php echo clp_escape($record['contact_person']); ?>" maxlength="255">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Contact Number</label>
                        <input type="text" name="contact_number" class="form-control <?php echo isset($errors['contact_number']) ? 'is-invalid' : ''; ?>" value="<?php echo clp_escape($record['contact_number']); ?>" maxlength="50">
                        <?php if (isset($errors['contact_number'])): ?><div class="clc-error"><?php echo clp_escape($errors['contact_number']); ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>" value="<?php echo clp_escape($record['email']); ?>" maxlength="254">
                        <?php if (isset($errors['email'])): ?><div class="clc-error"><?php echo clp_escape($errors['email']); ?></div><?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Stats & Description -->
            <div class="clc-form-section">
                <h4 class="clc-form-section-title"><i class="fas fa-chart-bar"></i> Stats & Description</h4>
                <div class="clc-form-row">
                    <div class="form-group">
                        <label class="form-label">Devices Count</label>
                        <input type="number" name="devices_count" min="0" class="form-control" value="<?php echo (int)$record['devices_count']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Students Count</label>
                        <input type="number" name="students_count" min="0" class="form-control" value="<?php echo (int)$record['students_count']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4" maxlength="4000"><?php echo clp_escape($record['description']); ?></textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save Center</button>
            <a href="<?php echo CLP_ADMIN_URL; ?>/centers.php" class="btn btn-primary">Cancel</a>
        </form>
    </div>
</div>

<style>
.clc-form { padding: 20px; }
.clc-form-section { margin-bottom: 26px; padding-bottom: 8px; border-bottom: 1px solid #eef0f4; }
.clc-form-section:last-of-type { border-bottom: 0; }
.clc-form-section-title { font-size: 15px; color: #006b4f; margin: 0 0 16px; display: flex; align-items: center; gap: 8px; }
.clc-form-row { display: flex; flex-wrap: wrap; gap: 16px; }
.clc-form-row .form-group { flex: 1; min-width: 200px; }
.clc-error { color: #b82b00; font-size: 12px; margin-top: 5px; }
.form-control.is-invalid { border-color: #b82b00; box-shadow: 0 0 0 3px rgba(184,43,0,.1); }
</style>

<?php include __DIR__ . '/includes/footer.php'; ?>
