<?php
// CLP Admin Panel - AJAX File Upload Handler.
//
// Handles uploads for center management CMS
// (banners, plaques and school photos).
// Returns a JSON response containing the uploaded file information.

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/functions.php';

header('Content-Type: application/json; charset=utf-8');

/**
 * Send a JSON response and stop execution.
 */
function clp_upload_response(array $response): void {
    echo json_encode($response);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    clp_upload_response([
        'success' => false,
        'message' => 'Invalid request method',
    ]);
}

$centerId = (int)($_POST['center_id'] ?? 0);
$filearea = clp_sanitize($_POST['filearea'] ?? '');

if ($centerId <= 0 || $filearea === '') {
    clp_upload_response([
        'success' => false,
        'message' => 'Invalid parameters',
    ]);
}

$allowedAreas = [
    'banner_images',
    'plaque_images',
    'school_photos',
];

if (!in_array($filearea, $allowedAreas, true)) {
    clp_upload_response([
        'success' => false,
        'message' => 'Invalid file area',
    ]);
}

// Get the correct Moodle database table name.
$table = clp_media_table_name($filearea);

if ($table === null) {
    clp_upload_response([
        'success' => false,
        'message' => 'Invalid media table',
    ]);
}

if (
    empty($_FILES['file']) ||
    !isset($_FILES['file']['error']) ||
    $_FILES['file']['error'] !== UPLOAD_ERR_OK
) {
    clp_upload_response([
        'success' => false,
        'message' => 'No file uploaded or upload error',
    ]);
}

$file = $_FILES['file'];

// Save the uploaded file in Moodle file storage.
$filename = clp_upload_file(
    $file,
    $filearea,
    $centerId
);

if (!$filename) {
    clp_upload_response([
        'success' => false,
        'message' => 'Failed to save file',
    ]);
}

try {
    $db = clp_db();

    // Find the next sort order for this center and file area.
    $sortorder = 0;

    $maxSort = $db->get_field_sql(
        'SELECT MAX(sortorder)
           FROM {' . $table . '}
          WHERE center_id = ?',
        [$centerId]
    );

    if ($maxSort !== false && $maxSort !== null) {
        $sortorder = (int)$maxSort + 1;
    }

    $now = time();

    $record = (object)[
        'center_id' => $centerId,
        'filename' => $filename,
        'sortorder' => $sortorder,
        'timecreated' => $now,
        'timemodified' => $now,
    ];

    // Important: use the mapped Moodle table name, not $filearea.
    $recordId = $db->insert_record(
        $table,
        $record,
        true
    );

    if (!$recordId) {
        clp_delete_file(
            $filearea,
            $filename,
            $centerId
        );

        clp_upload_response([
            'success' => false,
            'message' => 'Database error',
        ]);
    }

    $fileUrl = clp_uploaded_file_url(
        $filearea,
        $filename,
        $centerId
    );

    clp_upload_response([
        'success' => true,
        'message' => 'File uploaded successfully',
        'id' => (int)$recordId,
        'filename' => $filename,
        'url' => $fileUrl,
        'alt_text' => '',
        'is_featured' => 0,
        'sortorder' => $sortorder,
    ]);
} catch (Throwable $exception) {
    // Remove the uploaded file if the database operation fails.
    clp_delete_file(
        $filearea,
        $filename,
        $centerId
    );

    error_log(
        'CLP upload error: ' . $exception->getMessage()
    );

    clp_upload_response([
        'success' => false,
        'message' => 'An error occurred while saving the uploaded file',
    ]);
}