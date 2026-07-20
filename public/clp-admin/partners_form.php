<?php
// CLP Admin Panel - Partners Form (Add/Edit)

require_once __DIR__ . '/includes/auth.php';

$page_title = 'Partners Form';

$db = clp_db_connect();
$partner = [
    'id' => '',
    'name' => '',
    'logo_url' => '',
    'short_description' => '',
    'website_url' => '',
    'partner_type' => '',
    'display_order' => 0,
    'status' => 'draft'
];

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("SELECT * FROM clp_partners WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    if ($row = clp_stmt_fetch_assoc($stmt)) {
        $partner = $row;
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $partner['name'] = clp_sanitize($_POST['name'] ?? '');
    $partner['logo_url'] = clp_sanitize($_POST['logo_url'] ?? '');
    $partner['short_description'] = trim($_POST['short_description'] ?? '');
    $partner['website_url'] = clp_sanitize($_POST['website_url'] ?? '');
    $partner['partner_type'] = clp_sanitize($_POST['partner_type'] ?? '');
    $partner['display_order'] = (int)($_POST['display_order'] ?? 0);
    $partner['status'] = clp_sanitize($_POST['status'] ?? 'draft');

    if (empty($partner['name'])) {
        clp_set_error('Partner name is required.');
    } else {
        if (!empty($partner['id'])) {
            $stmt = $db->prepare("UPDATE clp_partners SET name=?, logo_url=?, short_description=?, website_url=?, partner_type=?, display_order=?, status=? WHERE id=?");
            $stmt->bind_param("sssssisi", $partner['name'], $partner['logo_url'], $partner['short_description'], $partner['website_url'], $partner['partner_type'], $partner['display_order'], $partner['status'], $partner['id']);
        } else {
            $stmt = $db->prepare("INSERT INTO clp_partners (name, logo_url, short_description, website_url, partner_type, display_order, status, created_by, updated_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $created_by = clp_get_admin()['id'];
            $stmt->bind_param("sssssissi", $partner['name'], $partner['logo_url'], $partner['short_description'], $partner['website_url'], $partner['partner_type'], $partner['display_order'], $partner['status'], $created_by, $created_by);
        }

        if ($stmt->execute()) {
            clp_set_success(!empty($partner['id']) ? 'Partner updated successfully.' : 'Partner created successfully.');
            $stmt->close();
            $db->close();
            clp_redirect(CLP_ADMIN_URL . '/partners.php');
        } else {
            clp_set_error('Failed to save partner.');
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
            <h3 class="card-title"><?php echo !empty($partner['id']) ? 'Edit Partner' : 'Add New Partner'; ?></h3>
            <a href="<?php echo CLP_ADMIN_URL; ?>/partners.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to List</a>
        </div>
        <form method="POST" action="">
            <div class="form-group">
                <label class="form-label">Partner Name *</label>
                <input type="text" name="name" class="form-control" required value="<?php echo clp_escape($partner['name']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Logo URL</label>
                <input type="text" name="logo_url" class="form-control" value="<?php echo clp_escape($partner['logo_url']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Short Description</label>
                <textarea name="short_description" class="form-control" rows="3"><?php echo clp_escape($partner['short_description']); ?></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Website URL</label>
                <input type="text" name="website_url" class="form-control" value="<?php echo clp_escape($partner['website_url']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Partner Type</label>
                <input type="text" name="partner_type" class="form-control" value="<?php echo clp_escape($partner['partner_type']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Display Order</label>
                <input type="number" name="display_order" class="form-control" value="<?php echo (int)$partner['display_order']; ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="draft" <?php echo $partner['status'] === 'draft' ? 'selected' : ''; ?>>Draft</option>
                    <option value="published" <?php echo $partner['status'] === 'published' ? 'selected' : ''; ?>>Published</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
            <a href="<?php echo CLP_ADMIN_URL; ?>/partners.php" class="btn btn-primary">Cancel</a>
        </form>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
