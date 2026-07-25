<?php
// CLP Admin Panel - News Coverage Management (List)

require_once __DIR__ . '/includes/auth.php';

$page_title = 'News Coverage Management';
$admin = clp_get_admin();

$db = clp_db_connect();

$category_filter = isset($_GET['category']) ? clp_sanitize($_GET['category']) : '';

// Handle delete
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("DELETE FROM clp_news_coverage WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        clp_set_success('News item deleted successfully.');
    } else {
        clp_set_error('Failed to delete news item.');
    }
    $stmt->close();
    clp_redirect(CLP_ADMIN_URL . '/news_coverage.php' . ($category_filter ? '?category=' . urlencode($category_filter) : ''));
}

// Handle status toggle
if (isset($_GET['action']) && $_GET['action'] === 'toggle' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("UPDATE clp_news_coverage SET status = IF(status = 'published', 'draft', 'published') WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        clp_set_success('Status updated successfully.');
    } else {
        clp_set_error('Failed to update status.');
    }
    $stmt->close();
    clp_redirect(CLP_ADMIN_URL . '/news_coverage.php' . ($category_filter ? '?category=' . urlencode($category_filter) : ''));
}

// Get all news items
$where = "1=1";
if ($category_filter) {
    $where .= " AND category = '" . $db->real_escape_string($category_filter) . "'";
}
$result = $db->query("SELECT * FROM clp_news_coverage WHERE $where ORDER BY category ASC, display_order ASC, id DESC");
$news_items = [];
while ($row = $result->fetch_assoc()) {
    $news_items[] = $row;
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
            <h3 class="card-title"><i class="fas fa-newspaper"></i> News Coverage Items</h3>
            <div class="header-actions">
                <form method="GET" action="" style="display: inline-flex; gap: 8px; align-items: center;">
                    <select name="category" class="form-control" style="width: auto; display: inline-block;" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        <option value="print_media" <?php echo $category_filter === 'print_media' ? 'selected' : ''; ?>>Print Media</option>
                        <option value="article" <?php echo $category_filter === 'article' ? 'selected' : ''; ?>>Articles</option>
                        <option value="research_paper" <?php echo $category_filter === 'research_paper' ? 'selected' : ''; ?>>Research Paper</option>
                    </select>
                </form>
                <a href="<?php echo CLP_ADMIN_URL; ?>/news_coverage_form.php" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Item</a>
            </div>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Title</th>
                        <th>Date/Source</th>
                        <th>Status</th>
                        <th>Order</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($news_items)): ?>
                        <tr><td colspan="7" style="text-align: center; color: #999;">No news items found. <a href="<?php echo CLP_ADMIN_URL; ?>/news_coverage_form.php">Add your first item</a>.</td></tr>
                    <?php else: ?>
                        <?php foreach ($news_items as $item): ?>
                            <tr>
                                <td><strong><?php echo clp_escape(ucfirst(str_replace('_', ' ', $item['category']))); ?></strong></td>
                                <td><?php echo clp_escape(substr($item['title'], 0, 80)); ?><?php echo strlen($item['title']) > 80 ? '...' : ''; ?></td>
                                <td><?php echo clp_escape(substr($item['date_info'], 0, 50)); ?></td>
                                <td>
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/news_coverage.php?action=toggle&id=<?php echo $item['id']; ?>&category=<?php echo urlencode($category_filter); ?>" class="badge <?php echo $item['status'] === 'published' ? 'badge-success' : 'badge-warning'; ?>">
                                        <?php echo ucfirst(clp_escape($item['status'])); ?>
                                    </a>
                                </td>
                                <td><?php echo (int)$item['display_order']; ?></td>
                                <td><?php echo clp_format_date($item['updated_at']); ?></td>
                                <td>
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/news_coverage_form.php?id=<?php echo $item['id']; ?>&category=<?php echo urlencode($category_filter); ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/news_coverage.php?action=delete&id=<?php echo $item['id']; ?>&category=<?php echo urlencode($category_filter); ?>" class="btn btn-sm btn-danger confirm-delete" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i> Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-video"></i> Video Section</h3>
            <a href="<?php echo CLP_ADMIN_URL; ?>/news_coverage_video_form.php" class="btn btn-primary"><i class="fas fa-edit"></i> Edit Video Section</a>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Heading</th>
                        <th>YouTube URL</th>
                        <th>Description</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $video = $db->query("SELECT * FROM clp_news_coverage_video LIMIT 1")->fetch_assoc();
                    $db->close();
                    ?>
                    <?php if (!$video): ?>
                        <tr><td colspan="4" style="text-align: center; color: #999;">No video section configured. <a href="<?php echo CLP_ADMIN_URL; ?>/news_coverage_video_form.php">Add video section</a>.</td></tr>
                    <?php else: ?>
                        <tr>
                            <td><?php echo clp_escape($video['heading']); ?></td>
                            <td><?php echo clp_escape(substr($video['youtube_url'], 0, 60)); ?></td>
                            <td><?php echo clp_escape(substr($video['description'], 0, 100)); ?>...</td>
                            <td>
                                <span class="badge <?php echo $video['status'] === 'published' ? 'badge-success' : 'badge-warning'; ?>">
                                    <?php echo ucfirst(clp_escape($video['status'])); ?>
                                </span>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
