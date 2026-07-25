<?php
// CLP Admin Panel - News Coverage Video Section Form

require_once __DIR__ . '/includes/auth.php';

$page_title = 'News Coverage Video Section';
$admin = clp_get_admin();

$db = clp_db_connect();

// Get existing video section
$video = $db->query("SELECT * FROM clp_news_coverage_video LIMIT 1")->fetch_assoc();
if (!$video) {
    $video = [
        'section_class' => 'introduction-wrap news fact-counter-2 sec-padd',
        'background_image' => '',
        'heading' => '',
        'description' => '',
        'youtube_url' => '',
        'play_image' => '/theme/clp/assets/images/play.svg'
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $video['section_class'] = clp_sanitize($_POST['section_class'] ?? '');
    $video['background_image'] = clp_sanitize($_POST['background_image'] ?? '');
    $video['heading'] = clp_sanitize($_POST['heading'] ?? '');
    $video['description'] = trim($_POST['description'] ?? '');
    $video['youtube_url'] = clp_sanitize($_POST['youtube_url'] ?? '');
    $video['play_image'] = clp_sanitize($_POST['play_image'] ?? '/theme/clp/assets/images/play.svg');
    $video['status'] = clp_sanitize($_POST['status'] ?? 'published');

    if (empty($video['heading'])) {
        clp_set_error('Heading is required.');
    } else {
        if (!empty($video['id'])) {
            $stmt = $db->prepare("UPDATE clp_news_coverage_video SET section_class=?, background_image=?, heading=?, description=?, youtube_url=?, play_image=?, status=? WHERE id=?");
            $stmt->bind_param("sssssssi", 
                $video['section_class'], $video['background_image'], $video['heading'],
                $video['description'], $video['youtube_url'], $video['play_image'],
                $video['status'], $video['id']
            );
        } else {
            $stmt = $db->prepare("INSERT INTO clp_news_coverage_video (section_class, background_image, heading, description, youtube_url, play_image, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", 
                $video['section_class'], $video['background_image'], $video['heading'],
                $video['description'], $video['youtube_url'], $video['play_image'],
                $video['status']
            );
        }

        if ($stmt->execute()) {
            clp_set_success('Video section saved successfully.');
            $stmt->close();
            $db->close();
            clp_redirect(CLP_ADMIN_URL . '/news_coverage.php');
        } else {
            clp_set_error('Failed to save video section.');
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
            <h3 class="card-title">Video Section Settings</h3>
            <a href="<?php echo CLP_ADMIN_URL; ?>/news_coverage.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to List</a>
        </div>
        <form method="POST" action="">
            <div class="form-group">
                <label class="form-label">Section Class</label>
                <input type="text" name="section_class" class="form-control" value="<?php echo clp_escape($video['section_class']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Background Image</label>
                <input type="text" name="background_image" class="form-control" value="<?php echo clp_escape($video['background_image']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Heading *</label>
                <input type="text" name="heading" class="form-control" required value="<?php echo clp_escape($video['heading']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="6"><?php echo clp_escape($video['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">YouTube URL</label>
                <input type="text" name="youtube_url" class="form-control" value="<?php echo clp_escape($video['youtube_url']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Play Image</label>
                <input type="text" name="play_image" class="form-control" value="<?php echo clp_escape($video['play_image']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="draft" <?php echo $video['status'] === 'draft' ? 'selected' : ''; ?>>Draft</option>
                    <option value="published" <?php echo $video['status'] === 'published' ? 'selected' : ''; ?>>Published</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
            <a href="<?php echo CLP_ADMIN_URL; ?>/news_coverage.php" class="btn btn-primary">Cancel</a>
        </form>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
