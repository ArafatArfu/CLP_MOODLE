<?php
// CLP Admin Panel - Impact Management (List)

require_once __DIR__ . '/includes/auth.php';

$page_title = 'Impact Management';

$db = clp_db_connect();

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("DELETE FROM clp_about_impact WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        clp_set_success('Impact item deleted successfully.');
    } else {
        clp_set_error('Failed to delete impact item.');
    }
    $stmt->close();
    clp_redirect(CLP_ADMIN_URL . '/impact.php');
}

if (isset($_GET['action']) && $_GET['action'] === 'toggle' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("UPDATE clp_about_impact SET status = IF(status = 'published', 'draft', 'published') WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        clp_set_success('Status updated successfully.');
    } else {
        clp_set_error('Failed to update status.');
    }
    $stmt->close();
    clp_redirect(CLP_ADMIN_URL . '/impact.php');
}

$result = $db->query("SELECT * FROM clp_about_impact ORDER BY display_order ASC, created_at DESC");
$impact_items = [];
while ($row = $result->fetch_assoc()) {
    $impact_items[] = $row;
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
            <h3 class="card-title"><i class="fas fa-chart-line"></i> Impact Management</h3>
            <a href="<?php echo CLP_ADMIN_URL; ?>/impact_form.php" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Impact</a>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Stat Value</th>
                        <th>Stat Label</th>
                        <th>Status</th>
                        <th>Display Order</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($impact_items)): ?>
                        <tr><td colspan="7" style="text-align: center; color: #999;">No impact items found. <a href="<?php echo CLP_ADMIN_URL; ?>/impact_form.php">Add your first impact</a>.</td></tr>
                    <?php else: ?>
                        <?php foreach ($impact_items as $item): ?>
                            <tr>
                                <td><strong><?php echo clp_escape($item['title']); ?></strong></td>
                                <td><?php echo clp_escape($item['stat_value']); ?></td>
                                <td><?php echo clp_escape($item['stat_label']); ?></td>
                                <td>
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/impact.php?action=toggle&id=<?php echo $item['id']; ?>" class="badge <?php echo $item['status'] === 'published' ? 'badge-success' : 'badge-warning'; ?>">
                                        <?php echo ucfirst($item['status']); ?>
                                    </a>
                                </td>
                                <td><?php echo (int)$item['display_order']; ?></td>
                                <td><?php echo clp_format_date($item['updated_at']); ?></td>
                                <td>
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/impact_form.php?id=<?php echo $item['id']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/impact.php?action=delete&id=<?php echo $item['id']; ?>" class="btn btn-sm btn-danger confirm-delete"><i class="fas fa-trash"></i> Delete</a>
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
