<?php
// CLP Admin Panel - Configuration and Helper Functions
// Uses Moodle APIs ($DB, File API) via moodle_bootstrap.php

// Admin Panel Configuration
define('CLP_ADMIN_URL', 'http://moodle-clp.local/clp-admin');
define('CLP_SITE_NAME', 'CLP Admin Panel');
define('CLP_SITE_TITLE', 'Computer Literacy Program');

// Database Configuration (kept for backward compatibility with non-center pages)
define('CLP_DB_HOST', '127.0.0.1');
define('CLP_DB_NAME', 'moodle_db');
define('CLP_DB_USER', 'root');
define('CLP_DB_PASS', 'Admin@12345');
define('CLP_DB_PREFIX', 'clp_');

// Moodle file storage constants
define('CLP_FILE_COMPONENT', 'local_centermanagement');
define('CLP_IMAGE_AREAS', ['banner_images', 'plaque_images', 'school_photos']);

// Session Configuration (isolated from Moodle's PHPSESSID session).
// Uses a dedicated session name and cookie scoped to /clp-admin/.
if (!defined('CLP_SESSION_NAME')) {
    define('CLP_SESSION_NAME', 'CLP_ADMIN_SESS');
}
if (!defined('CLP_SESSION_EXPIRE')) {
    define('CLP_SESSION_EXPIRE', 3600 * 2);
}

// Bootstrap Moodle if not already loaded (provides $DB, $CFG, $USER, File API)
if (!defined('MOODLE_INTERNAL')) {
    require_once __DIR__ . '/../moodle_bootstrap.php';
}

// Start PHP session if not already started.
// Configure session name and cookie params for isolation from Moodle's session.
if (session_status() === PHP_SESSION_NONE) {
    session_name(CLP_SESSION_NAME);
    session_set_cookie_params(CLP_SESSION_EXPIRE, '/clp-admin/', 'moodle-clp.local', false, true);
    session_start();
}

/**
 * Get Moodle $DB instance
 */
function clp_db() {
    global $DB;
    return $DB;
}

/**
 * Backward compatibility wrapper for raw MySQL connections.
 * Prefer using Moodle $DB via clp_db() for Center Management operations.
 */
function clp_db_connect() {
    return new mysqli(CLP_DB_HOST, CLP_DB_USER, CLP_DB_PASS, CLP_DB_NAME);
}

/**
 * Get Moodle file storage instance
 */
function clp_fs() {
    return get_file_storage();
}

/**
 * Get Moodle system context
 */
function clp_context() {
    return \context_system::instance();
}

