<?php
// CLP Admin Panel - Logout

require_once __DIR__ . '/includes/functions.php';

// Destroy session and redirect
clp_logout();
clp_redirect(CLP_ADMIN_URL . '/login.php');
