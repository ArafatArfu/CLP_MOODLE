<?php
// CLP Admin Panel - Impact Form (Add/Edit)

require_once __DIR__ . '/includes/auth.php';

$page_title = 'Impact Form';

$db = clp_db_connect();
$impact = [
    'id' => '',
    'title' => '',
    'description' => '',
    'stat_value' => '',
    'stat_label' => '',
    'icon_class' => '',
    'image_url' => '',
    'success_story' => '',
    'display_order' => 0,
    'status' => 'draft'
];

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("SELECT * FROM clp_about_impact WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    if ($row = clp_stmt_fetch_assoc($stmt)) {
        $impact = $row;
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $impact['title'] = clp_sanitize($_POST['title'] ?? '');
    $impact['description'] = trim($_POST['description'] ?? '');
    $impact['stat_value'] = clp_sanitize($_POST['stat_value'] ?? '');
    $impact['stat_label'] = clp_sanitize($_POST['stat_label'] ?? '');
    $impact['icon_class'] = clp_sanitize($_POST['icon_class'] ?? '');
    $impact['image_url'] = clp_sanitize($_POST['image_url'] ?? '');
    $impact['success_story'] = trim($_POST['success_story'] ?? '');
    $impact['display_order'] = (int)($_POST['display_order'] ?? 0);
    $impact['status'] = clp_sanitize($_POST['status'] ?? 'draft');

    if (empty($impact['title'])) {
        clp_set_error('Title is required.');
    } else {
        if (!empty($impact['id'])) {
            $stmt = $db->prepare("UPDATE clp_about_impact SET title=?, description=?, stat_value=?, stat_label=?, icon_class=?, image_url=?, success_story=?, display_order=?, status=? WHERE id=?");
            $stmt->bind_param("sssssssisi", $impact['title'], $impact['description'], $impact['stat_value'], $impact['stat_label'], $impact['icon_class'], $impact['image_url'], $impact['success_story'], $impact['display_order'], $impact['status'], $impact['id']);
        } else {
            $stmt = $db->prepare("INSERT INTO clp_about_impact (title, description, stat_value, stat_label, icon_class, image_url, success_story, display_order, status, created_by, updated_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $created_by = clp_get_admin()['id'];
            $stmt->bind_param("sssssssisii", $impact['title'], $impact['description'], $impact['stat_value'], $impact['stat_label'], $impact['icon_class'], $impact['image_url'], $impact['success_story'], $impact['display_order'], $impact['status'], $created_by, $created_by);
        }

        if ($stmt->execute()) {
            clp_set_success(!empty($impact['id']) ? 'Impact updated successfully.' : 'Impact created successfully.');
            $stmt->close();
            $db->close();
            clp_redirect(CLP_ADMIN_URL . '/impact.php');
        } else {
            clp_set_error('Failed to save impact.');
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
            <h3 class="card-title"><?php echo !empty($impact['id']) ? 'Edit Impact' : 'Add New Impact'; ?></h3>
            <a href="<?php echo CLP_ADMIN_URL; ?>/impact.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to List</a>
        </div>
        <form method="POST" action="">
            <div class="form-group">
                <label class="form-label">Title *</label>
                <input type="text" name="title" class="form-control" required value="<?php echo clp_escape($impact['title']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3"><?php echo clp_escape($impact['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Stat Value</label>
                <input type="text" name="stat_value" class="form-control" value="<?php echo clp_escape($impact['stat_value']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Stat Label</label>
                <input type="text" name="stat_label" class="form-control" value="<?php echo clp_escape($impact['stat_label']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Icon Class</label>
                <input type="text" name="icon_class" class="form-control" value="<?php echo clp_escape($impact['icon_class']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Image URL</label>
                <input type="text" name="image_url" class="form-control" value="<?php echo clp_escape($impact['image_url']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Success Story</label>
                <textarea name="success_story" class="form-control" rows="3"><?php echo clp_escape($impact['success_story']); ?></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Display Order</label>
                <input type="number" name="display_order" class="form-control" value="<?php echo (int)$impact['display_order']; ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="draft" <?php echo $impact['status'] === 'draft' ? 'selected' : ''; ?>>Draft</option>
                    <option value="published" <?php echo $impact['status'] === 'published' ? 'selected' : ''; ?>>Published</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
            <a href="<?php echo CLP_ADMIN_URL; ?>/impact.php" class="btn btn-primary">Cancel</a>
        </form>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
