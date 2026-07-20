<?php
// CLP Admin Panel - Impact Section Form (Add/Edit)

require_once __DIR__ . '/includes/auth.php';

$page_title = 'Impact Section Form';

$db = clp_db_connect();
$section = [
    'id' => '',
    'section_key' => '',
    'title' => '',
    'content' => '',
    'image_url' => '',
    'stat_value' => '',
    'stat_label' => '',
    'display_order' => 0,
    'status' => 'draft'
];

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("SELECT * FROM clp_impact_sections WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    if ($row = clp_stmt_fetch_assoc($stmt)) {
        $section = $row;
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $section['section_key'] = clp_sanitize($_POST['section_key'] ?? '');
    $section['title'] = clp_sanitize($_POST['title'] ?? '');
    $section['content'] = trim($_POST['content'] ?? '');
    $section['image_url'] = clp_sanitize($_POST['image_url'] ?? '');
    $section['stat_value'] = clp_sanitize($_POST['stat_value'] ?? '');
    $section['stat_label'] = clp_sanitize($_POST['stat_label'] ?? '');
    $section['display_order'] = (int)($_POST['display_order'] ?? 0);
    $section['status'] = clp_sanitize($_POST['status'] ?? 'draft');

    if (empty($section['section_key']) || empty($section['title'])) {
        clp_set_error('Section key and title are required.');
    } else {
        if (!empty($section['id'])) {
            $stmt = $db->prepare("UPDATE clp_impact_sections SET section_key=?, title=?, content=?, image_url=?, stat_value=?, stat_label=?, display_order=?, status=? WHERE id=?");
            $stmt->bind_param("ssssssisi", $section['section_key'], $section['title'], $section['content'], $section['image_url'], $section['stat_value'], $section['stat_label'], $section['display_order'], $section['status'], $section['id']);
        } else {
            $check = $db->query("SELECT id FROM clp_impact_sections WHERE section_key = '" . $db->real_escape_string($section['section_key']) . "'");
            if ($check->num_rows > 0) {
                clp_set_error('Section key already exists.');
            } else {
                $stmt = $db->prepare("INSERT INTO clp_impact_sections (section_key, title, content, image_url, stat_value, stat_label, display_order, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssssis", $section['section_key'], $section['title'], $section['content'], $section['image_url'], $section['stat_value'], $section['stat_label'], $section['display_order'], $section['status']);
            }
        }

        if (!isset($check) || $check->num_rows === 0) {
            if ($stmt->execute()) {
                clp_set_success(!empty($section['id']) ? 'Impact section updated successfully.' : 'Impact section created successfully.');
                $stmt->close();
                $db->close();
                clp_redirect(CLP_ADMIN_URL . '/impact_sections.php');
            } else {
                clp_set_error('Failed to save impact section.');
            }
            $stmt->close();
        }
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
            <h3 class="card-title"><?php echo !empty($section['id']) ? 'Edit Impact Section' : 'Add New Impact Section'; ?></h3>
            <a href="<?php echo CLP_ADMIN_URL; ?>/impact_sections.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to List</a>
        </div>
        <form method="POST" action="">
            <div class="form-group">
                <label class="form-label">Section Key *</label>
                <input type="text" name="section_key" class="form-control" required value="<?php echo clp_escape($section['section_key']); ?>" <?php echo !empty($section['id']) ? 'readonly' : ''; ?>>
                <small class="form-text">Unique identifier for this section. Cannot be changed after creation.</small>
            </div>
            <div class="form-group">
                <label class="form-label">Title *</label>
                <input type="text" name="title" class="form-control" required value="<?php echo clp_escape($section['title']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Content</label>
                <textarea name="content" class="form-control" rows="4"><?php echo clp_escape($section['content']); ?></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Image URL</label>
                <input type="text" name="image_url" class="form-control" value="<?php echo clp_escape($section['image_url']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Stat Value</label>
                <input type="text" name="stat_value" class="form-control" value="<?php echo clp_escape($section['stat_value']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Stat Label</label>
                <input type="text" name="stat_label" class="form-control" value="<?php echo clp_escape($section['stat_label']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Display Order</label>
                <input type="number" name="display_order" class="form-control" value="<?php echo (int)$section['display_order']; ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="draft" <?php echo $section['status'] === 'draft' ? 'selected' : ''; ?>>Draft</option>
                    <option value="published" <?php echo $section['status'] === 'published' ? 'selected' : ''; ?>>Published</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
            <a href="<?php echo CLP_ADMIN_URL; ?>/impact_sections.php" class="btn btn-primary">Cancel</a>
        </form>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
