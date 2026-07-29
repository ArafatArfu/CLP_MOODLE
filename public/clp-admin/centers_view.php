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

include __DIR__ . '/includes/header.php';
?>

<div class="content-area">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-building"></i> Center Details</h3>
            <div>
                <a href="<?php echo CLP_ADMIN_URL; ?>/centers_form.php?id=<?php echo (int)$record['id']; ?>" class="btn btn-sm btn-success"><i class="fas fa-edit"></i> Edit</a>
                <a href="<?php echo CLP_ADMIN_URL; ?>/centers.php?action=delete&id=<?php echo (int)$record['id']; ?>" class="btn btn-sm btn-danger confirm-delete"><i class="fas fa-trash"></i> Delete</a>
                <a href="<?php echo CLP_ADMIN_URL; ?>/centers.php" class="btn btn-sm btn-primary"><i class="fas fa-arrow-left"></i> Back to List</a>
            </div>
        </div>

        <div class="clc-detail">
            <div class="clc-detail-head">
                <div class="clc-detail-avatar"><i class="fas fa-building"></i></div>
                <div>
                    <h2 class="clc-detail-name"><?php echo clp_escape($record['center_name']); ?></h2>
                    <p class="clc-detail-school"><i class="fas fa-code"></i> <?php echo clp_escape($record['center_code']); ?></p>
                </div>
                <span class="badge <?php echo $ctype === 'scr' ? 'badge-info' : 'badge-secondary'; ?>" style="margin-left:auto;">
                    <?php echo $typeLabel; ?>
                </span>
                <span class="badge <?php echo $isActive ? 'badge-success' : 'badge-secondary'; ?>" style="margin-left:8px;">
                    <?php echo $isActive ? 'Enabled' : 'Disabled'; ?>
                </span>
            </div>

            <div class="clc-detail-grid">
                <?php foreach ($fields as $label => $value): ?>
                    <div class="clc-detail-item">
                        <span class="clc-detail-label"><?php echo clp_escape($label); ?></span>
                        <span class="clc-detail-value"><?php echo $value !== '' && $value !== null ? clp_escape($value) : '<em style="color:#aaa;">—</em>'; ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="clc-media-section">
        <h3 class="clc-detail-section-title"><i class="fas fa-images"></i> Media</h3>
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
                <div class="clc-media-block">
                    <h4><?php echo $label; ?></h4>
                    <div class="clc-media-grid-view">
                        <?php foreach ($items as $item): ?>
                            <div class="clc-media-card">
                                <img src="<?php echo clp_uploaded_file_url($filearea, $item['filename']); ?>"
                                     alt="<?php echo clp_escape($item['alt_text']); ?>"
                                     style="width:120px; height:80px; object-fit:cover; border-radius:6px;">
                                <div class="clc-media-card-meta">
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

<style>
.clc-detail { padding: 24px; }
.clc-detail-head { display: flex; align-items: center; gap: 18px; padding-bottom: 22px; margin-bottom: 22px; border-bottom: 1px solid #eef0f4; flex-wrap: wrap; }
.clc-detail-avatar { width: 66px; height: 66px; border-radius: 50%; background: linear-gradient(135deg, #006b4f, #12b88c); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 28px; flex-shrink: 0; }
.clc-detail-name { margin: 0; font-size: 22px; color: #1d2125; }
.clc-detail-school { margin: 4px 0 0; color: #6a737b; font-size: 14px; }
.clc-detail-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px; }
.clc-detail-item { display: flex; flex-direction: column; gap: 4px; padding: 14px 16px; background: #f8f9fb; border: 1px solid #eef0f4; border-radius: 10px; }
.clc-detail-label { font-size: 11px; text-transform: uppercase; letter-spacing: .5px; font-weight: 700; color: #006b4f; }
.clc-detail-value { font-size: 15px; color: #3e4e4a; word-break: break-word; }
.clc-media-section { margin-top: 28px; padding-top: 22px; border-top: 2px solid #eef0f4; }
.clc-media-section h3 { font-size: 18px; color: #006b4f; margin: 0 0 18px; display: flex; align-items: center; gap: 8px; }
.clc-media-block { margin-bottom: 22px; padding: 18px; background: #f8f9fb; border: 1px solid #eef0f4; border-radius: 10px; }
.clc-media-block h4 { font-size: 15px; color: #3e4e4a; margin: 0 0 12px; }
.clc-media-grid-view { display: flex; flex-wrap: wrap; gap: 14px; }
.clc-media-card { background: #fff; border: 1px solid #eef0f4; border-radius: 8px; padding: 10px; width: 160px; }
.clc-media-card-meta { display: flex; flex-direction: column; gap: 4px; margin-top: 8px; font-size: 12px; color: #4a5560; }
</style>

<?php include __DIR__ . '/includes/footer.php'; ?>
