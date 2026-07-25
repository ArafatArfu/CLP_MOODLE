<?php
// CLP Admin Panel - Magazines Management (List)

require_once __DIR__ . '/includes/auth.php';

$page_title = 'Magazines Management';
$admin = clp_get_admin();

$db = clp_db_connect();

// Handle delete
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("DELETE FROM clp_magazines WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        clp_set_success('Magazine deleted successfully.');
    } else {
        clp_set_error('Failed to delete magazine.');
    }
    $stmt->close();
    clp_redirect(CLP_ADMIN_URL . '/magazines_admin.php');
}

// Handle status toggle
if (isset($_GET['action']) && $_GET['action'] === 'toggle' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("UPDATE clp_magazines SET status = IF(status = 'published', 'draft', 'published') WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        clp_set_success('Status updated successfully.');
    } else {
        clp_set_error('Failed to update status.');
    }
    $stmt->close();
    clp_redirect(CLP_ADMIN_URL . '/magazines_admin.php');
}

// Get all magazines
$result = $db->query("SELECT * FROM clp_magazines ORDER BY display_order ASC, year DESC");
$magazines = [];
while ($row = $result->fetch_assoc()) {
    $magazines[] = $row;
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
        <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> <?php echo clp_edge($error); ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-book"></i> Magazines</h3>
            <a href="<?php echo CLP_ADMIN_URL; ?>/magazines_form.php" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Magazine</a>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Year</th>
                        <th>PDF File</th>
                        <th>Cover Image</th>
                        <th>Status</th>
                        <th>Order</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($magazines)): ?>
                        <tr><td colspan="8" style="text-align: center; color: #999;">No magazines found. <a href="<?php echo CLP_ADMIN_URL; ?>/magazines_form.php">Add your first magazine</a>.</td></tr>
                    <?php else: ?>
                        <?php foreach ($magazines as $mag): ?>
                            <tr>
                                <td><strong><?php echo clp_escape($mag['title']); ?></strong></td>
                                <td><?php echo (int)$mag['year']; ?></td>
                                <td><?php echo clp_escape(basename($mag['pdf_path'])); ?></td>
                                <td><?php echo clp_escape(basename($mag['cover_image'])); ?></td>
                                <td>
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/magazines_admin.php?action=toggle&id=<?php echo $mag['id']; ?>" class="badge <?php echo $mag['status'] === 'published' ? 'badge-success' : 'badge-warning'; ?>">
                                        <?php echo ucfirst(clp_escape($mag['status'])); ?>
                                    </a>
                                </td>
                                <td><?php echo (int)$mag['display_order']; ?></td>
                                <td><?php echo clp_format_date($mag['updated_at']); ?></td>
                                <td>
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/magazines_form.php?id=<?php echo $mag['id']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/magazines_admin.php?action=delete&id=<?php echo $mag['id']; ?>" class="btn btn-sm btn-danger confirm-delete" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i> Delete</a>
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
