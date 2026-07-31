<?php
// CLP Admin Panel - Save media metadata
// (alt_text, is_featured, sortorder).

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/functions.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method',
    ]);
    exit;
}

$centerId = (int)($_POST['center_id'] ?? 0);
$filearea = clp_sanitize($_POST['filearea'] ?? '');
$filename = clp_sanitize($_POST['filename'] ?? '');
$action = clp_sanitize($_POST['action'] ?? '');
$id = (int)($_POST['id'] ?? 0);

if (
    $centerId <= 0 ||
    $filearea === '' ||
    $filename === '' ||
    $action === '' ||
    $id <= 0
) {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid parameters',
    ]);
    exit;
}

// Get the correct Moodle database table name from functions.php.
$table = clp_media_table_name($filearea);

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
            'message' => 'Media record not found',
        ]);
        exit;
    }

    switch ($action) {
        case 'update_alt':
            $altText = clp_sanitize($_POST['alt_text'] ?? '');

            $success = $db->set_field(
                $table,
                'alt_text',
                $altText,
                $criteria
            );

            echo json_encode([
                'success' => (bool)$success,
                'message' => $success
                    ? 'Alternative text updated successfully'
                    : 'Unable to update alternative text',
            ]);
            break;

        case 'toggle_featured':
            $isFeatured = !empty($_POST['is_featured']) ? 1 : 0;

            $success = $db->set_field(
                $table,
                'is_featured',
                $isFeatured,
                $criteria
            );

            echo json_encode([
                'success' => (bool)$success,
                'message' => $success
                    ? 'Featured status updated successfully'
                    : 'Unable to update featured status',
            ]);
            break;

        case 'update_order':
            $newOrder = max(
                0,
                (int)($_POST['sortorder'] ?? 0)
            );

            $success = $db->set_field(
                $table,
                'sortorder',
                $newOrder,
                $criteria
            );

            echo json_encode([
                'success' => (bool)$success,
                'message' => $success
                    ? 'Sort order updated successfully'
                    : 'Unable to update sort order',
            ]);
            break;

        default:
            echo json_encode([
                'success' => false,
                'message' => 'Unknown action',
            ]);
            break;
    }
} catch (Throwable $exception) {
    error_log(
        'CLP media metadata error: ' . $exception->getMessage()
    );

    echo json_encode([
        'success' => false,
        'message' => 'An error occurred while updating media metadata',
    ]);
}

exit;