<?php
// CLP Admin Panel - Footer Settings Management (List)

require_once __DIR__ . '/includes/auth.php';

$page_title = 'Footer Management';

$db = clp_db_connect();

// Ensure table exists.
$db->query("CREATE TABLE IF NOT EXISTS clp_footer_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) NOT NULL UNIQUE,
    setting_value TEXT NOT NULL,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

$result = $db->query("SELECT * FROM clp_footer_settings ORDER BY setting_key ASC");
$settings = [];
while ($row = $result->fetch_assoc()) {
    $settings[] = $row;
}

$db->close();

include __DIR__ . '/includes/header.php';
?>

<div class="content-area">
    <?php $success = clp_get_message('clp_success'); ?>
    <?php $error = clp_get_message('clp_error'); ?>
    <?php if ($success): ?>
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?php echo clp_escape($success); ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> <?php echo clp_escape($error); ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-shoe-prints"></i> Footer Management</h3>
            <a href="<?php echo CLP_ADMIN_URL; ?>/footer_form.php" class="btn btn-primary"><i class="fas fa-edit"></i> Edit Footer Content</a>
        </div>
        <div class="card-body">
            <p style="color: #666; margin-bottom: 20px;">Manage all footer content from one place, including logo, about text, contact info, social links, resources, quick links, and copyright.</p>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Setting Key</th>
                            <th>Value Preview</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($settings)): ?>
                            <tr><td colspan="4" style="text-align: center; color: #999;">No footer settings found. Click <strong>Edit Footer Content</strong> to add them.</td></tr>
                        <?php else: ?>
                            <?php foreach ($settings as $setting): ?>
                                <tr>
                                    <td><code><?php echo clp_escape($setting['setting_key']); ?></code></td>
                                    <td><?php echo clp_escape(mb_strimwidth($setting['setting_value'], 0, 100, '...')); ?></td>
                                    <td><?php echo clp_format_date($setting['updated_at']); ?></td>
                                    <td>
                                        <a href="<?php echo CLP_ADMIN_URL; ?>/footer_form.php" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
