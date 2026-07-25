<?php
// CLP Admin Panel - EOS Reports Management (List)

require_once __DIR__ . '/includes/auth.php';

$page_title = 'EOS Reports Management';
$admin = clp_get_admin();

$db = clp_db_connect();

// Handle delete
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("DELETE FROM clp_eos_reports WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        clp_set_success('Report deleted successfully.');
    } else {
        clp_set_error('Failed to delete report.');
    }
    $stmt->close();
    clp_redirect(CLP_ADMIN_URL . '/eos-reports.php');
}

// Handle status toggle
if (isset($_GET['action']) && $_GET['action'] === 'toggle' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("UPDATE clp_eos_reports SET status = IF(status = 'published', 'draft', 'published') WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        clp_set_success('Status updated successfully.');
    } else {
        clp_set_error('Failed to update status.');
    }
    $stmt->close();
    clp_redirect(CLP_ADMIN_URL . '/eos-reports.php');
}

// Get all EOS reports
$result = $db->query("SELECT * FROM clp_eos_reports ORDER BY display_order ASC, id DESC");
$reports = [];
while ($row = $result->fetch_assoc()) {
    $reports[] = $row;
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
            <h3 class="card-title"><i class="fas fa-file-pdf"></i> EOS Evaluation Reports</h3>
            <a href="<?php echo CLP_ADMIN_URL; ?>/eos-reports_form.php" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Report</a>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>PDF File</th>
                        <th>Status</th>
                        <th>Order</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($reports)): ?>
                        <tr><td colspan="7" style="text-align: center; color: #999;">No reports found. <a href="<?php echo CLP_ADMIN_URL; ?>/eos-reports_form.php">Add your first report</a>.</td></tr>
                    <?php else: ?>
                        <?php foreach ($reports as $report): ?>
                            <tr>
                                <td><strong><?php echo clp_escape($report['title']); ?></strong></td>
                                <td><code><?php echo clp_escape($report['slug']); ?></code></td>
                                <td><?php echo clp_escape(basename($report['pdf_path'])); ?></td>
                                <td>
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/eos-reports.php?action=toggle&id=<?php echo $report['id']; ?>" class="badge <?php echo $report['status'] === 'published' ? 'badge-success' : 'badge-warning'; ?>">
                                        <?php echo ucfirst(clp_escape($report['status'])); ?>
                                    </a>
                                </td>
                                <td><?php echo (int)$report['display_order']; ?></td>
                                <td><?php echo clp_format_date($report['updated_at']); ?></td>
                                <td>
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/eos-reports_form.php?id=<?php echo $report['id']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/eos-reports.php?action=delete&id=<?php echo $report['id']; ?>" class="btn btn-sm btn-danger confirm-delete" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i> Delete</a>
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
