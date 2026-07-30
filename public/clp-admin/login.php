<?php
// CLP Admin Panel - Login Page

// Start output buffering to prevent "headers already sent" errors
ob_start();

require_once __DIR__ . '/includes/auth.php';

// If already logged in, redirect to dashboard
if (clp_is_logged_in()) {
    clp_redirect(CLP_ADMIN_URL . '/dashboard.php');
}

$error = '';
$timeout = isset($_GET['timeout']) && $_GET['timeout'] == '1';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = clp_sanitize($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $csrfToken = $_POST['csrf_token'] ?? '';
    
    if (!clp_verify_csrf($csrfToken)) {
        $error = 'Invalid security token. Please try again.';
    } elseif (empty($username) || empty($password)) {
        $error = 'Please enter both username and password.';
    } else {
        global $DB;
        $sql = "SELECT id, username, password, full_name, role, status
                  FROM clp_admin_users
                 WHERE username = :username AND status = 'active'
                 LIMIT 1";
        $user = $DB->get_record_sql($sql, ['username' => $username]);
        
        if ($user && clp_verify_password($password, $user->password)) {
            $_SESSION['clp_admin'] = [
                'id' => $user->id,
                'username' => $user->username,
                'full_name' => $user->full_name,
                'role' => $user->role,
                'last_activity' => time(),
            ];
            
            $DB->execute("UPDATE clp_admin_users SET last_login = :now WHERE id = :id", [
                'now' => date('Y-m-d H:i:s'),
                'id' => $user->id,
            ]);
            
            ob_end_clean();
            clp_redirect(CLP_ADMIN_URL . '/dashboard.php');
        } else {
            $error = 'Invalid username or password.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | <?php echo CLP_SITE_TITLE; ?></title>
    <link href="/theme/clp/assets/images/favicon-icon.png" rel="icon" sizes="32x32" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo CLP_ADMIN_URL; ?>/assets/css/admin.css">
</head>
<body>
    <div class="login-page">
        <div class="login-container">
            <div class="login-logo">
                <img src="/theme/clp/assets/images/logo/clp-logo-2022-4.png" alt="CLP Logo">
                <h2><?php echo CLP_SITE_TITLE; ?></h2>
                <p>Admin Panel Login</p>
            </div>
            
            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo clp_escape($error); ?>
                </div>
            <?php endif; ?>
            
            <?php if ($timeout): ?>
                <div class="alert alert-warning">
                    <i class="fas fa-clock"></i>
                    Your session has expired. Please login again.
                </div>
            <?php endif; ?>
            
            <form method="POST" action="<?php echo CLP_ADMIN_URL; ?>/login.php" class="login-form">
                <input type="hidden" name="csrf_token" value="<?php echo clp_csrf_token(); ?>">
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-group">
                        <span class="input-group-icon"><i class="fas fa-user"></i></span>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username" required autofocus value="<?php echo isset($_POST['username']) ? clp_escape($_POST['username']) : ''; ?>">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <span class="input-group-icon"><i class="fas fa-lock"></i></span>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                    </div>
                </div>
                
                <button type="submit" class="login-btn">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>
            
            <div class="login-footer">
                <a href="/"><i class="fas fa-arrow-left"></i> Back to Website</a>
            </div>
        </div>
    </div>
    
    <style>
        .input-group {
            position: relative;
        }
        .input-group-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }
        .input-group .form-control {
            padding-left: 44px;
        }
    </style>
</body>
</html>