// Secure password hash
function clp_hash_password($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Verify password
function clp_verify_password($password, $hash) {
    return password_verify($password, $hash);
}

// Escape output for security
function clp_escape($string) {
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}

// Redirect to URL
function clp_redirect($url) {
    if (session_status() === PHP_SESSION_ACTIVE) {
        session_write_close();
    }
    header('Location: ' . $url);
    exit;
}

// Check if admin is logged in (data stored in Moodle session under 'clp_admin' key)
function clp_is_logged_in() {
    return isset($_SESSION['clp_admin']['id']) && isset($_SESSION['clp_admin']['username']);
}

// Get current admin user
function clp_get_admin() {
    if (!clp_is_logged_in()) {
        return null;
    }
    return [
        'id' => $_SESSION['clp_admin']['id'],
        'username' => $_SESSION['clp_admin']['username'],
        'full_name' => $_SESSION['clp_admin']['full_name'] ?? '',
        'role' => $_SESSION['clp_admin']['role'] ?? 'admin',
    ];
}

// Require admin login (redirect if not logged in)
function clp_require_login() {
    if (!clp_is_logged_in()) {
        clp_redirect(CLP_ADMIN_URL . '/login.php');
    }
    
    if (isset($_SESSION['clp_admin']['last_activity']) && (time() - $_SESSION['clp_admin']['last_activity'] > CLP_SESSION_EXPIRE)) {
        clp_logout();
        clp_redirect(CLP_ADMIN_URL . '/login.php?timeout=1');
    }
    
    $_SESSION['clp_admin']['last_activity'] = time();
}

// Logout admin
function clp_logout() {
    unset($_SESSION['clp_admin']);
    $cookieName = defined('CLP_SESSION_NAME') ? CLP_SESSION_NAME : session_name();
    if (isset($_COOKIE[$cookieName])) {
        setcookie($cookieName, '', time() - 3600, '/clp-admin/', 'moodle-clp.local', false, true);
    }
}

// Get CSRF token
function clp_csrf_token() {
    if (!isset($_SESSION['clp_csrf_token'])) {
        $_SESSION['clp_csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['clp_csrf_token'];
}

// Verify CSRF token
function clp_verify_csrf($token) {
    return isset($_SESSION['clp_csrf_token']) && hash_equals($_SESSION['clp_csrf_token'], $token);
}

// Sanitize input
function clp_sanitize($input) {
    if (is_array($input)) {
        return array_map('clp_sanitize', $input);
    }
    return htmlspecialchars(trim($input ?? ''), ENT_QUOTES, 'UTF-8');
}

// Format date
function clp_format_date($date, $format = 'M d, Y') {
    if (empty($date)) return '';
    return date($format, strtotime($date));
}

// Show success message
function clp_set_success($message) {
    $_SESSION['clp_success'] = $message;
}

// Show error message
function clp_set_error($message) {
    $_SESSION['clp_error'] = $message;
}

// Get and clear flash message
function clp_get_message($type) {
    if (isset($_SESSION[$type])) {
        $msg = $_SESSION[$type];
        unset($_SESSION[$type]);
        return $msg;
    }
    return null;
}

/**
 * Upload a file to Moodle File API and return the stored filename.
 */
function clp_upload_file(array $file, string $filearea, int $centerId): ?string {
    if (empty($file['tmp_name']) || $file['error'] !== UPLOAD_ERR_OK) {
        return null;
    }

    // Validate actual MIME type using fileinfo
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($mimeType, $allowedTypes, true)) {
        return null;
    }

    $maxBytes = 5 * 1024 * 1024; // 5MB.
    if ($file['size'] > $maxBytes) {
        return null;
    }

    $originalName = $file['name'];
    $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
    $safeBase = preg_replace('/[^a-z0-9]/i', '', pathinfo($originalName, PATHINFO_FILENAME));
    if ($safeBase === '') {
        $safeBase = 'image';
    }
    $filename = $safeBase . '_' . $centerId . '_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;

    $context = \context_system::instance();
    $fs = get_file_storage();

    $filerecord = [
        'contextid' => $context->id,
        'component' => 'local_centermanagement',
        'filearea' => $filearea,
        'itemid' => $centerId,
        'filepath' => '/',
        'filename' => $filename,
    ];

    try {
        $fileobj = $fs->create_file_from_pathname($filerecord, $file['tmp_name']);
        if ($fileobj) {
            return $fileobj->get_filename();
        }
    } catch (Exception $e) {
        error_log('CLP upload error: ' . $e->getMessage());
    }

    return null;
}

/**
 * Return the Moodle database table name for a media file area.
 *
 * Moodle's Database API expects table names without the configured prefix.
 */
function clp_media_table_name(string $filearea): ?string {
    $tableMap = [
        'banner_images' => 'local_centermanagement_banner_images',
        'plaque_images' => 'local_centermanagement_plaque_gallery',
        'school_photos' => 'local_centermanagement_school_photo_gallery',
    ];

    return $tableMap[$filearea] ?? null;
}

/**
 * Delete a file from Moodle File API and its media database table.
 */
function clp_delete_file(string $filearea, string $filename, int $centerId = 0): void {
    $table = clp_media_table_name($filearea);

    if ($table === null) {
        return;
    }

    $context = \context_system::instance();
    $fs = get_file_storage();

    $files = $fs->get_area_files(
        $context->id,
        'local_centermanagement',
        $filearea,
        $centerId,
        'id',
        false
    );

    foreach ($files as $file) {
        if ($file->get_filename() === $filename) {
            $file->delete();
        }
    }

    if ($centerId > 0) {
        clp_db()->delete_records(
            $table,
            [
                'center_id' => $centerId,
                'filename' => $filename,
            ]
        );
    } else {
        clp_db()->delete_records_select(
            $table,
            'filename = ?',
            [$filename]
        );
    }
}

/**
 * Get all filenames for a center and file area.
 */
function clp_get_uploaded_files(int $centerId, string $filearea): array {
    $table = clp_media_table_name($filearea);

    if ($table === null) {
        return [];
    }

    $files = [];

    $records = clp_db()->get_records(
        $table,
        ['center_id' => $centerId],
        'sortorder ASC, id ASC'
    );

    foreach ($records as $record) {
        $files[] = $record->filename;
    }

    return $files;
}

/**
 * Delete all files for a center/file area from Moodle storage and database.
 */
function clp_delete_all_files(int $centerId, string $filearea): void {
    $table = clp_media_table_name($filearea);

    if ($table === null) {
        return;
    }

    $context = \context_system::instance();
    $fs = get_file_storage();

    $files = $fs->get_area_files(
        $context->id,
        'local_centermanagement',
        $filearea,
        $centerId,
        'id',
        false
    );

    foreach ($files as $file) {
        $file->delete();
    }

    clp_db()->delete_records(
        $table,
        ['center_id' => $centerId]
    );
}

/**
 * Build the public pluginfile URL for an uploaded file.
 */
function clp_uploaded_file_url(string $filearea, string $filename, int $centerId = 0): string {
    $context = \context_system::instance();
    return (string) \moodle_url::make_pluginfile_url(
        $context->id,
        'local_centermanagement',
        $filearea,
        $centerId,
        '/',
        $filename
    );
}

/**
 * Validate a center record has required fields.
 */
function clp_validate_center_record(array $record): array {
    $errors = [];

    if (empty($record['center_code'])) {
        $errors['center_code'] = 'Center code is required.';
    }
    if (empty($record['center_name'])) {
        $errors['center_name'] = 'Center name is required.';
    }
    if (empty($record['center_type']) || !in_array($record['center_type'], ['clc', 'scr', 'clc_scr', 'other'], true)) {
        $errors['center_type'] = 'Valid center type is required.';
    }
    if (empty($record['division'])) {
        $errors['division'] = 'Division is required.';
    }
    if (empty($record['district'])) {
        $errors['district'] = 'District is required.';
    }
    if (!empty($record['email']) && !filter_var($record['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format.';
    }

    return $errors;
}
