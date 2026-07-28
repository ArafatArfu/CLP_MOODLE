<?php
// CLP Admin Panel - Delete uploaded file.
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/functions.php';

$response = ['success' => false, 'message' => 'Invalid request'];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode($response);
    exit;
}

$centerId = (int)($_POST['center_id'] ?? 0);
$filearea = clp_sanitize($_POST['filearea'] ?? '');
$filename = clp_sanitize($_POST['filename'] ?? '');

if ($centerId <= 0 || $filearea === '' || $filename === '') {
    echo json_encode(['success' => false, 'message' => 'Invalid parameters']);
    exit;
}

$db = clp_db_connect();
$prefix = CLP_DB_PREFIX;
$table = $prefix . 'local_centermanagement_' . $filearea;

$stmt = $db->prepare("DELETE FROM {$table} WHERE center_id = ? AND filename = ?");
$stmt->bind_param("is", $centerId, $filename);
$ok = $stmt->execute();
$stmt->close();
$db->close();

if ($ok) {
    clp_delete_file($filearea, $filename);
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Database error']);
}
