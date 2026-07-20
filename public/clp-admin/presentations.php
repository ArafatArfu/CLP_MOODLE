<?php
// CLP Admin Panel - Presentations Management (List)

require_once __DIR__ . '/includes/auth.php';

$page_title = 'Presentations Management';

$db = clp_db_connect();

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("DELETE FROM clp_presentations WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        clp_set_success('Presentation deleted successfully.');
    } else {
        clp_set_error('Failed to delete presentation.');
    }
    $stmt->close();
    clp_redirect(CLP_ADMIN_URL . '/presentations.php');
}

$result = $db->query("SELECT * FROM clp_presentations ORDER BY display_order ASC, created_at DESC");
$presentations = [];
while ($row = $result->fetch_assoc()) {
    $presentations[] = $row;
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
            <h3 class="card-title"><i class="fas fa-file-powerpoint"></i> Presentations Management</h3>
            <a href="<?php echo CLP_ADMIN_URL; ?>/presentation_form.php" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Presentation</a>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>File URL</th>
                        <th>File Type</th>
                        <th>Status</th>
                        <th>Display Order</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($presentations)): ?>
                        <tr><td colspan="6" style="text-align: center; color: #999;">No presentations found. <a href="<?php echo CLP_ADMIN_URL; ?>/presentation_form.php">Add your first presentation</a>.</td></tr>
                    <?php else: ?>
                        <?php foreach ($presentations as $pres): ?>
                            <tr>
                                <td><strong><?php echo clp_escape($pres['title']); ?></strong></td>
                                <td><a href="<?php echo clp_escape($pres['file_url']); ?>" target="_blank" class="text-link"><?php echo clp_escape($pres['file_url']); ?></a></td>
                                <td>
                                    <span class="badge badge-info"><?php echo strtoupper(clp_escape($pres['file_type'])); ?></span>
                                </td>
                                <td>
                                    <span class="badge <?php echo $pres['status'] === 'published' ? 'badge-success' : 'badge-warning'; ?>">
                                        <?php echo ucfirst(clp_escape($pres['status'])); ?>
                                    </span>
                                </td>
                                <td><?php echo (int)$pres['display_order']; ?></td>
                                <td>
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/presentation_form.php?id=<?php echo $pres['id']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/presentations.php?action=delete&id=<?php echo $pres['id']; ?>" class="btn btn-sm btn-danger confirm-delete"><i class="fas fa-trash"></i> Delete</a>
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
