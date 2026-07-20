<?php
// CLP Admin Panel - Partners Management (List)

require_once __DIR__ . '/includes/auth.php';

$page_title = 'Partners Management';

$db = clp_db_connect();

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("DELETE FROM clp_partners WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        clp_set_success('Partner deleted successfully.');
    } else {
        clp_set_error('Failed to delete partner.');
    }
    $stmt->close();
    clp_redirect(CLP_ADMIN_URL . '/partners.php');
}

if (isset($_GET['action']) && $_GET['action'] === 'toggle' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("UPDATE clp_partners SET status = IF(status = 'published', 'draft', 'published') WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        clp_set_success('Status updated successfully.');
    } else {
        clp_set_error('Failed to update status.');
    }
    $stmt->close();
    clp_redirect(CLP_ADMIN_URL . '/partners.php');
}

$result = $db->query("SELECT * FROM clp_partners ORDER BY display_order ASC, created_at DESC");
$partner_items = [];
while ($row = $result->fetch_assoc()) {
    $partner_items[] = $row;
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
            <h3 class="card-title"><i class="fas fa-handshake"></i> Partners Management</h3>
            <a href="<?php echo CLP_ADMIN_URL; ?>/partners_form.php" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Partner</a>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Short Description</th>
                        <th>Website URL</th>
                        <th>Partner Type</th>
                        <th>Status</th>
                        <th>Display Order</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($partner_items)): ?>
                        <tr><td colspan="8" style="text-align: center; color: #999;">No partners found. <a href="<?php echo CLP_ADMIN_URL; ?>/partners_form.php">Add your first partner</a>.</td></tr>
                    <?php else: ?>
                        <?php foreach ($partner_items as $item): ?>
                            <tr>
                                <td><strong><?php echo clp_escape($item['name']); ?></strong></td>
                                <td><?php echo clp_escape(substr($item['short_description'], 0, 100)); ?>...</td>
                                <td><?php echo clp_escape($item['website_url']); ?></td>
                                <td><?php echo clp_escape($item['partner_type']); ?></td>
                                <td>
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/partners.php?action=toggle&id=<?php echo $item['id']; ?>" class="badge <?php echo $item['status'] === 'published' ? 'badge-success' : 'badge-warning'; ?>">
                                        <?php echo ucfirst($item['status']); ?>
                                    </a>
                                </td>
                                <td><?php echo (int)$item['display_order']; ?></td>
                                <td><?php echo clp_format_date($item['updated_at']); ?></td>
                                <td>
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/partners_form.php?id=<?php echo $item['id']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/partners.php?action=delete&id=<?php echo $item['id']; ?>" class="btn btn-sm btn-danger confirm-delete"><i class="fas fa-trash"></i> Delete</a>
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
