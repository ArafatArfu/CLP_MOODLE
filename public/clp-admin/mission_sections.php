<?php
// CLP Admin Panel - Mission Sections Management (List)

require_once __DIR__ . '/includes/auth.php';

$page_title = 'Mission Sections Management';

$db = clp_db_connect();

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("DELETE FROM clp_mission_sections WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        clp_set_success('Mission section deleted successfully.');
    } else {
        clp_set_error('Failed to delete mission section.');
    }
    $stmt->close();
    clp_redirect(CLP_ADMIN_URL . '/mission_sections.php');
}

$result = $db->query("SELECT * FROM clp_mission_sections ORDER BY display_order ASC, created_at DESC");
$sections = [];
while ($row = $result->fetch_assoc()) {
    $sections[] = $row;
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
            <h3 class="card-title"><i class="fas fa-th-large"></i> Mission Sections Management</h3>
            <a href="<?php echo CLP_ADMIN_URL; ?>/mission_section_form.php" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Section</a>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Section Key</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Display Order</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($sections)): ?>
                        <tr><td colspan="6" style="text-align: center; color: #999;">No mission sections found. <a href="<?php echo CLP_ADMIN_URL; ?>/mission_section_form.php">Add your first section</a>.</td></tr>
                    <?php else: ?>
                        <?php foreach ($sections as $section): ?>
                            <tr>
                                <td><code><?php echo clp_escape($section['section_key']); ?></code></td>
                                <td><strong><?php echo clp_escape($section['title']); ?></strong></td>
                                <td>
                                    <span class="badge <?php echo $section['status'] === 'published' ? 'badge-success' : 'badge-warning'; ?>">
                                        <?php echo ucfirst(clp_escape($section['status'])); ?>
                                    </span>
                                </td>
                                <td><?php echo (int)$section['display_order']; ?></td>
                                <td><?php echo clp_format_date($section['updated_at']); ?></td>
                                <td>
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/mission_section_form.php?id=<?php echo $section['id']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/mission_sections.php?action=delete&id=<?php echo $section['id']; ?>" class="btn btn-sm btn-danger confirm-delete"><i class="fas fa-trash"></i> Delete</a>
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
