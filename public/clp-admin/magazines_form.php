<?php
// CLP Admin Panel - Magazine Form (Add/Edit)

require_once __DIR__ . '/includes/auth.php';

$page_title = 'Magazine Form';
$admin = clp_get_admin();

$db = clp_db_connect();

$magazine = [
    'id' => '',
    'title' => '',
    'year' => date('Y'),
    'description' => '',
    'pdf_path' => '',
    'cover_image' => '',
    'display_order' => 0,
    'status' => 'published'
];

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("SELECT * FROM clp_magazines WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    if ($row = clp_stmt_fetch_assoc($stmt)) {
        $magazine = $row;
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $magazine['title'] = clp_sanitize($_POST['title'] ?? '');
    $magazine['year'] = (int)($_POST['year'] ?? date('Y'));
    $magazine['description'] = trim($_POST['description'] ?? '');
    $magazine['pdf_path'] = clp_sanitize($_POST['pdf_path'] ?? '');
    $magazine['cover_image'] = clp_sanitize($_POST['cover_image'] ?? '');
    $magazine['display_order'] = (int)($_POST['display_order'] ?? 0);
    $magazine['status'] = clp_sanitize($_POST['status'] ?? 'published');

    if (empty($magazine['title']) || empty($magazine['pdf_path']) || empty($magazine['cover_image'])) {
        clp_set_error('Title, PDF path, and cover image are required.');
    } else {
        if (!empty($magazine['id'])) {
            $stmt = $db->prepare("UPDATE clp_magazines SET title=?, year=?, description=?, pdf_path=?, cover_image=?, display_order=?, status=? WHERE id=?");
            $stmt->bind_param("sisssisi", 
                $magazine['title'], $magazine['year'], $magazine['description'],
                $magazine['pdf_path'], $magazine['cover_image'],
                $magazine['display_order'], $magazine['status'], $magazine['id']
            );
        } else {
            $stmt = $db->prepare("INSERT INTO clp_magazines (title, year, description, pdf_path, cover_image, display_order, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sisssss", 
                $magazine['title'], $magazine['year'], $magazine['description'],
                $magazine['pdf_path'], $magazine['cover_image'],
                $magazine['display_order'], $magazine['status']
            );
        }

        if ($stmt->execute()) {
            clp_set_success(!empty($magazine['id']) ? 'Magazine updated successfully.' : 'Magazine created successfully.');
            $stmt->close();
            $db->close();
            clp_redirect(CLP_ADMIN_URL . '/magazines_admin.php');
        } else {
            clp_set_error('Failed to save magazine.');
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
            <h3 class="card-title"><?php echo !empty($magazine['id']) ? 'Edit Magazine' : 'Add New Magazine'; ?></h3>
            <a href="<?php echo CLP_ADMIN_URL; ?>/magazines_admin.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to List</a>
        </div>
        <form method="POST" action="">
            <div class="form-group">
                <label class="form-label">Title *</label>
                <input type="text" name="title" class="form-control" required value="<?php echo clp_escape($magazine['title']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Year *</label>
                <input type="number" name="year" class="form-control" required value="<?php echo (int)$magazine['year']; ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3"><?php echo clp_escape($magazine['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">PDF Path *</label>
                <input type="text" name="pdf_path" class="form-control" required value="<?php echo clp_escape($magazine['pdf_path']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Cover Image Path *</label>
                <input type="text" name="cover_image" class="form-control" required value="<?php echo clp_escape($magazine['cover_image']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Display Order</label>
                <input type="number" name="display_order" class="form-control" value="<?php echo (int)$magazine['display_order']; ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="draft" <?php echo $magazine['status'] === 'draft' ? 'selected' : ''; ?>>Draft</option>
                    <option value="published" <?php echo $magazine['status'] === 'published' ? 'selected' : ''; ?>>Published</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
            <a href="<?php echo CLP_ADMIN_URL; ?>/magazines_admin.php" class="btn btn-primary">Cancel</a>
        </form>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
