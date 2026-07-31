<?php
// CLP Admin Panel - Login Page

// Prevent "headers already sent" errors.
ob_start();

require_once __DIR__ . '/includes/auth.php';

// Redirect already authenticated users.
if (clp_is_logged_in()) {
    clp_redirect(CLP_ADMIN_URL . '/dashboard.php');
}

$error = '';
$username = '';
$timeout = isset($_GET['timeout']) && $_GET['timeout'] === '1';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $csrfToken = $_POST['csrf_token'] ?? '';

    if (!clp_verify_csrf($csrfToken)) {
        $error = 'Invalid security token. Please try again.';
    } elseif ($username === '' || $password === '') {
        $error = 'Please enter both username and password.';
    } else {
        global $DB;

        $user = $DB->get_record(
            'clp_admin_users',
            [
                'username' => $username,
                'status' => 'active',
            ],
            'id, username, password, full_name, role, status'
        );

        if ($user && clp_verify_password($password, $user->password)) {
            // Prevent session fixation after successful login.
            if (session_status() === PHP_SESSION_ACTIVE) {
                session_regenerate_id(true);
            }

            $_SESSION['clp_admin'] = [
                'id' => (int) $user->id,
                'username' => $user->username,
                'full_name' => $user->full_name,
                'role' => $user->role,
                'last_activity' => time(),
            ];

            $DB->set_field(
                'clp_admin_users',
                'last_login',
                date('Y-m-d H:i:s'),
                ['id' => $user->id]
            );

            ob_end_clean();
            clp_redirect(CLP_ADMIN_URL . '/dashboard.php');
            exit;
        }

        $error = 'Invalid username or password.';
    }
}

$pageTitle = 'Admin Login | ' . CLP_SITE_TITLE;
$loginUrl = CLP_ADMIN_URL . '/login.php';
$adminCssUrl = CLP_ADMIN_URL . '/assets/css/admin.css';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo clp_escape($pageTitle); ?></title>

    <link
        href="/theme/clp/assets/images/favicon-icon.png"
        rel="icon"
        sizes="32x32"
        type="image/png"
    >

    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Inter:wght@300;400;500;600;700&display=swap"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    >

    <link
        rel="stylesheet"
        href="<?php echo clp_escape($adminCssUrl); ?>"
    >

    <style>
        .input-group {
            position: relative;
        }

        .input-group-icon {
            position: absolute;
            top: 50%;
            left: 16px;
            color: #999;
            pointer-events: none;
            transform: translateY(-50%);
        }

        .input-group .form-control {
            padding-left: 44px;
        }
    </style>
</head>
<body>
    <div class="login-page">
        <div class="login-container">
            <div class="login-logo">
                <img
                    src="/theme/clp/assets/images/logo/clp-logo-2022-4.png"
                    alt="CLP Logo"
                >

                <h2><?php echo clp_escape(CLP_SITE_TITLE); ?></h2>
                <p>Admin Panel Login</p>
            </div>

            <?php if ($error !== ''): ?>
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
                    <?php echo clp_escape($error); ?>
                </div>
            <?php endif; ?>

            <?php if ($timeout): ?>
                <div class="alert alert-warning" role="alert">
                    <i class="fas fa-clock" aria-hidden="true"></i>
                    Your session has expired. Please log in again.
                </div>
            <?php endif; ?>

            <form
                method="post"
                action="<?php echo clp_escape($loginUrl); ?>"
                class="login-form"
            >
                <input
                    type="hidden"
                    name="csrf_token"
                    value="<?php echo clp_escape(clp_csrf_token()); ?>"
                >

                <div class="form-group">
                    <label for="username">Username</label>

                    <div class="input-group">
                        <span class="input-group-icon">
                            <i class="fas fa-user" aria-hidden="true"></i>
                        </span>

                        <input
                            type="text"
                            id="username"
                            name="username"
                            class="form-control"
                            placeholder="Enter your username"
                            autocomplete="username"
                            value="<?php echo clp_escape($username); ?>"
                            required
                            autofocus
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>

                    <div class="input-group">
                        <span class="input-group-icon">
                            <i class="fas fa-lock" aria-hidden="true"></i>
                        </span>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control"
                            placeholder="Enter your password"
                            autocomplete="current-password"
                            required
                        >
                    </div>
                </div>

                <button type="submit" class="login-btn">
                    <i class="fas fa-sign-in-alt" aria-hidden="true"></i>
                    Login
                </button>
            </form>

            <div class="login-footer">
                <a href="/">
                    <i class="fas fa-arrow-left" aria-hidden="true"></i>
                    Back to Website
                </a>
            </div>
        </div>
    </div>
</body>
</html>