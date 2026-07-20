<?php
// CLP Admin Panel - Page Settings Management (List)

require_once __DIR__ . '/includes/auth.php';

$page_title = 'Page Settings Management';

$db = clp_db_connect();

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("DELETE FROM clp_page_settings WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        clp_set_success('Page setting deleted successfully.');
    } else {
        clp_set_error('Failed to delete page setting.');
    }
    $stmt->close();
    clp_redirect(CLP_ADMIN_URL . '/page_settings.php');
}

$result = $db->query("SELECT * FROM clp_page_settings ORDER BY page_key ASC, updated_at DESC");
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
            <h3 class="card-title"><i class="fas fa-cog"></i> Page Settings Management</h3>
            <a href="<?php echo CLP_ADMIN_URL; ?>/page_settings_form.php" class="btn btn-primary"><i class="fas fa-edit"></i> Edit All Settings</a>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Page Key</th>
                        <th>Page Title</th>
                        <th>Breadcrumb Title</th>
                        <th>Status</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($settings)): ?>
                        <tr><td colspan="6" style="text-align: center; color: #999;">No page settings found.</td></tr>
                    <?php else: ?>
                        <?php foreach ($settings as $setting): ?>
                            <tr>
                                <td><code><?php echo clp_escape($setting['page_key']); ?></code></td>
                                <td><strong><?php echo clp_escape($setting['page_title']); ?></strong></td>
                                <td><?php echo clp_escape($setting['breadcrumb_title']); ?></td>
                                <td>
                                    <span class="badge <?php echo $setting['status'] === 'published' ? 'badge-success' : 'badge-warning'; ?>">
                                        <?php echo ucfirst(clp_escape($setting['status'])); ?>
                                    </span>
                                </td>
                                <td><?php echo clp_format_date($setting['updated_at']); ?></td>
                                <td>
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/page_settings_form.php?id=<?php echo $setting['page_key']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
