<?php
// CLP Admin Panel - Save media metadata (alt_text, is_featured, sortorder).
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
$action = clp_sanitize($_POST['action'] ?? '');

if ($centerId <= 0 || $filearea === '' || $filename === '' || $action === '') {
    echo json_encode(['success' => false, 'message' => 'Invalid parameters']);
    exit;
}

$db = clp_db_connect();
$prefix = CLP_DB_PREFIX;
$table = $prefix . 'local_centermanagement_' . $filearea;

if ($action === 'update_alt') {
    $altText = clp_sanitize($_POST['alt_text'] ?? '');
    $stmt = $db->prepare("UPDATE {$table} SET alt_text = ?, timemodified = ? WHERE center_id = ? AND filename = ?");
    $now = time();
    $stmt->bind_param("sisi", $altText, $now, $centerId, $filename);
    $ok = $stmt->execute();
    $stmt->close();
    echo json_encode(['success' => $ok]);
} elseif ($action === 'toggle_featured') {
    $isFeatured = (int)($_POST['is_featured'] ?? 0);
    $stmt = $db->prepare("UPDATE {$table} SET is_featured = ?, timemodified = ? WHERE center_id = ? AND filename = ?");
    $now = time();
    $stmt->bind_param("iiis", $isFeatured, $now, $centerId, $filename);
    $ok = $stmt->execute();
    $stmt->close();
    echo json_encode(['success' => $ok]);
} elseif ($action === 'update_order') {
    $newOrder = (int)($_POST['sortorder'] ?? 0);
    $stmt = $db->prepare("UPDATE {$table} SET sortorder = ?, timemodified = ? WHERE center_id = ? AND filename = ?");
    $now = time();
    $stmt->bind_param("iiis", $newOrder, $now, $centerId, $filename);
    $ok = $stmt->execute();
    $stmt->close();
    echo json_encode(['success' => $ok]);
} else {
    echo json_encode(['success' => false, 'message' => 'Unknown action']);
}

$db->close();
