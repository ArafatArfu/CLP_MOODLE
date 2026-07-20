<?php
// CLP Admin Panel - Presentation Form (Add/Edit)

require_once __DIR__ . '/includes/auth.php';

$page_title = 'Presentation Form';

$db = clp_db_connect();
$presentation = [
    'id' => '',
    'title' => '',
    'file_url' => '',
    'file_type' => 'pdf',
    'display_order' => 0,
    'status' => 'draft'
];

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("SELECT * FROM clp_presentations WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    if ($row = clp_stmt_fetch_assoc($stmt)) {
        $presentation = $row;
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $presentation['title'] = clp_sanitize($_POST['title'] ?? '');
    $presentation['file_url'] = clp_sanitize($_POST['file_url'] ?? '');
    $presentation['file_type'] = clp_sanitize($_POST['file_type'] ?? 'pdf');
    $presentation['display_order'] = (int)($_POST['display_order'] ?? 0);
    $presentation['status'] = clp_sanitize($_POST['status'] ?? 'draft');

    if (empty($presentation['title']) || empty($presentation['file_url'])) {
        clp_set_error('Title and file URL are required.');
    } else {
        if (!empty($presentation['id'])) {
            $stmt = $db->prepare("UPDATE clp_presentations SET title=?, file_url=?, file_type=?, display_order=?, status=? WHERE id=?");
            $stmt->bind_param("sssisi", $presentation['title'], $presentation['file_url'], $presentation['file_type'], $presentation['display_order'], $presentation['status'], $presentation['id']);
        } else {
            $stmt = $db->prepare("INSERT INTO clp_presentations (title, file_url, file_type, display_order, status) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssis", $presentation['title'], $presentation['file_url'], $presentation['file_type'], $presentation['display_order'], $presentation['status']);
        }

        if ($stmt->execute()) {
            clp_set_success(!empty($presentation['id']) ? 'Presentation updated successfully.' : 'Presentation created successfully.');
            $stmt->close();
            $db->close();
            clp_redirect(CLP_ADMIN_URL . '/presentations.php');
        } else {
            clp_set_error('Failed to save presentation.');
        }
        $stmt->close();
    }
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
            <h3 class="card-title"><?php echo !empty($presentation['id']) ? 'Edit Presentation' : 'Add New Presentation'; ?></h3>
            <a href="<?php echo CLP_ADMIN_URL; ?>/presentations.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to List</a>
        </div>
        <form method="POST" action="">
            <div class="form-group">
                <label class="form-label">Title *</label>
                <input type="text" name="title" class="form-control" required value="<?php echo clp_escape($presentation['title']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">File URL *</label>
                <input type="text" name="file_url" class="form-control" required value="<?php echo clp_escape($presentation['file_url']); ?>">
                <small class="form-text">Enter the full URL or path to the presentation file.</small>
            </div>
            <div class="form-group">
                <label class="form-label">File Type</label>
                <select name="file_type" class="form-control">
                    <option value="pdf" <?php echo $presentation['file_type'] === 'pdf' ? 'selected' : ''; ?>>PDF</option>
                    <option value="ppt" <?php echo $presentation['file_type'] === 'ppt' ? 'selected' : ''; ?>>PPT</option>
                    <option value="doc" <?php echo $presentation['file_type'] === 'doc' ? 'selected' : ''; ?>>DOC</option>
                    <option value="other" <?php echo $presentation['file_type'] === 'other' ? 'selected' : ''; ?>>Other</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Display Order</label>
                <input type="number" name="display_order" class="form-control" value="<?php echo (int)$presentation['display_order']; ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="draft" <?php echo $presentation['status'] === 'draft' ? 'selected' : ''; ?>>Draft</option>
                    <option value="published" <?php echo $presentation['status'] === 'published' ? 'selected' : ''; ?>>Published</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
            <a href="<?php echo CLP_ADMIN_URL; ?>/presentations.php" class="btn btn-primary">Cancel</a>
        </form>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
