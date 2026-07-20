<?php
// CLP Admin Panel - Root Router
// Handles /clp-admin/ directory access

require_once __DIR__ . '/includes/functions.php';

// If already logged in, redirect to dashboard
if (clp_is_logged_in()) {
    clp_redirect(CLP_ADMIN_URL . '/dashboard.php');
}

// Not logged in, redirect to login
clp_redirect(CLP_ADMIN_URL . '/login.php');
