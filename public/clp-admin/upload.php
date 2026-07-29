<?php
// CLP Admin Panel - AJAX File Upload Handler.
//
// Handles uploads for center management CMS (banners, plaques, school photos).
// Returns JSON response with file info.

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/functions.php';

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

$allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
if (!in_array($file['type'], $allowedTypes, true)) {
    echo json_encode(['success' => false, 'message' => 'Invalid file type. Only JPG, PNG, GIF, WebP allowed']);
    exit;
}

$maxBytes = 5 * 1024 * 1024;
if ($file['size'] > $maxBytes) {
    echo json_encode(['success' => false, 'message' => 'File too large. Maximum 5MB']);
    exit;
}

$filename = clp_upload_file($file, $filearea, $centerId);
if (!$filename) {
    echo json_encode(['success' => false, 'message' => 'Failed to save file']);
    exit;
}

$altText = '';
$isFeatured = 0;

$db = clp_db_connect();
$fileareaTables = [
    'banner_images' => 'local_centermanagement_banner_images',
    'plaque_images' => 'local_centermanagement_plaque_gallery',
    'school_photos' => 'local_centermanagement_school_photo_gallery',
];
$table = $fileareaTables[$filearea];

$sortorder = 0;
if ($result = $db->query("SELECT MAX(sortorder) as max_sort FROM {$table} WHERE center_id = " . (int)$centerId)) {
    $row = $result->fetch_assoc();
    $sortorder = ((int)$row['max_sort'] ?? 0) + 1;
}

$now = time();
$stmt = $db->prepare("INSERT INTO {$table} (center_id, filename, alt_text, is_featured, sortorder, timecreated, timemodified) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issiiii", $centerId, $filename, $altText, $isFeatured, $sortorder, $now, $now);
$ok = $stmt->execute();
$stmt->close();

if ($ok) {
    $fileUrl = clp_uploaded_file_url($filearea, $filename);
    echo json_encode([
        'success' => true,
        'filename' => $filename,
        'url' => $fileUrl,
        'alt_text' => $altText,
        'is_featured' => $isFeatured,
        'sortorder' => $sortorder,
        'id' => $db->insert_id,
    ]);
} else {
    @unlink(CLP_ADMIN_UPLOAD_DIR . '/' . $filearea . '/' . $filename);
    echo json_encode(['success' => false, 'message' => 'Database error']);
}

$db->close();
