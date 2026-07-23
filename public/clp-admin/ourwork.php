<?php
// CLP Admin Panel - Our Work Pages (List)

require_once __DIR__ . '/includes/auth.php';

$page_title = 'Our Work Pages Management';

$db = clp_db_connect();

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("DELETE FROM clp_ourwork_pages WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        clp_set_success('Page deleted successfully.');
    } else {
        clp_set_error('Failed to delete page.');
    }
    $stmt->close();
    clp_redirect(CLP_ADMIN_URL . '/ourwork.php');
}

if (isset($_GET['action']) && $_GET['action'] === 'toggle' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("UPDATE clp_ourwork_pages SET status = IF(status = 'published', 'draft', 'published') WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        clp_set_success('Status updated successfully.');
    } else {
        clp_set_error('Failed to update status.');
    }
    $stmt->close();
    clp_redirect(CLP_ADMIN_URL . '/ourwork.php');
}

$result = $db->query("SELECT * FROM clp_ourwork_pages ORDER BY display_order ASC, title ASC");
$pages = [];
while ($row = $result->fetch_assoc()) {
    $pages[] = $row;
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
            <h3 class="card-title"><i class="fas fa-newspaper"></i> Our Work Pages</h3>
            <a href="<?php echo CLP_ADMIN_URL; ?>/ourwork_form.php" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Page</a>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>SEO Title</th>
                        <th>Status</th>
                        <th>Order</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pages)): ?>
                        <tr><td colspan="7" style="text-align: center; color: #999;">No pages found. <a href="<?php echo CLP_ADMIN_URL; ?>/ourwork_form.php">Add your first page</a>.</td></tr>
                    <?php else: ?>
                        <?php foreach ($pages as $page): ?>
                            <tr>
                                <td><strong><?php echo clp_escape($page['title']); ?></strong></td>
                                <td><code><?php echo clp_escape($page['slug']); ?></code></td>
                                <td><?php echo clp_escape($page['seo_title'] ?? ''); ?></td>
                                <td>
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/ourwork.php?action=toggle&id=<?php echo $page['id']; ?>" class="badge <?php echo $page['status'] === 'published' ? 'badge-success' : 'badge-warning'; ?>">
                                        <?php echo ucfirst(clp_escape($page['status'])); ?>
                                    </a>
                                </td>
                                <td><?php echo (int)$page['display_order']; ?></td>
                                <td><?php echo clp_format_date($page['updated_at']); ?></td>
                                <td>
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/ourwork_form.php?id=<?php echo $page['id']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/ourwork.php?action=delete&id=<?php echo $page['id']; ?>" class="btn btn-sm btn-danger confirm-delete"><i class="fas fa-trash"></i> Delete</a>
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
