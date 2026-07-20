<?php
// CLP Admin Panel - Root Login Router
// Handles /login URL and redirects based on auth state

require_once __DIR__ . '/clp-admin/includes/functions.php';

// If already logged in as CLP admin, redirect to dashboard
if (clp_is_logged_in()) {
    clp_redirect(CLP_ADMIN_URL . '/dashboard.php');
}

// Not logged in - redirect to admin login form
clp_redirect(CLP_ADMIN_URL . '/login.php');
