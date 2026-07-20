<?php
// CLP Admin Panel - Mission Form (Add/Edit)

require_once __DIR__ . '/includes/auth.php';

$page_title = 'Mission Form';

$db = clp_db_connect();
$mission = [
    'id' => '',
    'title' => '',
    'mission_statement' => '',
    'vision_statement' => '',
    'core_values' => '',
    'description' => '',
    'image_url' => '',
    'icon_class' => '',
    'display_order' => 0,
    'status' => 'draft'
];

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("SELECT * FROM clp_about_mission WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    if ($row = clp_stmt_fetch_assoc($stmt)) {
        $mission = $row;
        $mission['core_values'] = is_string($mission['core_values']) ? $mission['core_values'] : json_encode($mission['core_values'] ?? []);
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mission['title'] = clp_sanitize($_POST['title'] ?? '');
    $mission['mission_statement'] = trim($_POST['mission_statement'] ?? '');
    $mission['vision_statement'] = trim($_POST['vision_statement'] ?? '');
    $mission['core_values'] = trim($_POST['core_values'] ?? '');
    $mission['description'] = trim($_POST['description'] ?? '');
    $mission['image_url'] = clp_sanitize($_POST['image_url'] ?? '');
    $mission['icon_class'] = clp_sanitize($_POST['icon_class'] ?? '');
    $mission['display_order'] = (int)($_POST['display_order'] ?? 0);
    $mission['status'] = clp_sanitize($_POST['status'] ?? 'draft');

    if (empty($mission['title'])) {
        clp_set_error('Title is required.');
    } else {
        if (!empty($mission['id'])) {
            $stmt = $db->prepare("UPDATE clp_about_mission SET title=?, mission_statement=?, vision_statement=?, core_values=?, description=?, image_url=?, icon_class=?, display_order=?, status=? WHERE id=?");
            $stmt->bind_param("sssssssisi", $mission['title'], $mission['mission_statement'], $mission['vision_statement'], $mission['core_values'], $mission['description'], $mission['image_url'], $mission['icon_class'], $mission['display_order'], $mission['status'], $mission['id']);
        } else {
            $stmt = $db->prepare("INSERT INTO clp_about_mission (title, mission_statement, vision_statement, core_values, description, image_url, icon_class, display_order, status, created_by, updated_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $created_by = clp_get_admin()['id'];
            $stmt->bind_param("sssssssissi", $mission['title'], $mission['mission_statement'], $mission['vision_statement'], $mission['core_values'], $mission['description'], $mission['image_url'], $mission['icon_class'], $mission['display_order'], $mission['status'], $created_by, $created_by);
        }

        if ($stmt->execute()) {
            clp_set_success(!empty($mission['id']) ? 'Mission updated successfully.' : 'Mission created successfully.');
            $stmt->close();
            $db->close();
            clp_redirect(CLP_ADMIN_URL . '/mission.php');
        } else {
            clp_set_error('Failed to save mission.');
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
            <h3 class="card-title"><?php echo !empty($mission['id']) ? 'Edit Mission' : 'Add New Mission'; ?></h3>
            <a href="<?php echo CLP_ADMIN_URL; ?>/mission.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to List</a>
        </div>
        <form method="POST" action="">
            <div class="form-group">
                <label class="form-label">Title *</label>
                <input type="text" name="title" class="form-control" required value="<?php echo clp_escape($mission['title']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Mission Statement</label>
                <textarea name="mission_statement" class="form-control" rows="4"><?php echo clp_escape($mission['mission_statement']); ?></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Vision Statement</label>
                <textarea name="vision_statement" class="form-control" rows="4"><?php echo clp_escape($mission['vision_statement']); ?></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Core Values (JSON array or comma separated)</label>
                <textarea name="core_values" class="form-control" rows="3" placeholder='["Value 1", "Value 2", "Value 3"]'><?php echo clp_escape($mission['core_values']); ?></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3"><?php echo clp_escape($mission['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Image URL</label>
                <input type="text" name="image_url" class="form-control" value="<?php echo clp_escape($mission['image_url']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Icon Class</label>
                <input type="text" name="icon_class" class="form-control" value="<?php echo clp_escape($mission['icon_class']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Display Order</label>
                <input type="number" name="display_order" class="form-control" value="<?php echo (int)$mission['display_order']; ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="draft" <?php echo $mission['status'] === 'draft' ? 'selected' : ''; ?>>Draft</option>
                    <option value="published" <?php echo $mission['status'] === 'published' ? 'selected' : ''; ?>>Published</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
            <a href="<?php echo CLP_ADMIN_URL; ?>/mission.php" class="btn btn-primary">Cancel</a>
        </form>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
