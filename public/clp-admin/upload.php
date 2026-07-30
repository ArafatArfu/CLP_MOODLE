<?php
// CLP Admin Panel - AJAX File Upload Handler.
//
// Handles uploads for center management CMS (banners, plaques, school photos).
// Returns JSON response with file info.

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/functions.php';

header('Content-Type: application/json');

$response = ['success' => false, 'message' => 'Invalid request'];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode($response);
    exit;
}

$centerId = (int)($_POST['center_id'] ?? 0);
$filearea = clp_sanitize($_POST['filearea'] ?? '');

if ($centerId <= 0 || $filearea === '') {
    echo json_encode(['success' => false, 'message' => 'Invalid parameters']);
    exit;
}

$allowedAreas = ['banner_images', 'plaque_images', 'school_photos'];
if (!in_array($filearea, $allowedAreas, true)) {
    echo json_encode(['success' => false, 'message' => 'Invalid file area']);
    exit;
}

if (empty($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(['success' => false, 'message' => 'No file uploaded or upload error']);
    exit;
}

$file = $_FILES['file'];

$filename = clp_upload_file($file, $filearea, $centerId);
if (!$filename) {
    echo json_encode(['success' => false, 'message' => 'Failed to save file']);
    exit;
}

$prefix = clp_db()->get_prefix();
$table = $prefix . 'local_centermanagement_' . $filearea;

$sortorder = 0;
$maxSort = clp_db()->get_field_sql("SELECT MAX(sortorder) FROM {$table} WHERE center_id = ?", [$centerId]);
if ($maxSort !== false && $maxSort !== null) {
    $sortorder = (int)$maxSort + 1;
}

$now = time();
$recordId = clp_db()->insert_record($filearea, (object)[
    'center_id' => $centerId,
    'filename' => $filename,
    'sortorder' => $sortorder,
    'timecreated' => $now,
    'timemodified' => $now,
]);

if ($recordId) {
    $fileUrl = clp_uploaded_file_url($filearea, $filename, $centerId);
    echo json_encode([
        'success' => true,
        'filename' => $filename,
        'url' => $fileUrl,
        'alt_text' => '',
        'is_featured' => 0,
        'sortorder' => $sortorder,
        'id' => $recordId,
    ]);
} else {
    clp_delete_file($filearea, $filename, $centerId);
    echo json_encode(['success' => false, 'message' => 'Database error']);
}
