<?php
// CLP Admin Panel - Sponsored Center Detail (View).
//
// Read-only view of a single centre record from the shared centres table
// (mdl_local_centermanagement_centers), with quick links to Edit and Delete.
// The same table powers the public "Your Sponsored Center(s)" page.

require_once __DIR__ . '/includes/auth.php';

define('CLP_CENTERS_TABLE', 'mdl_local_centermanagement_centers');

$page_title = 'Sponsored Center Details';

$db = clp_db_connect();

$id = (int)($_GET['id'] ?? 0);
$record = null;
if ($id) {
    $stmt = $db->prepare("SELECT * FROM " . CLP_CENTERS_TABLE . " WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $record = clp_stmt_fetch_assoc($stmt);
    $stmt->close();
}

$db->close();

if (!$record) {
    clp_set_error('Center record not found.');
    clp_redirect(CLP_ADMIN_URL . '/centers.php');
}

$ctype = strtolower($record['center_type'] ?? 'clc');
$typeLabel = $ctype === 'scr' ? 'Smart Classroom (SCR)' : 'Computer Literacy Center (CLC)';
$isActive = !empty($record['status']);

$formatDate = function ($ts) {
    return (!empty($ts) && (int)$ts > 0) ? date('F j, Y', (int)$ts) : '—';
};

$fields = [
    'Center Code'   => $record['center_code'],
    'Center Name'   => $record['center_name'],
    'Center Type'   => $typeLabel,
    'Division'      => $record['division'],
    'District'      => $record['district'],
    'Upazila'       => $record['upazila'],
    'Address'       => $record['address'],
    'Contact Person' => $record['contact_person'],
    'Contact Number' => $record['contact_number'],
    'Email'         => $record['email'],
    'Establishment Date' => $formatDate($record['establishment_date']),
    'Start Date'    => $formatDate($record['start_date']),
    'Support'       => $record['support'],
    'Sponsor Name'  => $record['sponsor_name'],
    'Devices Count' => $record['devices_count'],
    'Students Count' => $record['students_count'],
    'Status'        => $isActive ? 'Enabled' : 'Disabled',
    'Description'   => $record['description'],
    'Mailing Address' => $record['mailing_address'],
    'History of the Center' => $record['history_of_center'],
    'Description of the Center' => $record['description_of_center'],
    'Contact Person with Phone/Email' => $record['contact_person_details'],
    'Accomplishment' => $record['accomplishment'],
    'Current Status' => $record['current_status'],
    'HM Teacher Name' => $record['hm_teacher_name'],
    'HM Phone Number' => $record['hm_phone_number'],
    'HM Email' => $record['hm_email'],
    'CLC Teacher Name' => $record['clc_teacher_name'],
    'CLC Teacher Email' => $record['clc_teacher_email'],
    'CLC Teacher Phone' => $record['clc_teacher_phone'],
    'SCR Teacher Name' => $record['scr_teacher_name'],
    'SCR Teacher Email' => $record['scr_teacher_email'],
    'SCR Teacher Phone' => $record['scr_teacher_phone'],
    'Global Classroom' => $record['global_classroom'],
    'CLP PI English Club' => $record['program_clp_pi_english_club'],
    'EGL English' => $record['program_egl_english'],
    'EGL Math' => $record['program_egl_math'],
    'CSAW' => $record['program_csaw'],
    'School Grading' => strtoupper($record['school_grading']),
    'CLC Graduate Students' => $record['clc_graduate_students'],
    'SCR Benefited Students' => $record['scr_benefited_students'],
    'Hardware Status' => $record['hardware_status'],
    'Last Visit Date' => $formatDate($record['last_visit_date']),
    'Follow-up Over Phone' => $record['follow_up_over_phone'],
    'Last Follow-up Date' => $formatDate($record['last_follow_up_date']),
];

$sections = [
    'Basic Information' => [
        'Center Code' => $record['center_code'],
        'Center Name' => $record['center_name'],
        'Center Type' => $typeLabel,
        'Status' => $isActive ? 'Enabled' : 'Disabled',
    ],
    'Location' => [
        'Division' => $record['division'],
        'District' => $record['district'],
        'Upazila' => $record['upazila'],
        'Address' => $record['address'],
        'Mailing Address' => $record['mailing_address'],
    ],
    'Contact Information' => [
        'Contact Person' => $record['contact_person'],
        'Contact Number' => $record['contact_number'],
        'Email' => $record['email'],
        'Contact Person with Phone/Email' => $record['contact_person_details'],
    ],
    'Institution Information' => [
        'Support' => $record['support'],
        'Sponsor Name' => $record['sponsor_name'],
        'Description' => $record['description'],
        'History of the Center' => $record['history_of_center'],
        'Description of the Center' => $record['description_of_center'],
        'Accomplishment' => $record['accomplishment'],
    ],
    'Important Dates' => [
        'Establishment Date' => $formatDate($record['establishment_date']),
        'Start Date' => $formatDate($record['start_date']),
        'Last Visit Date' => $formatDate($record['last_visit_date']),
        'Last Follow-up Date' => $formatDate($record['last_follow_up_date']),
    ],
    'Instructor / Coordinator' => [
        'HM Teacher Name' => $record['hm_teacher_name'],
        'HM Phone Number' => $record['hm_phone_number'],
        'HM Email' => $record['hm_email'],
        'CLC Teacher Name' => $record['clc_teacher_name'],
        'CLC Teacher Email' => $record['clc_teacher_email'],
        'CLC Teacher Phone' => $record['clc_teacher_phone'],
        'SCR Teacher Name' => $record['scr_teacher_name'],
        'SCR Teacher Email' => $record['scr_teacher_email'],
        'SCR Teacher Phone' => $record['scr_teacher_phone'],
    ],
    'Programs' => [
        'Global Classroom' => $record['global_classroom'],
        'CLP PI English Club' => $record['program_clp_pi_english_club'],
        'EGL English' => $record['program_egl_english'],
        'EGL Math' => $record['program_egl_math'],
        'CSAW' => $record['program_csaw'],
        'School Grading' => strtoupper($record['school_grading']),
    ],
    'Statistics' => [
        'Devices Count' => $record['devices_count'],
        'Students Count' => $record['students_count'],
        'CLC Graduate Students' => $record['clc_graduate_students'],
        'SCR Benefited Students' => $record['scr_benefited_students'],
    ],
    'Additional Information' => [
        'Hardware Status' => $record['hardware_status'],
        'Current Status' => $record['current_status'],
        'Follow-up Over Phone' => $record['follow_up_over_phone'],
    ],
];

$sectionHasData = function ($fields) {
    foreach ($fields as $value) {
        if ($value !== '' && $value !== null && $value !== '—') {
            return true;
        }
    }
    return false;
};

$sections = array_filter($sections, function ($fields) {
    foreach ($fields as $value) {
        if ($value !== '' && $value !== null && $value !== '—') {
            return true;
        }
    }
    return false;
}, ARRAY_FILTER_USE_BOTH);

include __DIR__ . '/includes/header.php';
?>

<div class="content-area center-detail-page">
    <!-- Page Header -->
    <div class="center-detail-header">
        <div class="center-detail-header-left">
            <a href="<?php echo CLP_ADMIN_URL; ?>/centers.php" class="btn-back">
                <i class="fas fa-arrow-left"></i> Back to Centers
            </a>
            <div class="center-detail-title-group">
                <h1 class="center-detail-title"><?php echo clp_escape($record['center_name']); ?></h1>
                <span class="center-detail-code">
                    <i class="fas fa-code"></i>
                    <?php echo clp_escape($record['center_code']); ?>
                </span>
            </div>
        </div>
        <div class="center-detail-header-actions">
            <span class="badge badge-<?php echo $ctype === 'scr' ? 'info' : 'secondary'; ?>">
                <?php echo $typeLabel; ?>
            </span>
            <span class="badge badge-<?php echo $isActive ? 'success' : 'secondary'; ?>">
                <?php echo $isActive ? 'Enabled' : 'Disabled'; ?>
            </span>
            <a href="<?php echo CLP_ADMIN_URL; ?>/centers_form.php?id=<?php echo (int)$record['id']; ?>" class="btn btn-sm btn-success">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="<?php echo CLP_ADMIN_URL; ?>/centers.php?action=delete&id=<?php echo (int)$record['id']; ?>" class="btn btn-sm btn-danger confirm-delete">
                <i class="fas fa-trash"></i> Delete
            </a>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="center-summary-grid">
        <div class="summary-card">
            <div class="summary-icon blue"><i class="fas fa-building"></i></div>
            <div class="summary-content">
                <span class="summary-label">Center Type</span>
                <span class="summary-value"><?php echo clp_escape($typeLabel); ?></span>
            </div>
        </div>
        <div class="summary-card">
            <div class="summary-icon <?php echo $isActive ? 'green' : 'orange'; ?>">
                <i class="fas fa-<?php echo $isActive ? 'check-circle' : 'times-circle'; ?>"></i>
            </div>
            <div class="summary-content">
                <span class="summary-label">Status</span>
                <span class="summary-value"><?php echo $isActive ? 'Enabled' : 'Disabled'; ?></span>
            </div>
        </div>
        <div class="summary-card">
            <div class="summary-icon purple"><i class="fas fa-map-marker-alt"></i></div>
            <div class="summary-content">
                <span class="summary-label">Location</span>
                <span class="summary-value"><?php echo clp_escape($record['district'] ?: '—'); ?></span>
            </div>
        </div>
        <div class="summary-card">
            <div class="summary-icon green"><i class="fas fa-calendar"></i></div>
            <div class="summary-content">
                <span class="summary-label">Established</span>
                <span class="summary-value"><?php echo $formatDate($record['establishment_date']); ?></span>
            </div>
        </div>
    </div>

    <!-- Detail Sections -->
    <?php foreach ($sections as $sectionTitle => $fields): ?>
        <div class="detail-section">
            <div class="detail-section-header">
                <i class="fas fa-circle"></i>
                <h3 class="detail-section-title"><?php echo clp_escape($sectionTitle); ?></h3>
            </div>
            <div class="detail-field-grid">
                <?php foreach ($fields as $label => $value): ?>
                    <?php
                        $isEmpty = $value === '' || $value === null || $value === '—';
                        $displayValue = $isEmpty ? '—' : clp_escape($value);
                        $fullWidth = in_array($label, [
                            'Description',
                            'History of the Center',
                            'Description of the Center',
                            'Accomplishment',
                            'Contact Person with Phone/Email',
                            'Address',
                            'Mailing Address',
                            'Hardware Status',
                        ], true);
                    ?>
                    <div class="detail-field<?php echo $fullWidth ? ' full-width' : ''; ?>">
                        <span class="detail-field-label"><?php echo clp_escape($label); ?></span>
                        <span class="detail-field-value<?php echo $isEmpty ? ' empty' : ''; ?>"><?php echo $displayValue; ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- Media Section -->
    <div class="center-media-section">
        <h3><i class="fas fa-images"></i> Media</h3>
        <?php
        $id = (int)$_GET['id'];
        $mediaTypes = [
            'banner_images' => 'Banner Images',
            'plaque_gallery' => 'Plaque Images',
            'school_photo_gallery' => 'School Photos',
        ];
        $fileareaMap = [
            'banner_images' => 'banner_images',
            'plaque_gallery' => 'plaque_images',
            'school_photo_gallery' => 'school_photos',
        ];
        foreach ($mediaTypes as $tableSuffix => $label) {
            $table = 'mdl_local_centermanagement_' . $tableSuffix;
            $filearea = $fileareaMap[$tableSuffix];
            $items = [];
            if ($res = $db->query("SELECT filename, alt_text, is_featured, sortorder FROM {$table} WHERE center_id = " . (int)$id . " ORDER BY sortorder ASC, id ASC")) {
                while ($row = $res->fetch_assoc()) {
                    $items[] = $row;
                }
            }
            if (!empty($items)): ?>
                <div class="media-block">
                    <h4><?php echo $label; ?></h4>
                    <div class="media-grid">
                        <?php foreach ($items as $item): ?>
                            <div class="media-card">
                                <img src="<?php echo clp_uploaded_file_url($filearea, $item['filename']); ?>"
                                     alt="<?php echo clp_escape($item['alt_text']); ?>"
                                     loading="lazy">
                                <div class="media-card-meta">
                                    <span><?php echo clp_escape($item['filename']); ?></span>
                                    <?php if ($item['alt_text']): ?><small>Alt: <?php echo clp_escape($item['alt_text']); ?></small><?php endif; ?>
                                    <?php if ($item['is_featured']): ?><span class="badge badge-success">Featured</span><?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif;
        }
        ?>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
