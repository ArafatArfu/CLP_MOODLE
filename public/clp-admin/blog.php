<?php
// CLP Admin Panel - Blog Management (List)

require_once __DIR__ . '/includes/auth.php';

$page_title = 'Blog Management';
$admin = clp_get_admin();

$db = clp_db_connect();

// Handle delete
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("DELETE FROM clp_blog_posts WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        clp_set_success('Blog post deleted successfully.');
    } else {
        clp_set_error('Failed to delete blog post.');
    }
    $stmt->close();
    clp_redirect(CLP_ADMIN_URL . '/blog.php');
}

// Handle status toggle
if (isset($_GET['action']) && $_GET['action'] === 'toggle' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("UPDATE clp_blog_posts SET status = IF(status = 'published', 'draft', 'published') WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        clp_set_success('Status updated successfully.');
    } else {
        clp_set_error('Failed to update status.');
    }
    $stmt->close();
    clp_redirect(CLP_ADMIN_URL . '/blog.php');
}

// Get all blog posts
$result = $db->query("SELECT * FROM clp_blog_posts ORDER BY display_order ASC, id DESC");
$blog_posts = [];
while ($row = $result->fetch_assoc()) {
    $blog_posts[] = $row;
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
            <h3 class="card-title"><i class="fas fa-blog"></i> Blog Posts</h3>
            <a href="<?php echo CLP_ADMIN_URL; ?>/blog_form.php" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Post</a>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Order</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($blog_posts)): ?>
                        <tr><td colspan="7" style="text-align: center; color: #999;">No blog posts found. <a href="<?php echo CLP_ADMIN_URL; ?>/blog_form.php">Add your first post</a>.</td></tr>
                    <?php else: ?>
                        <?php foreach ($blog_posts as $post): ?>
                            <tr>
                                <td><strong><?php echo clp_escape($post['title']); ?></strong></td>
                                <td><code><?php echo clp_escape($post['slug']); ?></code></td>
                                <td><?php echo clp_escape($post['date'] ?? ''); ?></td>
                                <td>
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/blog.php?action=toggle&id=<?php echo $post['id']; ?>" class="badge <?php echo $post['status'] === 'published' ? 'badge-success' : 'badge-warning'; ?>">
                                        <?php echo ucfirst(clp_escape($post['status'])); ?>
                                    </a>
                                </td>
                                <td><?php echo (int)$post['display_order']; ?></td>
                                <td><?php echo clp_format_date($post['updated_at']); ?></td>
                                <td>
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/blog_form.php?id=<?php echo $post['id']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/blog.php?action=delete&id=<?php echo $post['id']; ?>" class="btn btn-sm btn-danger confirm-delete" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i> Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
