<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? clp_escape($page_title) : CLP_SITE_NAME; ?></title>
    <link href="/theme/clp/assets/images/favicon-icon.png" rel="icon" sizes="32x32" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo CLP_ADMIN_URL; ?>/assets/css/admin.css">
</head>
<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <?php include __DIR__ . '/sidebar.php'; ?>
        
        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Navigation -->
            <nav class="top-navbar">
                <div class="nav-left">
                    <button class="sidebar-toggle" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h3 class="page-title"><?php echo isset($page_title) ? clp_escape($page_title) : 'Dashboard'; ?></h3>
                </div>
                <div class="nav-right">
                    <div class="admin-profile">
                        <span class="admin-name"><?php echo clp_escape(clp_get_admin()['full_name'] ?? 'Admin'); ?></span>
                        <span class="admin-role"><?php echo clp_escape(ucfirst(clp_get_admin()['role'] ?? 'admin')); ?></span>
                    </div>
                    <a href="<?php echo CLP_ADMIN_URL; ?>/logout.php" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </nav>
