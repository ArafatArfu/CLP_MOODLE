<?php
// CLP Admin Panel - News Coverage Form (Add/Edit)

require_once __DIR__ . '/includes/auth.php';

$page_title = 'News Coverage Form';
$admin = clp_get_admin();

$db = clp_db_connect();

$news = [
    'id' => '',
    'category' => 'print_media',
    'title' => '',
    'date_info' => '',
    'source' => '',
    'image_path' => '',
    'pdf_link' => '',
    'display_order' => 0,
    'status' => 'draft'
];

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("SELECT * FROM clp_news_coverage WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    if ($row = clp_stmt_fetch_assoc($stmt)) {
        $news = $row;
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $news['category'] = clp_sanitize($_POST['category'] ?? 'print_media');
    $news['title'] = clp_sanitize($_POST['title'] ?? '');
    $news['date_info'] = clp_sanitize($_POST['date_info'] ?? '');
    $news['source'] = clp_sanitize($_POST['source'] ?? '');
    $news['image_path'] = clp_sanitize($_POST['image_path'] ?? '');
    $news['pdf_link'] = clp_sanitize($_POST['pdf_link'] ?? '');
    $news['display_order'] = (int)($_POST['display_order'] ?? 0);
    $news['status'] = clp_sanitize($_POST['status'] ?? 'draft');

    if (empty($news['title'])) {
        clp_set_error('Title is required.');
    } else {
        if (!empty($news['id'])) {
            $stmt = $db->prepare("UPDATE clp_news_coverage SET category=?, title=?, date_info=?, source=?, image_path=?, pdf_link=?, display_order=?, status=? WHERE id=?");
            $stmt->bind_param("sssssisis", 
                $news['category'], $news['title'], $news['date_info'], $news['source'],
                $news['image_path'], $news['pdf_link'], $news['display_order'],
                $news['status'], $news['id']
            );
        } else {
            $stmt = $db->prepare("INSERT INTO clp_news_coverage (category, title, date_info, source, image_path, pdf_link, display_order, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssis", 
                $news['category'], $news['title'], $news['date_info'], $news['source'],
                $news['image_path'], $news['pdf_link'], $news['display_order'],
                $news['status']
            );
        }

        if ($stmt->execute()) {
            clp_set_success(!empty($news['id']) ? 'News item updated successfully.' : 'News item created successfully.');
            $stmt->close();
            $db->close();
            $redirect_category = $news['category'];
            clp_redirect(CLP_ADMIN_URL . '/news_coverage.php?category=' . urlencode($redirect_category));
        } else {
            clp_set_error('Failed to save news item.');
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
            <h3 class="card-title"><?php echo !empty($news['id']) ? 'Edit News Item' : 'Add New News Item'; ?></h3>
            <a href="<?php echo CLP_ADMIN_URL; ?>/news_coverage.php?category=<?php echo urlencode($news['category']); ?>" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to List</a>
        </div>
        <form method="POST" action="">
            <div class="form-group">
                <label class="form-label">Category *</label>
                <select name="category" class="form-control">
                    <option value="print_media" <?php echo $news['category'] === 'print_media' ? 'selected' : ''; ?>>Print Media</option>
                    <option value="article" <?php echo $news['category'] === 'article' ? 'selected' : ''; ?>>Article</option>
                    <option value="research_paper" <?php echo $news['category'] === 'research_paper' ? 'selected' : ''; ?>>Research Paper</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Title *</label>
                <input type="text" name="title" class="form-control" required value="<?php echo clp_escape($news['title']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Date Info</label>
                <input type="text" name="date_info" class="form-control" placeholder="e.g. Oct 2020" value="<?php echo clp_escape($news['date_info']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Source</label>
                <input type="text" name="source" class="form-control" placeholder="e.g. PROTHOM ALO" value="<?php echo clp_escape($news['source']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Image Path *</label>
                <input type="text" name="image_path" class="form-control" required value="<?php echo clp_escape($news['image_path']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">PDF Link</label>
                <input type="text" name="pdf_link" class="form-control" value="<?php echo clp_escape($news['pdf_link']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Display Order</label>
                <input type="number" name="display_order" class="form-control" value="<?php echo (int)$news['display_order']; ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="draft" <?php echo $news['status'] === 'draft' ? 'selected' : ''; ?>>Draft</option>
                    <option value="published" <?php echo $news['status'] === 'published' ? 'selected' : ''; ?>>Published</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
            <a href="<?php echo CLP_ADMIN_URL; ?>/news_coverage.php?category=<?php echo urlencode($news['category']); ?>" class="btn btn-primary">Cancel</a>
        </form>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
