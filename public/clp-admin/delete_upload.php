<?php
// CLP Admin Panel - Delete uploaded file.
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
$filename = clp_sanitize($_POST['filename'] ?? '');
$id = (int)($_POST['id'] ?? 0);

if ($centerId <= 0 || $filearea === '' || $filename === '' || $id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid parameters']);
    exit;
}

$prefix = clp_db()->get_prefix();
$table = $prefix . 'local_centermanagement_' . $filearea;

$deleted = clp_db()->delete_records($table, ['id' => $id, 'center_id' => $centerId, 'filename' => $filename]);

if ($deleted) {
    clp_delete_file($filearea, $filename, $centerId);
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Record not found']);
}
