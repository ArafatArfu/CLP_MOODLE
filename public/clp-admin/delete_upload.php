<?php
// CLP Admin Panel - Delete uploaded file.

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/functions.php';

header('Content-Type: application/json; charset=utf-8');

$response = [
    'success' => false,
    'message' => 'Invalid request',
];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode($response);
    exit;
}

$centerId = (int)($_POST['center_id'] ?? 0);
$filearea = clp_sanitize($_POST['filearea'] ?? '');
$filename = clp_sanitize($_POST['filename'] ?? '');
$id = (int)($_POST['id'] ?? 0);

if (
    $centerId <= 0 ||
    $filearea === '' ||
    $filename === '' ||
    $id <= 0
) {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid parameters',
    ]);
    exit;
}

// Moodle database table names without the configured prefix.
$tableMap = [
    'banner_images' => 'local_centermanagement_banner_images',
    'plaque_images' => 'local_centermanagement_plaque_gallery',
    'school_photos' => 'local_centermanagement_school_photo_gallery',
];

$table = $tableMap[$filearea] ?? null;

if ($table === null) {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid file area',
    ]);
    exit;
}

$criteria = [
    'id' => $id,
    'center_id' => $centerId,
    'filename' => $filename,
];

try {
    $db = clp_db();

    if (!$db->record_exists($table, $criteria)) {
        echo json_encode([
            'success' => false,
            'message' => 'Record not found',
        ]);
        exit;
    }

    $deleted = $db->delete_records($table, $criteria);

    if (!$deleted) {
        echo json_encode([
            'success' => false,
            'message' => 'Unable to delete the database record',
        ]);
        exit;
    }

    clp_delete_file($filearea, $filename, $centerId);

    echo json_encode([
        'success' => true,
        'message' => 'File deleted successfully',
    ]);
    exit;
} catch (Throwable $exception) {
    error_log(
        'CLP file deletion error: ' . $exception->getMessage()
    );

    echo json_encode([
        'success' => false,
        'message' => 'An error occurred while deleting the file',
    ]);
    exit;
}