<?php
// CLP Admin Panel - Mission Bullet Form (Add/Edit)

require_once __DIR__ . '/includes/auth.php';

$page_title = 'Mission Bullet Form';

$db = clp_db_connect();
$bullet = [
    'id' => '',
    'section_key' => 'what_we_do',
    'bullet_text' => '',
    'display_order' => 0,
    'status' => 'draft'
];

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("SELECT * FROM clp_mission_bullets WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    if ($row = clp_stmt_fetch_assoc($stmt)) {
        $bullet = $row;
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bullet['section_key'] = clp_sanitize($_POST['section_key'] ?? 'what_we_do');
    $bullet['bullet_text'] = clp_sanitize($_POST['bullet_text'] ?? '');
    $bullet['display_order'] = (int)($_POST['display_order'] ?? 0);
    $bullet['status'] = clp_sanitize($_POST['status'] ?? 'draft');

    if (empty($bullet['bullet_text'])) {
        clp_set_error('Bullet text is required.');
    } else {
        if (!empty($bullet['id'])) {
            $stmt = $db->prepare("UPDATE clp_mission_bullets SET section_key=?, bullet_text=?, display_order=?, status=? WHERE id=?");
            $stmt->bind_param("ssisi", $bullet['section_key'], $bullet['bullet_text'], $bullet['display_order'], $bullet['status'], $bullet['id']);
        } else {
            $stmt = $db->prepare("INSERT INTO clp_mission_bullets (section_key, bullet_text, display_order, status) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssis", $bullet['section_key'], $bullet['bullet_text'], $bullet['display_order'], $bullet['status']);
        }

        if ($stmt->execute()) {
            clp_set_success(!empty($bullet['id']) ? 'Mission bullet updated successfully.' : 'Mission bullet created successfully.');
            $stmt->close();
            $db->close();
            clp_redirect(CLP_ADMIN_URL . '/mission_bullets.php');
        } else {
            clp_set_error('Failed to save mission bullet.');
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
            <h3 class="card-title"><?php echo !empty($bullet['id']) ? 'Edit Mission Bullet' : 'Add New Mission Bullet'; ?></h3>
            <a href="<?php echo CLP_ADMIN_URL; ?>/mission_bullets.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to List</a>
        </div>
        <form method="POST" action="">
            <input type="hidden" name="section_key" value="<?php echo clp_escape($bullet['section_key']); ?>">
            <div class="form-group">
                <label class="form-label">Bullet Text *</label>
                <textarea name="bullet_text" class="form-control" rows="3" required><?php echo clp_escape($bullet['bullet_text']); ?></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Display Order</label>
                <input type="number" name="display_order" class="form-control" value="<?php echo (int)$bullet['display_order']; ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="draft" <?php echo $bullet['status'] === 'draft' ? 'selected' : ''; ?>>Draft</option>
                    <option value="published" <?php echo $bullet['status'] === 'published' ? 'selected' : ''; ?>>Published</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
            <a href="<?php echo CLP_ADMIN_URL; ?>/mission_bullets.php" class="btn btn-primary">Cancel</a>
        </form>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
