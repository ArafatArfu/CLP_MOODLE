<?php
// CLP Admin Panel - History Form (Add/Edit)

require_once __DIR__ . '/includes/auth.php';

$page_title = 'History Form';
$admin = clp_get_admin();

$db = clp_db_connect();
$history = [
    'id' => '',
    'title' => '',
    'subtitle' => '',
    'short_description' => '',
    'full_description' => '',
    'featured_image' => '',
    'timeline_info' => '',
    'display_order' => 0,
    'status' => 'draft',
    'seo_title' => '',
    'seo_description' => ''
];

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("SELECT * FROM clp_about_history WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    if ($row = clp_stmt_fetch_assoc($stmt)) {
        $history = $row;
        $history['timeline_info'] = $row['timeline_info'] ?? '';
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $history['title'] = clp_sanitize($_POST['title'] ?? '');
    $history['subtitle'] = clp_sanitize($_POST['subtitle'] ?? '');
    $history['short_description'] = trim($_POST['short_description'] ?? '');
    $history['full_description'] = trim($_POST['full_description'] ?? '');
    $history['timeline_info'] = trim($_POST['timeline_info'] ?? '');
    $history['display_order'] = (int)($_POST['display_order'] ?? 0);
    $history['status'] = clp_sanitize($_POST['status'] ?? 'draft');
    $history['seo_title'] = clp_sanitize($_POST['seo_title'] ?? '');
    $history['seo_description'] = clp_sanitize($_POST['seo_description'] ?? '');

    if (empty($history['timeline_info'])) {
        $history['timeline_info'] = null;
    }

    if (empty($history['title'])) {
        clp_set_error('Title is required.');
    } else {
        if (!empty($history['id'])) {
            $stmt = $db->prepare("UPDATE clp_about_history SET title=?, subtitle=?, short_description=?, full_description=?, featured_image=?, timeline_info=?, display_order=?, status=?, seo_title=?, seo_description=? WHERE id=?");
            $stmt->bind_param("ssssssisssi", 
                $history['title'], $history['subtitle'], $history['short_description'], $history['full_description'],
                $history['featured_image'], $history['timeline_info'], $history['display_order'],
                $history['status'], $history['seo_title'], $history['seo_description'], $history['id']
            );
        } else {
            $stmt = $db->prepare("INSERT INTO clp_about_history (title, subtitle, short_description, full_description, featured_image, timeline_info, display_order, status, seo_title, seo_description, created_by, updated_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $created_by = $admin['id'];
            $stmt->bind_param("ssssssisssii", 
                $history['title'], $history['subtitle'], $history['short_description'], $history['full_description'],
                $history['featured_image'], $history['timeline_info'], $history['display_order'],
                $history['status'], $history['seo_title'], $history['seo_description'], $created_by, $created_by
            );
        }

        if ($stmt->execute()) {
            clp_set_success(!empty($history['id']) ? 'History updated successfully.' : 'History created successfully.');
            $stmt->close();
            $db->close();
            clp_redirect(CLP_ADMIN_URL . '/history.php');
        } else {
            clp_set_error('Failed to save history.');
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
            <h3 class="card-title"><?php echo !empty($history['id']) ? 'Edit History' : 'Add New History'; ?></h3>
            <a href="<?php echo CLP_ADMIN_URL; ?>/history.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to List</a>
        </div>
        <form method="POST" action="">
            <div class="form-group">
                <label class="form-label">Title *</label>
                <input type="text" name="title" class="form-control" required value="<?php echo clp_escape($history['title']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Subtitle</label>
                <input type="text" name="subtitle" class="form-control" value="<?php echo clp_escape($history['subtitle']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Short Description</label>
                <textarea name="short_description" class="form-control" rows="3"><?php echo clp_escape($history['short_description']); ?></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Full Description</label>
                <textarea name="full_description" class="form-control" rows="6"><?php echo clp_escape($history['full_description']); ?></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Featured Image URL</label>
                <input type="text" name="featured_image" class="form-control" value="<?php echo clp_escape($history['featured_image']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Timeline Info (JSON)</label>
                <textarea name="timeline_info" class="form-control" rows="3" placeholder='[{"year": "2004", "event": "Founded"}]'><?php echo clp_escape($history['timeline_info']); ?></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Display Order</label>
                <input type="number" name="display_order" class="form-control" value="<?php echo (int)$history['display_order']; ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="draft" <?php echo $history['status'] === 'draft' ? 'selected' : ''; ?>>Draft</option>
                    <option value="published" <?php echo $history['status'] === 'published' ? 'selected' : ''; ?>>Published</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">SEO Title</label>
                <input type="text" name="seo_title" class="form-control" value="<?php echo clp_escape($history['seo_title']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">SEO Description</label>
                <textarea name="seo_description" class="form-control" rows="2"><?php echo clp_escape($history['seo_description']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
            <a href="<?php echo CLP_ADMIN_URL; ?>/history.php" class="btn btn-primary">Cancel</a>
        </form>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
