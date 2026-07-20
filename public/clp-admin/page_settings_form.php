<?php
// CLP Admin Panel - Page Settings Form (Edit All)

require_once __DIR__ . '/includes/auth.php';

$page_title = 'Page Settings Form';

$db = clp_db_connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $page_keys = $_POST['page_key'] ?? [];
    $page_titles = $_POST['page_title'] ?? [];
    $breadcrumb_titles = $_POST['breadcrumb_title'] ?? [];
    $meta_titles = $_POST['meta_title'] ?? [];
    $meta_descriptions = $_POST['meta_description'] ?? [];

    $success_count = 0;
    $error_count = 0;

    foreach ($page_keys as $index => $page_key) {
        $page_title_val = clp_sanitize($page_titles[$index] ?? '');
        $breadcrumb_title = clp_sanitize($breadcrumb_titles[$index] ?? '');
        $meta_title = clp_sanitize($meta_titles[$index] ?? '');
        $meta_description = clp_sanitize($meta_descriptions[$index] ?? '');

        $stmt = $db->prepare("UPDATE clp_page_settings SET page_title=?, breadcrumb_title=?, meta_title=?, meta_description=?, updated_at=NOW() WHERE page_key=?");
        $stmt->bind_param("sssss", $page_title_val, $breadcrumb_title, $meta_title, $meta_description, $page_key);
        if ($stmt->execute()) {
            $success_count++;
        } else {
            $error_count++;
        }
        $stmt->close();
    }

    $db->close();

    if ($error_count === 0) {
        clp_set_success("All $success_count page settings updated successfully.");
    } else {
        clp_set_error("Updated $success_count settings, but $error_count failed.");
    }
    clp_redirect(CLP_ADMIN_URL . '/page_settings.php');
}

$result = $db->query("SELECT * FROM clp_page_settings ORDER BY page_key ASC");
$settings = [];
while ($row = $result->fetch_assoc()) {
    $settings[] = $row;
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
            <h3 class="card-title"><i class="fas fa-edit"></i> Edit All Page Settings</h3>
            <a href="<?php echo CLP_ADMIN_URL; ?>/page_settings.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to List</a>
        </div>
        <form method="POST" action="">
            <?php if (empty($settings)): ?>
                <p style="padding: 20px; text-align: center; color: #999;">No page settings found to edit.</p>
            <?php else: ?>
                <?php foreach ($settings as $index => $setting): ?>
                    <div class="form-section">
                        <h4 class="form-section-title"><?php echo clp_escape($setting['page_title']); ?> <small style="color: #999;">(<?php echo clp_escape($setting['page_key']); ?>)</small></h4>
                        <div class="form-group">
                            <label class="form-label">Page Title</label>
                            <input type="text" name="page_title[<?php echo $index; ?>]" class="form-control" value="<?php echo clp_escape($setting['page_title']); ?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Breadcrumb Title</label>
                            <input type="text" name="breadcrumb_title[<?php echo $index; ?>]" class="form-control" value="<?php echo clp_escape($setting['breadcrumb_title']); ?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Meta Title</label>
                            <input type="text" name="meta_title[<?php echo $index; ?>]" class="form-control" value="<?php echo clp_escape($setting['meta_title']); ?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Meta Description</label>
                            <textarea name="meta_description[<?php echo $index; ?>]" class="form-control" rows="2"><?php echo clp_escape($setting['meta_description']); ?></textarea>
                        </div>
                        <input type="hidden" name="page_key[<?php echo $index; ?>]" value="<?php echo clp_escape($setting['page_key']); ?>">
                    </div>
                    <?php if ($index < count($settings) - 1): ?>
                        <hr style="border: none; border-top: 1px solid #e0e0e0; margin: 20px 0;">
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save All Settings</button>
            <a href="<?php echo CLP_ADMIN_URL; ?>/page_settings.php" class="btn btn-primary">Cancel</a>
        </form>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
