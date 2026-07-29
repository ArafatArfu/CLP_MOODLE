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
    'mailing_address' => '',
    'history_of_center' => '',
    'description_of_center' => '',
    'contact_person_details' => '',
    'accomplishment' => '',
    'current_status' => 'supported',
    'hm_teacher_name' => '',
    'hm_phone_number' => '',
    'hm_email' => '',
    'clc_teacher_name' => '',
    'clc_teacher_email' => '',
    'clc_teacher_phone' => '',
    'scr_teacher_name' => '',
    'scr_teacher_email' => '',
    'scr_teacher_phone' => '',
    'global_classroom' => 'no',
    'program_clp_pi_english_club' => 'no',
    'program_egl_english' => 'no',
    'program_egl_math' => 'no',
    'program_csaw' => 'no',
    'school_grading' => '',
    'clc_graduate_students' => '',
    'scr_benefited_students' => '',
    'hardware_status' => '',
    'last_visit_date' => '',
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
        $record['last_visit_date'] = !empty($row['last_visit_date']) ? date('Y-m-d H:i', (int)$row['last_visit_date']) : '';
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
        $record['center_code'] = trim($_POST['center_code'] ?? '');
        $record['center_name'] = trim($_POST['center_name'] ?? '');
        $record['center_type'] = trim($_POST['center_type'] ?? 'clc');
        $record['division'] = trim($_POST['division'] ?? '');
        $record['district'] = trim($_POST['district'] ?? '');
        $record['upazila'] = trim($_POST['upazila'] ?? '');
        $record['address'] = trim($_POST['address'] ?? '');
        $record['contact_person'] = trim($_POST['contact_person'] ?? '');
        $record['contact_number'] = trim($_POST['contact_number'] ?? '');
        $record['email'] = trim($_POST['email'] ?? '');
        $record['support'] = trim($_POST['support'] ?? '');
        $record['sponsor_name'] = trim($_POST['sponsor_name'] ?? '');
        $record['devices_count'] = (int)($_POST['devices_count'] ?? 0);
        $record['students_count'] = (int)($_POST['students_count'] ?? 0);
        $record['status'] = (int)($record['id'] === 0 ? 1 : ($_POST['status'] ?? 1));
        $record['description'] = trim($_POST['description'] ?? '');
        $record['mailing_address'] = trim($_POST['mailing_address'] ?? '');
        $record['history_of_center'] = trim($_POST['history_of_center'] ?? '');
        $record['description_of_center'] = trim($_POST['description_of_center'] ?? '');
        $record['contact_person_details'] = trim($_POST['contact_person_details'] ?? '');
        $record['accomplishment'] = trim($_POST['accomplishment'] ?? '');
        $record['current_status'] = trim($_POST['current_status'] ?? 'supported');
        $record['hm_teacher_name'] = trim($_POST['hm_teacher_name'] ?? '');
        $record['hm_phone_number'] = trim($_POST['hm_phone_number'] ?? '');
        $record['hm_email'] = trim($_POST['hm_email'] ?? '');
        $record['clc_teacher_name'] = trim($_POST['clc_teacher_name'] ?? '');
        $record['clc_teacher_email'] = trim($_POST['clc_teacher_email'] ?? '');
        $record['clc_teacher_phone'] = trim($_POST['clc_teacher_phone'] ?? '');
        $record['scr_teacher_name'] = trim($_POST['scr_teacher_name'] ?? '');
        $record['scr_teacher_email'] = trim($_POST['scr_teacher_email'] ?? '');
        $record['scr_teacher_phone'] = trim($_POST['scr_teacher_phone'] ?? '');
        $record['global_classroom'] = trim($_POST['global_classroom'] ?? 'no');
        $record['program_clp_pi_english_club'] = trim($_POST['program_clp_pi_english_club'] ?? 'no');
        $record['program_egl_english'] = trim($_POST['program_egl_english'] ?? 'no');
        $record['program_egl_math'] = trim($_POST['program_egl_math'] ?? 'no');
        $record['program_csaw'] = trim($_POST['program_csaw'] ?? 'no');
        $record['school_grading'] = trim($_POST['school_grading'] ?? '');
        $record['clc_graduate_students'] = trim($_POST['clc_graduate_students'] ?? '');
        $record['scr_benefited_students'] = trim($_POST['scr_benefited_students'] ?? '');
        $record['hardware_status'] = trim($_POST['hardware_status'] ?? '');
        $record['follow_up_over_phone'] = (int)($_POST['follow_up_over_phone'] ?? 0);

        $lastFollow = trim($_POST['last_follow_up_date'] ?? '');
        if ($lastFollow !== '') {
            $record['last_follow_up_date'] = date('Y-m-d', strtotime($lastFollow));
        } else {
            $record['last_follow_up_date'] = '';
        }

        $lastVisit = trim($_POST['last_visit_date'] ?? '');
        if ($lastVisit !== '') {
            $dt = DateTime::createFromFormat('Y-m-d H:i', $lastVisit);
            $record['last_visit_date'] = $dt ? (int)$dt->getTimestamp() : 0;
        } else {
            $record['last_visit_date'] = 0;
        }

        $estDate = trim($_POST['establishment_date'] ?? '');
        $startDate = trim($_POST['start_date'] ?? '');

        $sponsorsJson = $_POST['sponsors_json'] ?? '[]';
        $sponsors = json_decode($sponsorsJson, true);
        if (!is_array($sponsors)) {
            $sponsors = [];
        }

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
        if (!in_array($record['center_type'], ['clc', 'scr', 'clc_scr', 'other'], true)) {
            $errors['center_type'] = 'Please select a valid center type.';
        }
        if ($record['current_status'] === '') {
            $errors['current_status'] = 'Please select current status.';
        }
        if (!in_array($record['global_classroom'], ['yes', 'no'], true)) {
            $record['global_classroom'] = 'no';
        }
        if (!in_array($record['school_grading'], ['', 'a', 'b', 'c', 'd'], true)) {
            $record['school_grading'] = '';
        }

        $emailFields = ['hm_email', 'clc_teacher_email', 'scr_teacher_email'];
        foreach ($emailFields as $field) {
            if ($record[$field] !== '' && !filter_var($record[$field], FILTER_VALIDATE_EMAIL)) {
                $errors[$field] = 'Please enter a valid email address.';
            }
        }

        $phoneFields = ['hm_phone_number', 'clc_teacher_phone', 'scr_teacher_phone'];
        foreach ($phoneFields as $field) {
            if ($record[$field] !== '') {
                $phoneClean = preg_replace('/[\s\-\(\)]/', '', $record[$field]);
                if (!preg_match('/^\+?[0-9]{10,15}$/', $phoneClean)) {
                    $errors[$field] = 'Please enter a valid phone number (10–15 digits).';
                }
            }
        }

        if (!empty($sponsors)) {
            foreach ($sponsors as $idx => $sponsor) {
                if (empty($sponsor['name']) && empty($sponsor['email']) && empty($sponsor['phone']) && empty($sponsor['address'])) {
                    continue;
                }
                if (empty($sponsor['name'])) {
                    $errors['sponsors_json'] = 'Sponsor #' . ($idx + 1) . ' name is required.';
                    break;
                }
                if (!empty($sponsor['email']) && !filter_var($sponsor['email'], FILTER_VALIDATE_EMAIL)) {
                    $errors['sponsors_json'] = 'Sponsor #' . ($idx + 1) . ' email is invalid.';
                    break;
                }
                if (!empty($sponsor['phone'])) {
                    $phoneClean = preg_replace('/[\s\-\(\)]/', '', $sponsor['phone']);
                    if (!preg_match('/^\+?[0-9]{10,15}$/', $phoneClean)) {
                        $errors['sponsors_json'] = 'Sponsor #' . ($idx + 1) . ' phone is invalid.';
                        break;
                    }
                }
            }
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
            $usermodified = 1;

            if (!empty($record['id'])) {
                $stmt = $db->prepare(
                    "UPDATE " . CLP_CENTERS_TABLE . " SET
                        center_code=?, center_name=?, center_type=?, division=?, district=?,
                        upazila=?, address=?, contact_person=?, contact_number=?, email=?, establishment_date=?,
                        start_date=?, support=?, sponsor_name=?, devices_count=?, students_count=?, status=?,
                        description=?, mailing_address=?, history_of_center=?, description_of_center=?,
                        contact_person_details=?, accomplishment=?, current_status=?, hm_teacher_name=?,
                        hm_phone_number=?, hm_email=?, clc_teacher_name=?, clc_teacher_email=?, clc_teacher_phone=?,
                        scr_teacher_name=?, scr_teacher_email=?, scr_teacher_phone=?, global_classroom=?,
                        program_clp_pi_english_club=?, program_egl_english=?, program_egl_math=?, program_csaw=?,
                         school_grading=?, clc_graduate_students=?, scr_benefited_students=?, hardware_status=?,
                         last_visit_date=?, follow_up_over_phone=?, last_follow_up_date=?, timemodified=?, usermodified=?
                      WHERE id=?"
                );
                $stmt->bind_param(
                    "ssssssssssiissiiisssssssssssssssssssssssssiisisi",
                    $record['center_code'], $record['center_name'], $record['center_type'],
                    $record['division'], $record['district'], $record['upazila'], $record['address'],
                    $record['contact_person'], $record['contact_number'], $record['email'], $estTs,
                    $startTs, $record['support'], $record['sponsor_name'], $record['devices_count'],
                    $record['students_count'], $record['status'], $record['description'],
                    $record['mailing_address'], $record['history_of_center'], $record['description_of_center'],
                    $record['contact_person_details'], $record['accomplishment'], $record['current_status'],
                    $record['hm_teacher_name'], $record['hm_phone_number'], $record['hm_email'],
                    $record['clc_teacher_name'], $record['clc_teacher_email'], $record['clc_teacher_phone'],
                    $record['scr_teacher_name'], $record['scr_teacher_email'], $record['scr_teacher_phone'],
                    $record['global_classroom'], $record['program_clp_pi_english_club'], $record['program_egl_english'],
                    $record['program_egl_math'], $record['program_csaw'], $record['school_grading'],
                    $record['clc_graduate_students'], $record['scr_benefited_students'], $record['hardware_status'],
                    $record['last_visit_date'], $record['follow_up_over_phone'], $record['last_follow_up_date'], $now, $usermodified, $record['id']
                );
                $ok = $stmt->execute();
                $stmt->close();
                if ($ok) {
                    $centerId = $record['id'];
                    clp_set_success('Center record updated successfully.');
                } else {
                    clp_set_error('Failed to update center record.');
                }
            } else {
                $stmt = $db->prepare(
                    "INSERT INTO " . CLP_CENTERS_TABLE . "
                        (center_code, center_name, center_type, division, district, upazila, address,
                         contact_person, contact_number, email, establishment_date, start_date, support, sponsor_name,
                         devices_count, students_count, status, description, mailing_address, history_of_center,
                         description_of_center, contact_person_details, accomplishment, current_status,
                         hm_teacher_name, hm_phone_number, hm_email, clc_teacher_name, clc_teacher_email,
                         clc_teacher_phone, scr_teacher_name, scr_teacher_email, scr_teacher_phone,
                         global_classroom, program_clp_pi_english_club, program_egl_english, program_egl_math,
                         program_csaw, school_grading, clc_graduate_students, scr_benefited_students,
                         hardware_status, last_visit_date, follow_up_over_phone, last_follow_up_date,
                         timecreated, timemodified, usermodified)
                       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
                 );
                $usermodified = 1;
                $stmt->bind_param(
                    "ssssssssssiissiiisssssssssssssssssssssssssiisiis",
                    $record['center_code'], $record['center_name'], $record['center_type'],
                    $record['division'], $record['district'], $record['upazila'], $record['address'],
                    $record['contact_person'], $record['contact_number'], $record['email'], $estTs,
                    $startTs, $record['support'], $record['sponsor_name'], $record['devices_count'],
                    $record['students_count'], $record['status'], $record['description'],
                    $record['mailing_address'], $record['history_of_center'], $record['description_of_center'],
                    $record['contact_person_details'], $record['accomplishment'], $record['current_status'],
                    $record['hm_teacher_name'], $record['hm_phone_number'], $record['hm_email'],
                    $record['clc_teacher_name'], $record['clc_teacher_email'], $record['clc_teacher_phone'],
                    $record['scr_teacher_name'], $record['scr_teacher_email'], $record['scr_teacher_phone'],
                    $record['global_classroom'], $record['program_clp_pi_english_club'], $record['program_egl_english'],
                    $record['program_egl_math'], $record['program_csaw'], $record['school_grading'],
                     $record['clc_graduate_students'], $record['scr_benefited_students'], $record['hardware_status'],
                     $record['last_visit_date'], $record['follow_up_over_phone'], $record['last_follow_up_date'], $now, $now, $usermodified
                );
                $ok = $stmt->execute();
                $stmt->close();
                if ($ok) {
                    $centerId = $db->insert_id;
                    clp_set_success('Center record created successfully.');
                } else {
                    clp_set_error('Failed to create center record.');
                }
            }

            if ($ok && $centerId > 0) {
                $db->close();

                if (!empty($sponsors)) {
                    $sponsorTable = 'mdl_local_centermanagement_sponsors';
                    $db = clp_db_connect();
                    $db->query("DELETE FROM {$sponsorTable} WHERE center_id = " . (int)$centerId);
                    $sort = 0;
                    foreach ($sponsors as $sponsor) {
                        $name = trim((string)($sponsor['name'] ?? ''));
                        if ($name === '') continue;
                        $country = trim((string)($sponsor['country'] ?? ''));
                        $address = trim((string)($sponsor['address'] ?? ''));
                        $email = trim((string)($sponsor['email'] ?? ''));
                        $phone = trim((string)($sponsor['phone'] ?? ''));
                        $stmt = $db->prepare("INSERT INTO {$sponsorTable} (center_id, name, country, address, email, phone, sortorder, timecreated, timemodified) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                        $stmt->bind_param("issssssii", $centerId, $name, $country, $address, $email, $phone, $sort, $now, $now);
                        $stmt->execute();
                        $stmt->close();
                        $sort++;
                    }
                    $db->close();
                }

                $fileareas = ['banner_images', 'plaque_images', 'school_photos'];
                $fileareaTables = [
                    'banner_images' => 'mdl_local_centermanagement_banner_images',
                    'plaque_images' => 'mdl_local_centermanagement_plaque_gallery',
                    'school_photos' => 'mdl_local_centermanagement_school_photo_gallery',
                ];
                foreach ($fileareas as $filearea) {
                    if (!empty($_FILES[$filearea]['name'][0]) || !empty($_FILES[$filearea]['name'])) {
                        $db = clp_db_connect();
                        $table = $fileareaTables[$filearea];
                        $db->query("DELETE FROM {$table} WHERE center_id = " . (int)$centerId);
                        $sortorder = 0;

                        if (!empty($_FILES[$filearea]['name'][0]) && is_array($_FILES[$filearea]['name'])) {
                            foreach ($_FILES[$filearea]['tmp_name'] as $idx => $tmpName) {
                                if ($tmpName && $_FILES[$filearea]['error'][$idx] === UPLOAD_ERR_OK) {
                                    $filename = clp_upload_file([
                                        'name' => $_FILES[$filearea]['name'][$idx],
                                        'type' => $_FILES[$filearea]['type'][$idx],
                                        'tmp_name' => $tmpName,
                                        'error' => $_FILES[$filearea]['error'][$idx],
                                        'size' => $_FILES[$filearea]['size'][$idx],
                                    ], $filearea, $centerId);
                                    if ($filename) {
                                        $stmt = $db->prepare("INSERT INTO {$table} (center_id, filename, sortorder, timecreated, timemodified) VALUES (?, ?, ?, ?, ?)");
                                        $stmt->bind_param("isiii", $centerId, $filename, $sortorder, $now, $now);
                                        $stmt->execute();
                                        $stmt->close();
                                        $sortorder++;
                                    }
                                }
                            }
                        } elseif (!empty($_FILES[$filearea]['name']) && $_FILES[$filearea]['error'] === UPLOAD_ERR_OK) {
                            $filename = clp_upload_file($_FILES[$filearea], $filearea, $centerId);
                            if ($filename) {
                                $stmt = $db->prepare("INSERT INTO {$table} (center_id, filename, sortorder, timecreated, timemodified) VALUES (?, ?, ?, ?, ?)");
                                $stmt->bind_param("isiii", $centerId, $filename, $sortorder, $now, $now);
                                $stmt->execute();
                                $stmt->close();
                            }
                        }
                        $db->close();
                    }
                }

                $submitAction = trim($_POST['submit_action'] ?? 'save');
                if ($submitAction === 'save_continue' && !empty($centerId)) {
                    clp_redirect(CLP_ADMIN_URL . '/centers_form.php?id=' . (int)$centerId);
                }
                clp_redirect(CLP_ADMIN_URL . '/centers.php');
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

$existingSponsors = [];
if ($isEdit && !empty($record['id'])) {
    $db = clp_db_connect();
    $sponsorTable = 'mdl_local_centermanagement_sponsors';
    if ($res = $db->query("SELECT name, country, address, email, phone FROM {$sponsorTable} WHERE center_id = " . (int)$record['id'] . " ORDER BY sortorder ASC, id ASC")) {
        while ($row = $res->fetch_assoc()) {
            $existingSponsors[] = $row;
        }
    }
    $db->close();
}

// Load existing media for form display.
$existingMedia = [
    'banner_images' => [],
    'plaque_images' => [],
    'school_photos' => [],
];
$fileareaTables = [
    'banner_images' => 'mdl_local_centermanagement_banner_images',
    'plaque_images' => 'mdl_local_centermanagement_plaque_gallery',
    'school_photos' => 'mdl_local_centermanagement_school_photo_gallery',
];
if ($isEdit && !empty($record['id'])) {
    $db = clp_db_connect();
    foreach ($existingMedia as $filearea => $items) {
        $table = $fileareaTables[$filearea];
        if ($res = $db->query("SELECT id, filename, alt_text, is_featured, sortorder FROM {$table} WHERE center_id = " . (int)$record['id'] . " ORDER BY sortorder ASC, id ASC")) {
            while ($row = $res->fetch_assoc()) {
                $existingMedia[$filearea][] = $row;
            }
        }
    }
    $db->close();
}

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

        <form method="POST" action="" class="clc-form" enctype="multipart/form-data" novalidate>
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
                <div class="clc-form-row">
                    <div class="form-group">
                        <label class="form-label">Center Type *</label>
                        <select name="center_type" class="form-control <?php echo isset($errors['center_type']) ? 'is-invalid' : ''; ?>">
                            <option value="clc" <?php echo $record['center_type'] === 'clc' ? 'selected' : ''; ?>>Computer Literacy Center (CLC)</option>
                            <option value="scr" <?php echo $record['center_type'] === 'scr' ? 'selected' : ''; ?>>Smart Classroom (SCR)</option>
                            <option value="clc_scr" <?php echo $record['center_type'] === 'clc_scr' ? 'selected' : ''; ?>>CLC + SCR</option>
                            <option value="other" <?php echo $record['center_type'] === 'other' ? 'selected' : ''; ?>>Other</option>
                        </select>
                        <?php if (isset($errors['center_type'])): ?><div class="clc-error"><?php echo clp_escape($errors['center_type']); ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="1" <?php echo ((int)$record['status'] === 1 || (int)$record['status'] === 0 && $isEdit === false) ? 'selected' : ''; ?>>Enabled (visible on website)</option>
                            <option value="0" <?php echo (int)$record['status'] === 0 && $isEdit === true ? 'selected' : ''; ?>>Disabled (hidden from website)</option>
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

            <!-- Extended Details -->
            <div class="clc-form-section">
                <h4 class="clc-form-section-title"><i class="fas fa-file-alt"></i> Extended Details</h4>
                <div class="clc-form-row">
                    <div class="form-group">
                        <label class="form-label">Mailing Address</label>
                        <textarea name="mailing_address" class="form-control tinymce" rows="3" maxlength="4000"><?php echo clp_escape($record['mailing_address']); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">History of the Center</label>
                        <textarea name="history_of_center" class="form-control tinymce" rows="3" maxlength="4000"><?php echo clp_escape($record['history_of_center']); ?></textarea>
                    </div>
                </div>
                <div class="clc-form-row">
                    <div class="form-group">
                        <label class="form-label">Description of the Center</label>
                        <textarea name="description_of_center" class="form-control tinymce" rows="3" maxlength="4000"><?php echo clp_escape($record['description_of_center']); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Contact Person with Phone / Email</label>
                        <textarea name="contact_person_details" class="form-control tinymce" rows="3" maxlength="4000"><?php echo clp_escape($record['contact_person_details']); ?></textarea>
                    </div>
                </div>
                <div class="clc-form-row">
                    <div class="form-group">
                        <label class="form-label">Accomplishment</label>
                        <textarea name="accomplishment" class="form-control tinymce" rows="3" maxlength="4000"><?php echo clp_escape($record['accomplishment']); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Current Status</label>
                        <select name="current_status" class="form-control <?php echo isset($errors['current_status']) ? 'is-invalid' : ''; ?>">
                            <option value="supported" <?php echo $record['current_status'] === 'supported' ? 'selected' : ''; ?>>Supported</option>
                            <option value="non_supported" <?php echo $record['current_status'] === 'non_supported' ? 'selected' : ''; ?>>Non-Supported</option>
                        </select>
                        <?php if (isset($errors['current_status'])): ?><div class="clc-error"><?php echo clp_escape($errors['current_status']); ?></div><?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Contact Persons -->
            <div class="clc-form-section">
                <h4 class="clc-form-section-title"><i class="fas fa-address-book"></i> Contact Persons</h4>

                <h5 class="clc-form-subtitle">Headmaster (HM)</h5>
                <div class="clc-form-row">
                    <div class="form-group">
                        <label class="form-label">HM Teacher Name</label>
                        <input type="text" name="hm_teacher_name" class="form-control" value="<?php echo clp_escape($record['hm_teacher_name']); ?>" maxlength="255">
                    </div>
                    <div class="form-group">
                        <label class="form-label">HM Phone Number</label>
                        <input type="text" name="hm_phone_number" class="form-control <?php echo isset($errors['hm_phone_number']) ? 'is-invalid' : ''; ?>" value="<?php echo clp_escape($record['hm_phone_number']); ?>" maxlength="50">
                        <?php if (isset($errors['hm_phone_number'])): ?><div class="clc-error"><?php echo clp_escape($errors['hm_phone_number']); ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label class="form-label">HM Email</label>
                        <input type="email" name="hm_email" class="form-control <?php echo isset($errors['hm_email']) ? 'is-invalid' : ''; ?>" value="<?php echo clp_escape($record['hm_email']); ?>" maxlength="254">
                        <?php if (isset($errors['hm_email'])): ?><div class="clc-error"><?php echo clp_escape($errors['hm_email']); ?></div><?php endif; ?>
                    </div>
                </div>

                <h5 class="clc-form-subtitle">CLC Teacher</h5>
                <div class="clc-form-row">
                    <div class="form-group">
                        <label class="form-label">CLC Teacher Name</label>
                        <input type="text" name="clc_teacher_name" class="form-control" value="<?php echo clp_escape($record['clc_teacher_name']); ?>" maxlength="255">
                    </div>
                    <div class="form-group">
                        <label class="form-label">CLC Teacher Email</label>
                        <input type="email" name="clc_teacher_email" class="form-control <?php echo isset($errors['clc_teacher_email']) ? 'is-invalid' : ''; ?>" value="<?php echo clp_escape($record['clc_teacher_email']); ?>" maxlength="254">
                        <?php if (isset($errors['clc_teacher_email'])): ?><div class="clc-error"><?php echo clp_escape($errors['clc_teacher_email']); ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label class="form-label">CLC Teacher Phone</label>
                        <input type="text" name="clc_teacher_phone" class="form-control <?php echo isset($errors['clc_teacher_phone']) ? 'is-invalid' : ''; ?>" value="<?php echo clp_escape($record['clc_teacher_phone']); ?>" maxlength="50">
                        <?php if (isset($errors['clc_teacher_phone'])): ?><div class="clc-error"><?php echo clp_escape($errors['clc_teacher_phone']); ?></div><?php endif; ?>
                    </div>
                </div>

                <h5 class="clc-form-subtitle">SCR Teacher</h5>
                <div class="clc-form-row">
                    <div class="form-group">
                        <label class="form-label">SCR Teacher Name</label>
                        <input type="text" name="scr_teacher_name" class="form-control" value="<?php echo clp_escape($record['scr_teacher_name']); ?>" maxlength="255">
                    </div>
                    <div class="form-group">
                        <label class="form-label">SCR Teacher Email</label>
                        <input type="email" name="scr_teacher_email" class="form-control <?php echo isset($errors['scr_teacher_email']) ? 'is-invalid' : ''; ?>" value="<?php echo clp_escape($record['scr_teacher_email']); ?>" maxlength="254">
                        <?php if (isset($errors['scr_teacher_email'])): ?><div class="clc-error"><?php echo clp_escape($errors['scr_teacher_email']); ?></div><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label class="form-label">SCR Teacher Phone</label>
                        <input type="text" name="scr_teacher_phone" class="form-control <?php echo isset($errors['scr_teacher_phone']) ? 'is-invalid' : ''; ?>" value="<?php echo clp_escape($record['scr_teacher_phone']); ?>" maxlength="50">
                        <?php if (isset($errors['scr_teacher_phone'])): ?><div class="clc-error"><?php echo clp_escape($errors['scr_teacher_phone']); ?></div><?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Programs -->
            <div class="clc-form-section">
                <h4 class="clc-form-section-title"><i class="fas fa-laptop-code"></i> Programs</h4>
                <div class="clc-form-row">
                    <div class="form-group">
                        <label class="form-label">Global Classroom</label>
                        <select name="global_classroom" class="form-control">
                            <option value="yes" <?php echo $record['global_classroom'] === 'yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="no" <?php echo $record['global_classroom'] === 'no' ? 'selected' : ''; ?>>No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">CLP PI English Club</label>
                        <select name="program_clp_pi_english_club" class="form-control">
                            <option value="yes" <?php echo $record['program_clp_pi_english_club'] === 'yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="no" <?php echo $record['program_clp_pi_english_club'] === 'no' ? 'selected' : ''; ?>>No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">EGL English</label>
                        <select name="program_egl_english" class="form-control">
                            <option value="yes" <?php echo $record['program_egl_english'] === 'yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="no" <?php echo $record['program_egl_english'] === 'no' ? 'selected' : ''; ?>>No</option>
                        </select>
                    </div>
                </div>
                <div class="clc-form-row">
                    <div class="form-group">
                        <label class="form-label">EGL Math</label>
                        <select name="program_egl_math" class="form-control">
                            <option value="yes" <?php echo $record['program_egl_math'] === 'yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="no" <?php echo $record['program_egl_math'] === 'no' ? 'selected' : ''; ?>>No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">CSAW</label>
                        <select name="program_csaw" class="form-control">
                            <option value="yes" <?php echo $record['program_csaw'] === 'yes' ? 'selected' : ''; ?>>Yes</option>
                            <option value="no" <?php echo $record['program_csaw'] === 'no' ? 'selected' : ''; ?>>No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">School Grading</label>
                        <select name="school_grading" class="form-control">
                            <option value="">—</option>
                            <?php foreach (['a', 'b', 'c', 'd'] as $g): ?>
                                <option value="<?php echo $g; ?>" <?php echo strtolower((string)$record['school_grading']) === $g ? 'selected' : ''; ?>><?php echo strtoupper($g); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Enhanced Media Uploads -->
            <div class="clc-form-section">
                <h4 class="clc-form-section-title"><i class="fas fa-images"></i> Enhanced Media</h4>

                <?php
                $mediaConfig = [
                    'banner_images' => 'School Banner Images (Slider)',
                    'plaque_images' => 'Plaque Images (Gallery)',
                    'school_photos' => 'School Photos (Gallery)',
                ];
                foreach ($mediaConfig as $filearea => $label):
                    $hasFeatured = $filearea === 'banner_images';
                ?>
                <h5 class="clc-form-subtitle"><?php echo $label; ?></h5>
                <div class="clc-media-manager"
                     data-filearea="<?php echo $filearea; ?>"
                     data-center-id="<?php echo (int)($record['id'] ?: 0); ?>"
                     data-has-featured="<?php echo $hasFeatured ? '1' : '0'; ?>">
                    <div class="clc-media-grid" id="<?php echo $filearea; ?>-grid">
                        <?php foreach ($existingMedia[$filearea] as $media): ?>
                            <div class="clc-media-item"
                                 data-id="<?php echo (int)$media['id']; ?>"
                                 data-filename="<?php echo clp_escape($media['filename']); ?>"
                                 data-sortorder="<?php echo (int)$media['sortorder']; ?>"
                                 data-is-featured="<?php echo (int)$media['is_featured']; ?>">
                                <div class="clc-media-preview">
                                    <img src="<?php echo clp_uploaded_file_url($filearea, $media['filename']); ?>" alt="">
                                    <?php if ($hasFeatured): ?>
                                        <div class="clc-media-featured-badge <?php echo $media['is_featured'] ? 'is-active' : ''; ?>">Featured</div>
                                    <?php endif; ?>
                                </div>
                                <div class="clc-media-meta">
                                    <input type="text" class="form-control form-control-sm clc-media-alt"
                                           placeholder="Alt text"
                                           value="<?php echo clp_escape($media['alt_text']); ?>"
                                           data-filename="<?php echo clp_escape($media['filename']); ?>">
                                    <?php if ($hasFeatured): ?>
                                        <label class="clc-media-featured-label">
                                            <input type="radio" name="<?php echo $filearea; ?>_featured"
                                                   value="<?php echo clp_escape($media['filename']); ?>"
                                                   <?php echo $media['is_featured'] ? 'checked' : ''; ?>>
                                            Featured
                                        </label>
                                    <?php endif; ?>
                                </div>
                                <div class="clc-media-actions">
                                    <button type="button" class="btn btn-sm btn-secondary clc-media-move-up" title="Move up"><i class="fas fa-arrow-up"></i></button>
                                    <button type="button" class="btn btn-sm btn-secondary clc-media-move-down" title="Move down"><i class="fas fa-arrow-down"></i></button>
                                    <button type="button" class="btn btn-sm btn-danger clc-media-remove" title="Remove"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="clc-media-upload-area" id="<?php echo $filearea; ?>-upload">
                        <input type="file" name="<?php echo $filearea; ?>[]" class="clc-media-input" multiple accept="image/*" style="display:none;">
                        <div class="clc-media-dropzone">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span>Click or drag images here</span>
                        </div>
                    </div>
                    <div class="clc-media-bulk">
                        <label class="form-label">Or bulk upload (replaces all <?php echo strtolower(str_replace('_', ' ', $filearea)); ?>)</label>
                        <input type="file" name="<?php echo $filearea; ?>[]" class="form-control" multiple accept="image/*">
                    </div>
                </div>
            <?php endforeach; ?>
            </div>

            <!-- Sponsors -->
            <div class="clc-form-section">
                <h4 class="clc-form-section-title"><i class="fas fa-handshake"></i> Sponsors</h4>
                <div class="clc-form-row">
                    <div class="form-group">
                        <label class="form-label">Sponsor Name (legacy)</label>
                        <input type="text" name="sponsor_name" class="form-control" value="<?php echo clp_escape($record['sponsor_name']); ?>" maxlength="1000">
                    </div>
                </div>
                <div id="sponsor-entries">
                    <div class="clc-form-row clc-sponsor-row" data-index="0">
                        <div class="form-group">
                            <label class="form-label">Sponsor Name</label>
                            <input type="text" class="form-control sponsor-name" value="" maxlength="255">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Country</label>
                            <input type="text" class="form-control sponsor-country" value="" maxlength="255">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control sponsor-phone" value="" maxlength="50">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control sponsor-email" value="" maxlength="254">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Address</label>
                            <textarea class="form-control sponsor-address" rows="2" maxlength="1000"></textarea>
                        </div>
                        <div class="form-group form-group-actions">
                            <button type="button" class="btn btn-sm btn-danger clc-remove-sponsor" style="display:none;"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                </div>
                <?php if (isset($errors['sponsors_json'])): ?>
                    <div class="clc-error" style="margin-top:10px;"><?php echo clp_escape($errors['sponsors_json']); ?></div>
                <?php endif; ?>
                <button type="button" class="btn btn-sm btn-secondary" id="clp-add-sponsor"><i class="fas fa-plus"></i> Add Sponsor</button>
                <input type="hidden" name="sponsors_json" id="sponsors-json" value="[]">
            </div>

            <!-- Additional Text Fields -->
            <div class="clc-form-section">
                <h4 class="clc-form-section-title"><i class="fas fa-graduation-cap"></i> Additional Text Fields</h4>
                <div class="clc-form-row">
                    <div class="form-group">
                        <label class="form-label">CLC Graduate Students</label>
                        <textarea name="clc_graduate_students" class="form-control tinymce" rows="3" maxlength="4000"><?php echo clp_escape($record['clc_graduate_students']); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">SCR Benefited Students</label>
                        <textarea name="scr_benefited_students" class="form-control tinymce" rows="3" maxlength="4000"><?php echo clp_escape($record['scr_benefited_students']); ?></textarea>
                    </div>
                </div>
                <div class="clc-form-row">
                    <div class="form-group">
                        <label class="form-label">Hardware Status</label>
                        <textarea name="hardware_status" class="form-control tinymce" rows="3" maxlength="4000"><?php echo clp_escape($record['hardware_status']); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Last Visit Date</label>
                        <input type="text" name="last_visit_date" class="form-control" value="<?php echo clp_escape($record['last_visit_date']); ?>" placeholder="YYYY-MM-DD HH:MM">
                        <small class="clc-help">Format: 2025-01-15 14:30</small>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Follow-up Over Phone</label>
                        <input type="number" name="follow_up_over_phone" class="form-control" value="<?php echo (int)$record['follow_up_over_phone']; ?>" min="0">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Last Follow-up Date</label>
                        <input type="date" name="last_follow_up_date" class="form-control" value="<?php echo clp_escape($record['last_follow_up_date']); ?>">
                    </div>
                </div>
            </div>

            <input type="hidden" name="submit_action" id="submit-action" value="save">
            <button type="submit" name="submit_action" value="save_continue" class="btn btn-secondary"><i class="fas fa-save"></i> Save and Continue Editing</button>
            <button type="submit" name="submit_action" value="save" class="btn btn-success"><i class="fas fa-save"></i> <?php echo $isEdit ? 'Update' : 'Save'; ?></button>
            <a href="<?php echo CLP_ADMIN_URL; ?>/centers.php" class="btn btn-primary">Cancel</a>
        </form>
    </div>
</div>

<style>
.clc-form { padding: 20px; }
.clc-form-section { margin-bottom: 26px; padding-bottom: 8px; border-bottom: 1px solid #eef0f4; }
.clc-form-section:last-of-type { border-bottom: 0; }
.clc-form-section-title { font-size: 15px; color: #006b4f; margin: 0 0 16px; display: flex; align-items: center; gap: 8px; }
.clc-form-subtitle { font-size: 13px; color: #3e4e4a; margin: 18px 0 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .4px; }
.clc-form-subtitle:first-child { margin-top: 0; }
.clc-form-row { display: flex; flex-wrap: wrap; gap: 16px; }
.clc-form-row .form-group { flex: 1; min-width: 200px; }
.clc-error { color: #b82b00; font-size: 12px; margin-top: 5px; }
.form-control.is-invalid { border-color: #b82b00; box-shadow: 0 0 0 3px rgba(184,43,0,.1); }
.clc-help { color: #6a737b; font-size: 12px; margin-top: 6px; display: block; }
.clc-sponsor-row { align-items: flex-end; }
.form-group-actions { flex: 0 0 auto; min-width: 40px; }

#sponsor-entries .clc-sponsor-row { background: #f8f9fb; padding: 12px; border-radius: 8px; border: 1px solid #eef0f4; }
#sponsor-entries .clc-sponsor-row .form-group { margin-bottom: 10px; }
#clp-add-sponsor { margin-top: 10px; }
</style>

<script>
(function () {
    var entries = document.getElementById('sponsor-entries');
    var jsonInput = document.getElementById('sponsors-json');
    var addBtn = document.getElementById('clp-add-sponsor');
    if (!entries || !jsonInput || !addBtn) return;

    var existingSponsors = <?php echo json_encode($existingSponsors, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT); ?>;

    function escapeHtml(str) {
        return (str || '').replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }

    function collectRow(row) {
        return {
            name: (row.querySelector('.sponsor-name') || {}).value || '',
            country: (row.querySelector('.sponsor-country') || {}).value || '',
            phone: (row.querySelector('.sponsor-phone') || {}).value || '',
            email: (row.querySelector('.sponsor-email') || {}).value || '',
            address: (row.querySelector('.sponsor-address') || {}).value || ''
        };
    }

    function collectAll() {
        var data = [];
        entries.querySelectorAll('.clc-sponsor-row').forEach(function (row) {
            data.push(collectRow(row));
        });
        return data;
    }

    function updateJson() {
        jsonInput.value = JSON.stringify(collectAll());
    }

    function toggleRemoveButtons() {
        var rows = entries.querySelectorAll('.clc-sponsor-row');
        rows.forEach(function (row) {
            var btn = row.querySelector('.clc-remove-sponsor');
            if (rows.length <= 1) {
                btn.style.display = 'none';
            } else {
                btn.style.display = btn ? '' : 'none';
            }
        });
    }

    function populateRow(row, data) {
        var nameInput = row.querySelector('.sponsor-name');
        var countryInput = row.querySelector('.sponsor-country');
        var phoneInput = row.querySelector('.sponsor-phone');
        var emailInput = row.querySelector('.sponsor-email');
        var addressInput = row.querySelector('.sponsor-address');
        if (nameInput) nameInput.value = data.name || '';
        if (countryInput) countryInput.value = data.country || '';
        if (phoneInput) phoneInput.value = data.phone || '';
        if (emailInput) emailInput.value = data.email || '';
        if (addressInput) addressInput.value = data.address || '';
    }

    function initSponsors() {
        entries.innerHTML = '';
        var list = existingSponsors && existingSponsors.length ? existingSponsors : [{}];
        list.forEach(function (sponsor) {
            var tmpl = entries.querySelector('.clc-sponsor-row');
            var clone = tmpl ? tmpl.cloneNode(true) : document.createElement('div');
            clone.className = 'clc-form-row clc-sponsor-row';
            clone.setAttribute('data-index', entries.children.length);
            clone.innerHTML = '<div class="form-group"><label class="form-label">Sponsor Name</label><input type="text" class="form-control sponsor-name" value="" maxlength="255"></div>' +
                '<div class="form-group"><label class="form-label">Country</label><input type="text" class="form-control sponsor-country" value="" maxlength="255"></div>' +
                '<div class="form-group"><label class="form-label">Phone</label><input type="text" class="form-control sponsor-phone" value="" maxlength="50"></div>' +
                '<div class="form-group"><label class="form-label">Email</label><input type="email" class="form-control sponsor-email" value="" maxlength="254"></div>' +
                '<div class="form-group"><label class="form-label">Address</label><textarea class="form-control sponsor-address" rows="2" maxlength="1000"></textarea></div>' +
                '<div class="form-group form-group-actions"><button type="button" class="btn btn-sm btn-danger clc-remove-sponsor"><i class="fas fa-trash"></i></button></div>';
            entries.appendChild(clone);
            populateRow(clone, sponsor);
        });

        var btn = entries.querySelector('.clc-remove-sponsor');
        if (btn) {
            btn.addEventListener('click', function () {
                entries.removeChild(clone);
                updateJson();
                toggleRemoveButtons();
            });
        }

        entries.addEventListener('click', function (e) {
            var target = e.target.closest('.clc-remove-sponsor');
            if (!target) return;
            var row = target.closest('.clc-sponsor-row');
            if (!row) return;
            row.parentNode.removeChild(row);
            updateJson();
            toggleRemoveButtons();
        });

        entries.addEventListener('input', function () {
            updateJson();
        });

        updateJson();
        toggleRemoveButtons();
    }

    window.collectAllSponsors = function () {
        updateJson();
        return collectAll();
    };

    addBtn.addEventListener('click', function () {
        var tmpl = entries.querySelector('.clc-sponsor-row');
        var clone = tmpl ? tmpl.cloneNode(true) : document.createElement('div');
        clone.className = 'clc-form-row clc-sponsor-row';
        clone.setAttribute('data-index', entries.children.length);
        clone.innerHTML = '<div class="form-group"><label class="form-label">Sponsor Name</label><input type="text" class="form-control sponsor-name" value="" maxlength="255"></div>' +
            '<div class="form-group"><label class="form-label">Country</label><input type="text" class="form-control sponsor-country" value="" maxlength="255"></div>' +
            '<div class="form-group"><label class="form-label">Phone</label><input type="text" class="form-control sponsor-phone" value="" maxlength="50"></div>' +
            '<div class="form-group"><label class="form-label">Email</label><input type="email" class="form-control sponsor-email" value="" maxlength="254"></div>' +
            '<div class="form-group"><label class="form-label">Address</label><textarea class="form-control sponsor-address" rows="2" maxlength="1000"></textarea></div>' +
            '<div class="form-group form-group-actions"><button type="button" class="btn btn-sm btn-danger clc-remove-sponsor"><i class="fas fa-trash"></i></button></div>';
        entries.appendChild(clone);

        var btn = clone.querySelector('.clc-remove-sponsor');
        btn.addEventListener('click', function () {
            entries.removeChild(clone);
            updateJson();
            toggleRemoveButtons();
        });

        updateJson();
        toggleRemoveButtons();
    });

    initSponsors();

    // Form submission hook for sponsors.
    var form = entries.closest('form');
    if (form) {
        form.addEventListener('submit', function () {
            updateJson();
            if (typeof tinymce !== 'undefined') {
                tinymce.triggerSave();
            }
        });
    }
})();

// Rich Text Editor - TinyMCE.
if (typeof tinymce === 'undefined') {
    var script = document.createElement('script');
    script.src = 'https://cdn.js.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js';
    script.onload = initTinyMCE;
    document.head.appendChild(script);
} else {
    initTinyMCE();
}

function initTinyMCE() {
    if (typeof tinymce === 'undefined') return;
    tinymce.init({
        selector: 'textarea.tinymce',
        menubar: false,
        branding: false,
        promotion: false,
        height: 280,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | ' +
            'bold italic underline strikethrough | forecolor backcolor | ' +
            'alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist | link table image | removeformat',
        toolbar_mode: 'wrap',
        block_formats: 'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5; Heading 6=h6',
        font_family_formats: 'Inter=Inter,Arial,sans-serif; Noto Serif=Noto Serif,Georgia,serif; Roboto=Roboto,Arial,sans-serif',
        font_size_formats: '12px 14px 16px 18px 24px 32px',
        images_upload_handler: function (blobInfo, progress) {
            return new Promise(function (resolve, reject) {
                var formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '<?php echo CLP_ADMIN_URL; ?>/upload.php?center_id=' + encodeURIComponent(document.querySelector('.clc-media-manager')?.dataset.centerId || 0) + '&filearea=editor_uploads');
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        try {
                            var json = JSON.parse(xhr.responseText);
                            if (json.success) {
                                resolve(json.url);
                            } else {
                                reject(json.message || 'Upload failed');
                            }
                        } catch (e) {
                            reject('Invalid server response');
                        }
                    } else {
                        reject('Upload failed with status ' + xhr.status);
                    }
                };
                xhr.onerror = function () { reject('Upload failed'); };
                xhr.send(formData);
            });
        },
        content_style: 'body { font-family: Inter, Arial, sans-serif; font-size: 14px; }',
        setup: function (editor) {
            editor.on('change', function () {
                editor.save();
            });
        }
    });
}
</script>

<script>
// Enhanced Media Manager.
(function () {
    var CSRF_TOKEN = '<?php echo clp_csrf_token(); ?>';
    var ADMIN_URL = '<?php echo CLP_ADMIN_URL; ?>';

    function initMediaManager(container) {
        var filearea = container.dataset.filearea;
        var centerId = parseInt(container.dataset.centerId, 10) || 0;
        var hasFeatured = container.dataset.hasFeatured === '1';
        var grid = container.querySelector('.clc-media-grid');
        var uploadArea = container.querySelector('.clc-media-upload-area');
        var dropzone = container.querySelector('.clc-media-dropzone');
        var fileInput = container.querySelector('.clc-media-input');

        if (!grid || !fileInput) return;

        function refresh() {
            // Nothing for now, can fetch fresh state if needed.
        }

        function createMediaItem(data) {
            var item = document.createElement('div');
            item.className = 'clc-media-item';
            item.dataset.id = data.id || '';
            item.dataset.filename = data.filename || '';
            item.dataset.sortorder = data.sortorder || 0;
            item.dataset.isFeatured = data.is_featured ? '1' : '0';

            var featuredBadge = hasFeatured ? '<div class="clc-media-featured-badge ' + (data.is_featured ? 'is-active' : '') + '">Featured</div>' : '';
            var featuredRadio = hasFeatured ? '<label class="clc-media-featured-label"><input type="radio" name="' + filearea + '_featured" value="' + (data.filename || '') + '" ' + (data.is_featured ? 'checked' : '') + '> Featured</label>' : '';

            item.innerHTML = '<div class="clc-media-preview"><img src="' + (data.url || '') + '" alt="">' + featuredBadge + '</div>' +
                '<div class="clc-media-meta">' +
                '<input type="text" class="form-control form-control-sm clc-media-alt" placeholder="Alt text" value="' + (data.alt_text || '') + '" data-filename="' + (data.filename || '') + '">' +
                featuredRadio +
                '</div>' +
                '<div class="clc-media-actions">' +
                '<button type="button" class="btn btn-sm btn-secondary clc-media-move-up" title="Move up"><i class="fas fa-arrow-up"></i></button> ' +
                '<button type="button" class="btn btn-sm btn-secondary clc-media-move-down" title="Move down"><i class="fas fa-arrow-down"></i></button> ' +
                '<button type="button" class="btn btn-sm btn-danger clc-media-remove" title="Remove"><i class="fas fa-trash"></i></button>' +
                '</div>';

            bindItemEvents(item, centerId, filearea);
            return item;
        }

        function bindItemEvents(item, centerId, filearea) {
            var filename = item.dataset.filename;

            item.querySelector('.clc-media-remove').addEventListener('click', function () {
                if (!confirm('Remove this image?')) return;
                var formData = new FormData();
                formData.append('center_id', centerId);
                formData.append('filearea', filearea);
                formData.append('filename', filename);
                formData.append('csrf_token', CSRF_TOKEN);
                fetch(ADMIN_URL + '/delete_upload.php', { method: 'POST', body: formData })
                    .then(function (r) { return r.json(); })
                    .then(function (json) {
                        if (json.success) item.remove();
                    });
            });

            item.querySelector('.clc-media-move-up').addEventListener('click', function () {
                var prev = item.previousElementSibling;
                if (prev && prev.classList.contains('clc-media-item')) {
                    grid.insertBefore(item, prev);
                    reindex();
                }
            });

            item.querySelector('.clc-media-move-down').addEventListener('click', function () {
                var next = item.nextElementSibling;
                if (next && next.classList.contains('clc-media-item')) {
                    grid.insertBefore(next, item);
                    reindex();
                }
            });

            var altInput = item.querySelector('.clc-media-alt');
            if (altInput) {
                altInput.addEventListener('blur', function () {
                    saveMeta('update_alt', filename, { alt_text: altInput.value });
                });
            }

            var featuredInput = item.querySelector('input[type="radio"]');
            if (featuredInput) {
                featuredInput.addEventListener('change', function () {
                    if (featuredInput.checked) {
                        saveMeta('toggle_featured', filename, { is_featured: 1 });
                        grid.querySelectorAll('.clc-media-featured-badge').forEach(function (b) { b.classList.remove('is-active'); });
                        item.querySelector('.clc-media-featured-badge')?.classList.add('is-active');
                    }
                });
            }
        }

        function reindex() {
            var items = grid.querySelectorAll('.clc-media-item');
            items.forEach(function (item, idx) {
                item.dataset.sortorder = idx;
                saveMeta('update_order', item.dataset.filename, { sortorder: idx });
            });
        }

        function saveMeta(action, filename, data) {
            if (!filename) return;
            var formData = new FormData();
            formData.append('center_id', centerId);
            formData.append('filearea', filearea);
            formData.append('filename', filename);
            formData.append('action', action);
            formData.append('csrf_token', CSRF_TOKEN);
            for (var key in data) {
                if (data.hasOwnProperty(key)) {
                    formData.append(key, data[key]);
                }
            }
            fetch(ADMIN_URL + '/save_media_meta.php', { method: 'POST', body: formData })
                .then(function (r) { return r.json(); })
                .then(function (json) {
                    // Silent save.
                });
        }

        function uploadFiles(files) {
            if (!centerId || files.length === 0) return;
            Array.prototype.forEach.call(files, function (file) {
                var formData = new FormData();
                formData.append('file', file);
                formData.append('center_id', centerId);
                formData.append('filearea', filearea);
                var xhr = new XMLHttpRequest();
                xhr.open('POST', ADMIN_URL + '/upload.php');
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        try {
                            var json = JSON.parse(xhr.responseText);
                            if (json.success) {
                                var item = createMediaItem({
                                    id: json.id || '',
                                    filename: json.filename,
                                    url: json.url,
                                    alt_text: json.alt_text || '',
                                    is_featured: json.is_featured ? 1 : 0,
                                    sortorder: json.sortorder || 0,
                                });
                                grid.appendChild(item);
                            } else {
                                alert(json.message || 'Upload failed');
                            }
                        } catch (e) {
                            alert('Upload failed');
                        }
                    }
                };
                xhr.send(formData);
            });
        }

        if (dropzone && fileInput) {
            dropzone.addEventListener('click', function () {
                if (!centerId) {
                    alert('Save the center first, then upload images.');
                    return;
                }
                fileInput.click();
            });

            fileInput.addEventListener('change', function () {
                uploadFiles(fileInput.files);
                fileInput.value = '';
            });

            uploadArea = container.querySelector('.clc-media-upload-area');
            if (uploadArea) {
                uploadArea.addEventListener('dragover', function (e) {
                    e.preventDefault();
                    dropzone.style.borderColor = '#006b4f';
                });
                uploadArea.addEventListener('dragleave', function () {
                    dropzone.style.borderColor = '#eef0f4';
                });
                uploadArea.addEventListener('drop', function (e) {
                    e.preventDefault();
                    dropzone.style.borderColor = '#eef0f4';
                    var files = e.dataTransfer.files;
                    uploadFiles(files);
                });
            }
        }
    }

    document.querySelectorAll('.clc-media-manager').forEach(function (container) {
        initMediaManager(container);
    });
})();
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
