<?php
// CLP Admin Panel - Impact Bullets Management (List)

require_once __DIR__ . '/includes/auth.php';

$page_title = 'Impact Bullets Management';

$db = clp_db_connect();

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("DELETE FROM clp_impact_bullets WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        clp_set_success('Impact bullet deleted successfully.');
    } else {
        clp_set_error('Failed to delete impact bullet.');
    }
    $stmt->close();
    clp_redirect(CLP_ADMIN_URL . '/impact_bullets.php');
}

$result = $db->query("SELECT * FROM clp_impact_bullets WHERE section_key = 'growth_expansion' ORDER BY display_order ASC, created_at DESC");
$bullets = [];
while ($row = $result->fetch_assoc()) {
    $bullets[] = $row;
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
            <h3 class="card-title"><i class="fas fa-list-ul"></i> Impact Bullets Management (Growth & Expansion)</h3>
            <a href="<?php echo CLP_ADMIN_URL; ?>/impact_bullet_form.php" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Bullet</a>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Bullet Text</th>
                        <th>Display Order</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($bullets)): ?>
                        <tr><td colspan="4" style="text-align: center; color: #999;">No bullets found. <a href="<?php echo CLP_ADMIN_URL; ?>/impact_bullet_form.php">Add your first bullet</a>.</td></tr>
                    <?php else: ?>
                        <?php foreach ($bullets as $bullet): ?>
                            <tr>
                                <td><?php echo nl2br(clp_escape($bullet['bullet_text'])); ?></td>
                                <td><?php echo (int)$bullet['display_order']; ?></td>
                                <td>
                                    <span class="badge <?php echo $bullet['status'] === 'published' ? 'badge-success' : 'badge-warning'; ?>">
                                        <?php echo ucfirst(clp_escape($bullet['status'])); ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/impact_bullet_form.php?id=<?php echo $bullet['id']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/impact_bullets.php?action=delete&id=<?php echo $bullet['id']; ?>" class="btn btn-sm btn-danger confirm-delete"><i class="fas fa-trash"></i> Delete</a>
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
