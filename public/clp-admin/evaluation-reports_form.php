<?php
// CLP Admin Panel - Evaluation Report Form (Add/Edit)

require_once __DIR__ . '/includes/auth.php';

$page_title = 'Evaluation Report Form';
$admin = clp_get_admin();

$db = clp_db_connect();

$report = [
    'id' => '',
    'title' => 'Independent Evaluation Report',
    'slug' => 'independent-evaluation-report',
    'content_left' => '',
    'content_right' => '',
    'image_path' => '',
    'pdf_path' => '',
    'modal_title' => 'INDEPENDENT EVALUATION REPORT',
    'button_text' => 'View the Report',
    'display_order' => 1,
    'status' => 'published'
];

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("SELECT * FROM clp_evaluation_reports WHERE id = ? LIMIT 1");
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
    $report['content_left'] = trim($_POST['content_left'] ?? '');
    $report['content_right'] = trim($_POST['content_right'] ?? '');
    $report['image_path'] = clp_sanitize($_POST['image_path'] ?? '');
    $report['pdf_path'] = clp_sanitize($_POST['pdf_path'] ?? '');
    $report['modal_title'] = clp_sanitize($_POST['modal_title'] ?? '');
    $report['button_text'] = clp_sanitize($_POST['button_text'] ?? 'View the Report');
    $report['display_order'] = (int)($_POST['display_order'] ?? 0);
    $report['status'] = clp_sanitize($_POST['status'] ?? 'draft');

    if (empty($report['title'])) {
        clp_set_error('Title is required.');
    } else {
        if (!empty($report['id'])) {
            $stmt = $db->prepare("UPDATE clp_evaluation_reports SET title=?, slug=?, content_left=?, content_right=?, image_path=?, pdf_path=?, modal_title=?, button_text=?, display_order=?, status=? WHERE id=?");
            $stmt->bind_param("ssssssssisi", 
                $report['title'], $report['slug'], $report['content_left'], $report['content_right'],
                $report['image_path'], $report['pdf_path'], $report['modal_title'],
                $report['button_text'], $report['display_order'], $report['status'], $report['id']
            );
        } else {
            $stmt = $db->prepare("INSERT INTO clp_evaluation_reports (title, slug, content_left, content_right, image_path, pdf_path, modal_title, button_text, display_order, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssssis", 
                $report['title'], $report['slug'], $report['content_left'], $report['content_right'],
                $report['image_path'], $report['pdf_path'], $report['modal_title'],
                $report['button_text'], $report['display_order'], $report['status']
            );
        }

        if ($stmt->execute()) {
            clp_set_success(!empty($report['id']) ? 'Report updated successfully.' : 'Report created successfully.');
            $stmt->close();
            $db->close();
            clp_redirect(CLP_ADMIN_URL . '/evaluation-reports.php');
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
            <h3 class="card-title"><?php echo !empty($report['id']) ? 'Edit Evaluation Report' : 'Add New Evaluation Report'; ?></h3>
            <a href="<?php echo CLP_ADMIN_URL; ?>/evaluation-reports.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to List</a>
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
                <label class="form-label">Left Column Content (HTML)</label>
                <textarea name="content_left" class="form-control" rows="6"><?php echo clp_escape($report['content_left']); ?></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Right/Bottom Column Content (HTML)</label>
                <textarea name="content_right" class="form-control" rows="6"><?php echo clp_escape($report['content_right']); ?></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Image Path</label>
                <input type="text" name="image_path" class="form-control" value="<?php echo clp_escape($report['image_path']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">PDF Path</label>
                <input type="text" name="pdf_path" class="form-control" value="<?php echo clp_escape($report['pdf_path']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Modal Title</label>
                <input type="text" name="modal_title" class="form-control" value="<?php echo clp_escape($report['modal_title']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Button Text</label>
                <input type="text" name="button_text" class="form-control" value="<?php echo clp_escape($report['button_text']); ?>">
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
            <a href="<?php echo CLP_ADMIN_URL; ?>/evaluation-reports.php" class="btn btn-primary">Cancel</a>
        </form>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
