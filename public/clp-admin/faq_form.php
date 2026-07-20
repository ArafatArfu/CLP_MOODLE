<?php
// CLP Admin Panel - FAQ Form (Add/Edit)

require_once __DIR__ . '/includes/auth.php';

$page_title = 'FAQ Form';

$db = clp_db_connect();
$faq = [
    'id' => '',
    'question' => '',
    'answer' => '',
    'category' => '',
    'display_order' => 0,
    'status' => 'draft'
];

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("SELECT * FROM clp_faqs WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    if ($row = clp_stmt_fetch_assoc($stmt)) {
        $faq = $row;
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $faq['question'] = trim($_POST['question'] ?? '');
    $faq['answer'] = trim($_POST['answer'] ?? '');
    $faq['category'] = clp_sanitize($_POST['category'] ?? '');
    $faq['display_order'] = (int)($_POST['display_order'] ?? 0);
    $faq['status'] = clp_sanitize($_POST['status'] ?? 'draft');

    if (empty($faq['question']) || empty($faq['answer'])) {
        clp_set_error('Question and answer are required.');
    } else {
        if (!empty($faq['id'])) {
            $stmt = $db->prepare("UPDATE clp_faqs SET question=?, answer=?, category=?, display_order=?, status=? WHERE id=?");
            $stmt->bind_param("sssisi", $faq['question'], $faq['answer'], $faq['category'], $faq['display_order'], $faq['status'], $faq['id']);
        } else {
            $stmt = $db->prepare("INSERT INTO clp_faqs (question, answer, category, display_order, status, created_by, updated_by) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $created_by = clp_get_admin()['id'];
            $stmt->bind_param("sssissi", $faq['question'], $faq['answer'], $faq['category'], $faq['display_order'], $faq['status'], $created_by, $created_by);
        }

        if ($stmt->execute()) {
            clp_set_success(!empty($faq['id']) ? 'FAQ updated successfully.' : 'FAQ created successfully.');
            $stmt->close();
            $db->close();
            clp_redirect(CLP_ADMIN_URL . '/faq.php');
        } else {
            clp_set_error('Failed to save FAQ.');
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
            <h3 class="card-title"><?php echo !empty($faq['id']) ? 'Edit FAQ' : 'Add New FAQ'; ?></h3>
            <a href="<?php echo CLP_ADMIN_URL; ?>/faq.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to List</a>
        </div>
        <form method="POST" action="">
            <div class="form-group">
                <label class="form-label">Question *</label>
                <textarea name="question" class="form-control" rows="2" required><?php echo clp_escape($faq['question']); ?></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Answer *</label>
                <textarea name="answer" class="form-control" rows="4" required><?php echo clp_escape($faq['answer']); ?></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Category</label>
                <input type="text" name="category" class="form-control" value="<?php echo clp_escape($faq['category']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Display Order</label>
                <input type="number" name="display_order" class="form-control" value="<?php echo (int)$faq['display_order']; ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="draft" <?php echo $faq['status'] === 'draft' ? 'selected' : ''; ?>>Draft</option>
                    <option value="published" <?php echo $faq['status'] === 'published' ? 'selected' : ''; ?>>Published</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
            <a href="<?php echo CLP_ADMIN_URL; ?>/faq.php" class="btn btn-primary">Cancel</a>
        </form>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
