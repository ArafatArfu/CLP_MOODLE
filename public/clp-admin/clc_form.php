<?php
// CLP Admin Panel - CLC Participant Form (Add / Edit).
//
// Creates and edits a single CLC participant record in the shared CLC table
// (mdl_clp_clc_participants). Mirrors the SkillConnect dashboard record form:
// grouped fields (School / Enrolment date / Personal / Location / Contact),
// with server-side validation for required fields, email and mobile format.
// The enrolment date is stored as `timecreated` (Jan 1 of the chosen year) plus
// a separate `month` column, exactly like the SkillConnect implementation.

require_once __DIR__ . '/includes/auth.php';

define('CLP_CLC_TABLE', 'mdl_clp_clc_participants');

$page_title = 'CLC Participant Form';

$db = clp_db_connect();

$record = [
    'id' => '',
    'name' => '',
    'father_name' => '',
    'mother_name' => '',
    'gender' => '',
    'district' => '',
    'division' => '',
    'upazila' => '',
    'mobile' => '',
    'email' => '',
    'school' => '',
    'month' => (int)date('n'),
    'year' => (int)date('Y'),
];

$isEdit = false;

// --- Load existing record for edit. ---
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("SELECT * FROM " . CLP_CLC_TABLE . " WHERE id = ? AND program = 'clc' LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    if ($row = clp_stmt_fetch_assoc($stmt)) {
        $record = $row;
        $ts = (int)($row['timecreated'] ?? 0);
        $record['year'] = $ts > 0 ? (int)date('Y', $ts) : (int)date('Y');
        $record['month'] = (int)($row['month'] ?? date('n'));
        $isEdit = true;
    } else {
        $stmt->close();
        $db->close();
        clp_set_error('Participant record not found.');
        clp_redirect(CLP_ADMIN_URL . '/clc.php');
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
        $record['name'] = clp_sanitize($_POST['name'] ?? '');
        $record['father_name'] = clp_sanitize($_POST['father_name'] ?? '');
        $record['mother_name'] = clp_sanitize($_POST['mother_name'] ?? '');
        $record['gender'] = clp_sanitize($_POST['gender'] ?? '');
        $record['district'] = clp_sanitize($_POST['district'] ?? '');
        $record['division'] = clp_sanitize($_POST['division'] ?? '');
        $record['upazila'] = clp_sanitize($_POST['upazila'] ?? '');
        $record['mobile'] = clp_sanitize($_POST['mobile'] ?? '');
        $record['email'] = clp_sanitize($_POST['email'] ?? '');
        $record['school'] = clp_sanitize($_POST['school'] ?? '');
        $record['month'] = (int)($_POST['month'] ?? date('n'));
        $record['year'] = (int)($_POST['year'] ?? date('Y'));

        // --- Server-side validation (mirrors SkillConnect rules). ---
        if ($record['name'] === '') {
            $errors['name'] = 'Student name is required.';
        }
        if ($record['school'] === '') {
            $errors['school'] = 'School name is required.';
        }
        if ($record['month'] < 1 || $record['month'] > 12) {
            $errors['month'] = 'Please select a valid month.';
        }
        if ($record['year'] < 2010 || $record['year'] > (int)date('Y') + 1) {
            $errors['year'] = 'Please select a valid year.';
        }
        if ($record['email'] !== '' && !filter_var($record['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Please enter a valid email address.';
        }
        if ($record['mobile'] !== '') {
            $mobileClean = preg_replace('/[\s\-\(\)]/', '', $record['mobile']);
            if (!preg_match('/^\+?[0-9]{10,15}$/', $mobileClean)) {
                $errors['mobile'] = 'Please enter a valid mobile number (10–15 digits).';
            }
        }

        if (empty($errors)) {
            $program = 'clc';
            $timecreated = mktime(0, 0, 0, 1, 1, $record['year']);

            if (!empty($record['id'])) {
                $stmt = $db->prepare("UPDATE " . CLP_CLC_TABLE . " SET name=?, father_name=?, mother_name=?, district=?, division=?, upazila=?, mobile=?, email=?, gender=?, school=?, month=?, timecreated=? WHERE id=? AND program='clc'");
                $stmt->bind_param(
                    "ssssssssssiii",
                    $record['name'], $record['father_name'], $record['mother_name'],
                    $record['district'], $record['division'], $record['upazila'],
                    $record['mobile'], $record['email'], $record['gender'], $record['school'],
                    $record['month'], $timecreated, $record['id']
                );
                $ok = $stmt->execute();
                $stmt->close();
                if ($ok) {
                    clp_set_success('Participant record updated successfully.');
                    $db->close();
                    clp_redirect(CLP_ADMIN_URL . '/clc.php');
                } else {
                    clp_set_error('Failed to update participant record.');
                }
            } else {
                $stmt = $db->prepare("INSERT INTO " . CLP_CLC_TABLE . " (program, name, father_name, mother_name, district, division, upazila, mobile, email, gender, school, month, timecreated) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param(
                    "sssssssssssii",
                    $program, $record['name'], $record['father_name'], $record['mother_name'],
                    $record['district'], $record['division'], $record['upazila'],
                    $record['mobile'], $record['email'], $record['gender'], $record['school'],
                    $record['month'], $timecreated
                );
                $ok = $stmt->execute();
                $stmt->close();
                if ($ok) {
                    clp_set_success('Participant record created successfully.');
                    $db->close();
                    clp_redirect(CLP_ADMIN_URL . '/clc.php');
                } else {
                    clp_set_error('Failed to create participant record.');
                }
            }
        } else {
            clp_set_error('Please correct the highlighted fields.');
        }
    }
}

// Distinct schools for the searchable datalist.
$schoolList = [];
if ($res = $db->query("SELECT DISTINCT school FROM " . CLP_CLC_TABLE . " WHERE program='clc' AND school <> '' ORDER BY school ASC")) {
    while ($r = $res->fetch_assoc()) {
        $schoolList[] = $r['school'];
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
            <h3 class="card-title"><i class="fas fa-user-graduate"></i> <?php echo $isEdit ? 'Edit CLC Participant' : 'Add New CLC Participant'; ?></h3>
            <a href="<?php echo CLP_ADMIN_URL; ?>/clc.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to List</a>
        </div>

        <form method="POST" action="" class="clc-form" novalidate>
            <input type="hidden" name="csrf_token" value="<?php echo clp_csrf_token(); ?>">
            <input type="hidden" name="id" value="<?php echo (int)($record['id'] ?: 0); ?>">

            <!-- School -->
            <div class="clc-form-section">
                <h4 class="clc-form-section-title"><i class="fas fa-school"></i> School</h4>
                <div class="form-group">
                    <label class="form-label">School Name *</label>
                    <input type="text" name="school" list="clc-schools" class="form-control <?php echo isset($errors['school']) ? 'is-invalid' : ''; ?>" value="<?php echo clp_escape($record['school']); ?>" placeholder="Search or type a school name" autocomplete="off" maxlength="200">
                    <datalist id="clc-schools">
                        <?php foreach ($schoolList as $s): ?>
                            <option value="<?php echo clp_escape($s); ?>"></option>
                        <?php endforeach; ?>
                    </datalist>
                    <small style="color:#6a737b;">Start typing to search existing schools, or type a new name if it is not listed.</small>
                    <?php if (isset($errors['school'])): ?><div class="clc-error"><?php echo clp_escape($errors['school']); ?></div><?php endif; ?>
                </div>
            </div>

            <!-- Enrolment date -->
            <div class="clc-form-section">
                <h4 class="clc-form-section-title"><i class="fas fa-calendar-alt"></i> Enrolment Date</h4>
                <div class="clc-form-row">
                    <div class="form-group">
                        <label class="form-label">Month *</label>
                        <select name="month" class="form-control <?php echo isset($errors['month']) ? 'is-invalid' : ''; ?>">
                            <?php for ($m = 1; $m <= 12; $m++): ?>
                                <option value="<?php echo $m; ?>" <?php echo (int)$record['month'] === $m ? 'selected' : ''; ?>><?php echo date('F', mktime(0, 0, 0, $m, 1)); ?></option>
                            <?php endfor; ?>
                        </select>
                        <?php if (isset($errors['month'])): ?><div class="clc-error"><?php echo clp_escape($errors['month']); ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Year *</label>
                        <select name="year" class="form-control <?php echo isset($errors['year']) ? 'is-invalid' : ''; ?>">
                            <?php for ($y = (int)date('Y') + 1; $y >= 2010; $y--): ?>
                                <option value="<?php echo $y; ?>" <?php echo (int)$record['year'] === $y ? 'selected' : ''; ?>><?php echo $y; ?></option>
                            <?php endfor; ?>
                        </select>
                        <?php if (isset($errors['year'])): ?><div class="clc-error"><?php echo clp_escape($errors['year']); ?></div><?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Personal details -->
            <div class="clc-form-section">
                <h4 class="clc-form-section-title"><i class="fas fa-user"></i> Personal Details</h4>
                <div class="form-group">
                    <label class="form-label">Student Name *</label>
                    <input type="text" name="name" class="form-control <?php echo isset($errors['name']) ? 'is-invalid' : ''; ?>" value="<?php echo clp_escape($record['name']); ?>" maxlength="200">
                    <?php if (isset($errors['name'])): ?><div class="clc-error"><?php echo clp_escape($errors['name']); ?></div><?php endif; ?>
                </div>
                <div class="clc-form-row">
                    <div class="form-group">
                        <label class="form-label">Father's Name</label>
                        <input type="text" name="father_name" class="form-control" value="<?php echo clp_escape($record['father_name']); ?>" maxlength="200">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Mother's Name</label>
                        <input type="text" name="mother_name" class="form-control" value="<?php echo clp_escape($record['mother_name']); ?>" maxlength="200">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Gender</label>
                    <select name="gender" class="form-control">
                        <option value="">Select one…</option>
                        <?php foreach (['Male', 'Female', 'Other'] as $g): ?>
                            <option value="<?php echo $g; ?>" <?php echo $record['gender'] === $g ? 'selected' : ''; ?>><?php echo $g; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Location -->
            <div class="clc-form-section">
                <h4 class="clc-form-section-title"><i class="fas fa-map-marker-alt"></i> Location</h4>
                <div class="clc-form-row">
                    <div class="form-group">
                        <label class="form-label">District</label>
                        <input type="text" name="district" class="form-control" value="<?php echo clp_escape($record['district']); ?>" maxlength="100">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Division</label>
                        <input type="text" name="division" class="form-control" value="<?php echo clp_escape($record['division']); ?>" maxlength="100">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Upazila</label>
                        <input type="text" name="upazila" class="form-control" value="<?php echo clp_escape($record['upazila']); ?>" maxlength="100">
                    </div>
                </div>
            </div>

            <!-- Contact -->
            <div class="clc-form-section">
                <h4 class="clc-form-section-title"><i class="fas fa-address-book"></i> Contact</h4>
                <div class="clc-form-row">
                    <div class="form-group">
                        <label class="form-label">Mobile</label>
                        <input type="text" name="mobile" class="form-control <?php echo isset($errors['mobile']) ? 'is-invalid' : ''; ?>" value="<?php echo clp_escape($record['mobile']); ?>" maxlength="30">
                        <?php if (isset($errors['mobile'])): ?><div class="clc-error"><?php echo clp_escape($errors['mobile']); ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>" value="<?php echo clp_escape($record['email']); ?>" maxlength="254">
                        <?php if (isset($errors['email'])): ?><div class="clc-error"><?php echo clp_escape($errors['email']); ?></div><?php endif; ?>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save Participant</button>
            <a href="<?php echo CLP_ADMIN_URL; ?>/clc.php" class="btn btn-primary">Cancel</a>
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
