<?php
// CLP Admin Panel - EOS Report Form (Add/Edit)

require_once __DIR__ . '/includes/auth.php';

$page_title = 'EOS Report Form';
$admin = clp_get_admin();

$db = clp_db_connect();

$report = [
    'id' => '',
    'title' => '',
    'slug' => '',
    'description' => '',
    'pdf_path' => '',
    'cover_image' => '',
    'display_order' => 0,
    'status' => 'draft'
];

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("SELECT * FROM clp_eos_reports WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    if ($row = clp_stmt_fetch_assoc($stmt)) {
        $report = $row;
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $report['title'] = clp_sanitize($_POST['title'] ?? '');
    $report['slug'] = clp_sanitize($_POST['slug'] ?? '');
    $report['description'] = trim($_POST['description'] ?? '');
    $report['pdf_path'] = clp_sanitize($_POST['pdf_path'] ?? '');
    $report['cover_image'] = clp_sanitize($_POST['cover_image'] ?? '');
    $report['display_order'] = (int)($_POST['display_order'] ?? 0);
    $report['status'] = clp_sanitize($_POST['status'] ?? 'draft');

    if (empty($report['title'])) {
        clp_set_error('Title is required.');
    } else {
        if (!empty($report['id'])) {
            $stmt = $db->prepare("UPDATE clp_eos_reports SET title=?, slug=?, description=?, pdf_path=?, cover_image=?, display_order=?, status=? WHERE id=?");
            $stmt->bind_param("sssssisi", 
                $report['title'], $report['slug'], $report['description'],
                $report['pdf_path'], $report['cover_image'],
                $report['display_order'], $report['status'], $report['id']
            );
        } else {
            $stmt = $db->prepare("INSERT INTO clp_eos_reports (title, slug, description, pdf_path, cover_image, display_order, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", 
                $report['title'], $report['slug'], $report['description'],
                $report['pdf_path'], $report['cover_image'],
                $report['display_order'], $report['status']
            );
        }

        if ($stmt->execute()) {
            clp_set_success(!empty($report['id']) ? 'Report updated successfully.' : 'Report created successfully.');
            $stmt->close();
            $db->close();
            clp_redirect(CLP_ADMIN_URL . '/eos-reports.php');
        } else {
            clp_set_error('Failed to save report.');
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
            <h3 class="card-title"><?php echo !empty($report['id']) ? 'Edit EOS Report' : 'Add New EOS Report'; ?></h3>
            <a href="<?php echo CLP_ADMIN_URL; ?>/eos-reports.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to List</a>
        </div>
        <form method="POST" action="">
            <div class="form-group">
                <label class="form-label">Title *</label>
                <input type="text" name="title" class="form-control" required value="<?php echo clp_escape($report['title']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Slug</label>
                <input type="text" name="slug" class="form-control" value="<?php echo clp_escape($report['slug']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Short Description (for listings)</label>
                <textarea name="description" class="form-control" rows="3"><?php echo clp_escape($report['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">PDF Path *</label>
                <input type="text" name="pdf_path" class="form-control" required value="<?php echo clp_escape($report['pdf_path']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Cover Image Path</label>
                <input type="text" name="cover_image" class="form-control" value="<?php echo clp_escape($report['cover_image']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Display Order</label>
                <input type="number" name="display_order" class="form-control" value="<?php echo (int)$report['display_order']; ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="draft" <?php echo $report['status'] === 'draft' ? 'selected' : ''; ?>>Draft</option>
                    <option value="published" <?php echo $report['status'] === 'published' ? 'selected' : ''; ?>>Published</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
            <a href="<?php echo CLP_ADMIN_URL; ?>/eos-reports.php" class="btn btn-primary">Cancel</a>
        </form>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
