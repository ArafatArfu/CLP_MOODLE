<?php
// CLP Admin Panel - Save media metadata (alt_text, is_featured, sortorder).
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
$action = clp_sanitize($_POST['action'] ?? '');
$id = (int)($_POST['id'] ?? 0);

if ($centerId <= 0 || $filearea === '' || $filename === '' || $action === '' || $id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid parameters']);
    exit;
}

$prefix = clp_db()->get_prefix();
$table = $prefix . 'local_centermanagement_' . $filearea;

if ($action === 'update_alt') {
    $altText = clp_sanitize($_POST['alt_text'] ?? '');
    $ok = clp_db()->set_field($table, 'alt_text', $altText, ['id' => $id, 'center_id' => $centerId]);
    echo json_encode(['success' => $ok]);
} elseif ($action === 'toggle_featured') {
    $isFeatured = (int)($_POST['is_featured'] ?? 0);
    $ok = clp_db()->set_field($table, 'is_featured', $isFeatured, ['id' => $id, 'center_id' => $centerId]);
    if ($ok) {
        clp_db()->set_field($table, 'alt_text', '', ['id' => $id, 'center_id' => $centerId]);
    }
    echo json_encode(['success' => $ok]);
} elseif ($action === 'update_order') {
    $newOrder = (int)($_POST['sortorder'] ?? 0);
    $ok = clp_db()->set_field($table, 'sortorder', $newOrder, ['id' => $id, 'center_id' => $centerId]);
    echo json_encode(['success' => $ok]);
} else {
    echo json_encode(['success' => false, 'message' => 'Unknown action']);
}
