<?php
// CLP Admin Panel - Blog Form (Add/Edit)

require_once __DIR__ . '/includes/auth.php';

$page_title = 'Blog Form';
$admin = clp_get_admin();

$db = clp_db_connect();

$post = [
    'id' => '',
    'title' => '',
    'slug' => '',
    'summary' => '',
    'description' => '',
    'date' => '',
    'youtube_url' => '',
    'image' => '',
    'display_order' => 0,
    'status' => 'draft'
];

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("SELECT * FROM clp_blog_posts WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    if ($row = clp_stmt_fetch_assoc($stmt)) {
        $post = $row;
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post['title'] = clp_sanitize($_POST['title'] ?? '');
    $post['slug'] = clp_sanitize($_POST['slug'] ?? '');
    $post['summary'] = trim($_POST['summary'] ?? '');
    $post['description'] = trim($_POST['description'] ?? '');
    $post['date'] = clp_sanitize($_POST['date'] ?? '');
    $post['youtube_url'] = clp_sanitize($_POST['youtube_url'] ?? '');
    $post['image'] = clp_sanitize($_POST['image'] ?? '');
    $post['display_order'] = (int)($_POST['display_order'] ?? 0);
    $post['status'] = clp_sanitize($_POST['status'] ?? 'draft');

    if (empty($post['title'])) {
        clp_set_error('Title is required.');
    } else {
        if (!empty($post['id'])) {
            $stmt = $db->prepare("UPDATE clp_blog_posts SET title=?, slug=?, summary=?, description=?, date=?, youtube_url=?, image=?, display_order=?, status=? WHERE id=?");
            $stmt->bind_param("ssssssisis", 
                $post['title'], $post['slug'], $post['summary'], $post['description'],
                $post['date'], $post['youtube_url'], $post['image'],
                $post['display_order'], $post['status'], $post['id']
            );
        } else {
            $stmt = $db->prepare("INSERT INTO clp_blog_posts (title, slug, summary, description, date, youtube_url, image, display_order, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssis", 
                $post['title'], $post['slug'], $post['summary'], $post['description'],
                $post['date'], $post['youtube_url'], $post['image'],
                $post['display_order'], $post['status']
            );
        }

        if ($stmt->execute()) {
            clp_set_success(!empty($post['id']) ? 'Blog post updated successfully.' : 'Blog post created successfully.');
            $stmt->close();
            $db->close();
            clp_redirect(CLP_ADMIN_URL . '/blog.php');
        } else {
            clp_set_error('Failed to save blog post.');
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
            <h3 class="card-title"><?php echo !empty($post['id']) ? 'Edit Blog Post' : 'Add New Blog Post'; ?></h3>
            <a href="<?php echo CLP_ADMIN_URL; ?>/blog.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to List</a>
        </div>
        <form method="POST" action="">
            <div class="form-group">
                <label class="form-label">Title *</label>
                <input type="text" name="title" class="form-control" required value="<?php echo clp_escape($post['title']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Slug</label>
                <input type="text" name="slug" class="form-control" value="<?php echo clp_escape($post['slug']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Summary *</label>
                <textarea name="summary" class="form-control" rows="3" required><?php echo clp_escape($post['summary']); ?></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Description (HTML allowed)</label>
                <textarea name="description" class="form-control" rows="6"><?php echo clp_escape($post['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Date</label>
                <input type="text" name="date" class="form-control" placeholder="e.g. 11 Oct 2020" value="<?php echo clp_escape($post['date']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">YouTube URL</label>
                <input type="text" name="youtube_url" class="form-control" placeholder="https://youtu.be/..." value="<?php echo clp_escape($post['youtube_url']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Image Path</label>
                <input type="text" name="image" class="form-control" value="<?php echo clp_escape($post['image']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Display Order</label>
                <input type="number" name="display_order" class="form-control" value="<?php echo (int)$post['display_order']; ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="draft" <?php echo $post['status'] === 'draft' ? 'selected' : ''; ?>>Draft</option>
                    <option value="published" <?php echo $post['status'] === 'published' ? 'selected' : ''; ?>>Published</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
            <a href="<?php echo CLP_ADMIN_URL; ?>/blog.php" class="btn btn-primary">Cancel</a>
        </form>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
