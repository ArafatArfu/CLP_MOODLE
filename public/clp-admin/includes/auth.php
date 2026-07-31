<?php
// CLP Admin Panel - Authentication Middleware
// Uses a dedicated session namespace isolated from Moodle's session handler.

define('CLP_SESSION_NAME', 'CLP_ADMIN_SESS');
define('CLP_SESSION_EXPIRE', 3600 * 2);

session_name(CLP_SESSION_NAME);
session_set_cookie_params(CLP_SESSION_EXPIRE, '/clp-admin/', 'moodle-clp.local', false, true);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../moodle_bootstrap.php';
require_once __DIR__ . '/functions.php';

// Handle logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    clp_logout();
    clp_redirect(CLP_ADMIN_URL . '/login.php');
}

// If not logged in and not on login page, redirect to login
$current_page = basename($_SERVER['PHP_SELF']);
$allowed_pages = ['login.php'];

if (!clp_is_logged_in() && !in_array($current_page, $allowed_pages)) {
    clp_redirect(CLP_ADMIN_URL . '/login.php');
}

// If logged in and trying to access login page, redirect to dashboard
if (clp_is_logged_in() && $current_page === 'login.php') {
    clp_redirect(CLP_ADMIN_URL . '/dashboard.php');
}
