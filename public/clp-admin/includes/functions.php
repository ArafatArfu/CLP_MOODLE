<?php
// CLP Admin Panel - Configuration and Helper Functions

// Database Configuration
define('CLP_DB_HOST', '127.0.0.1');
define('CLP_DB_NAME', 'moodle_db');
define('CLP_DB_USER', 'root');
define('CLP_DB_PASS', 'Admin@12345');
define('CLP_DB_PREFIX', 'clp_');

// Admin Panel Configuration
define('CLP_ADMIN_URL', 'http://moodle-clp.local/clp-admin');
define('CLP_SITE_NAME', 'CLP Admin Panel');
define('CLP_SITE_TITLE', 'Computer Literacy Program');

// Session Configuration
define('CLP_SESSION_NAME', 'clp_admin_session');
define('CLP_SESSION_EXPIRE', 3600 * 2); // 2 hours

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_name(CLP_SESSION_NAME);
    session_start();
}

// Database Connection
function clp_db_connect() {
    $conn = new mysqli(CLP_DB_HOST, CLP_DB_USER, CLP_DB_PASS, CLP_DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $conn->set_charset("utf8mb4");
    return $conn;
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
    header("Location: $url");
    exit;
}

// Check if admin is logged in
function clp_is_logged_in() {
    return isset($_SESSION['clp_admin_id']) && isset($_SESSION['clp_admin_username']);
}

// Get current admin user
function clp_get_admin() {
    if (!clp_is_logged_in()) {
        return null;
    }
    return [
        'id' => $_SESSION['clp_admin_id'],
        'username' => $_SESSION['clp_admin_username'],
        'full_name' => $_SESSION['clp_admin_full_name'],
        'role' => $_SESSION['clp_admin_role']
    ];
}

// Require admin login (redirect if not logged in)
function clp_require_login() {
    if (!clp_is_logged_in()) {
        clp_redirect(CLP_ADMIN_URL . '/login.php');
    }
    
    // Check session expiration
    if (isset($_SESSION['clp_admin_last_activity']) && (time() - $_SESSION['clp_admin_last_activity'] > CLP_SESSION_EXPIRE)) {
        clp_logout();
        clp_redirect(CLP_ADMIN_URL . '/login.php?timeout=1');
    }
    
    $_SESSION['clp_admin_last_activity'] = time();
}

// Logout admin
function clp_logout() {
    $_SESSION = [];
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 3600, '/');
    }
    session_destroy();
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

// Fetch single row from prepared statement (works without mysqlnd get_result)
function clp_stmt_fetch_assoc($stmt) {
    $meta = $stmt->result_metadata();
    if (!$meta) {
        return null;
    }
    
    $fields = [];
    $row = [];
    while ($field = $meta->fetch_field()) {
        $fields[] = &$row[$field->name];
    }
    
    call_user_func_array([$stmt, 'bind_result'], $fields);
    
    if ($stmt->fetch()) {
        return $row;
    }
    
    return null;
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
