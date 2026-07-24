<?php
// CLP Admin Panel - Our Work Page Form (Add/Edit + Sections)

require_once __DIR__ . '/includes/auth.php';

$page_title = 'Our Work Page Form';

$db = clp_db_connect();
$page = [
    'id' => '',
    'slug' => '',
    'title' => '',
    'seo_title' => '',
    'seo_description' => '',
    'og_image' => '',
    'status' => 'published',
    'display_order' => 0
];
$sections = [];
$editing_section = null;

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("SELECT * FROM clp_ourwork_pages WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    if ($row = clp_stmt_fetch_assoc($stmt)) {
        $page = $row;
    }
    $stmt->close();

    $res = $db->prepare("SELECT * FROM clp_ourwork_sections WHERE page_id = ? ORDER BY display_order ASC, id ASC");
    $res->bind_param("i", $id);
    $res->execute();
    $meta = $res->result_metadata();
    $fields = [];
    $row = [];
    while ($field = $meta->fetch_field()) {
        $fields[] = &$row[$field->name];
    }
    call_user_func_array([$res, 'bind_result'], $fields);
    while ($res->fetch()) {
        $sections[] = array_map(function($v) { return $v; }, $row);
    }
    $res->free_result();
    $res->close();
}

if (isset($_GET['section_id']) && isset($_GET['section_action']) && $_GET['section_action'] === 'edit') {
    $sid = (int)$_GET['section_id'];
    $stmt = $db->prepare("SELECT * FROM clp_ourwork_sections WHERE id = ? AND page_id = ? LIMIT 1");
    $stmt->bind_param("ii", $sid, $page['id']);
    $stmt->execute();
    if ($row = clp_stmt_fetch_assoc($stmt)) {
        $editing_section = $row;
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save_page'])) {
        $page['slug'] = clp_sanitize($_POST['slug'] ?? '');
        $page['title'] = clp_sanitize($_POST['title'] ?? '');
        $page['seo_title'] = clp_sanitize($_POST['seo_title'] ?? '');
        $page['seo_description'] = trim($_POST['seo_description'] ?? '');
        $page['og_image'] = clp_sanitize($_POST['og_image'] ?? '');
        $page['status'] = clp_sanitize($_POST['status'] ?? 'published');
        $page['display_order'] = (int)($_POST['display_order'] ?? 0);

        if (empty($page['title']) || empty($page['slug'])) {
            clp_set_error('Title and Slug are required.');
        } else {
            if (!empty($page['id'])) {
                $stmt = $db->prepare("UPDATE clp_ourwork_pages SET slug=?, title=?, seo_title=?, seo_description=?, og_image=?, status=?, display_order=? WHERE id=?");
                $stmt->bind_param("sssssisi", $page['slug'], $page['title'], $page['seo_title'], $page['seo_description'], $page['og_image'], $page['status'], $page['display_order'], $page['id']);
            } else {
                $stmt = $db->prepare("INSERT INTO clp_ourwork_pages (slug, title, seo_title, seo_description, og_image, status, display_order) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssssi", $page['slug'], $page['title'], $page['seo_title'], $page['seo_description'], $page['og_image'], $page['status'], $page['display_order']);
            }
            if ($stmt->execute()) {
                if (empty($page['id'])) {
                    $page['id'] = $db->insert_id;
                }
                clp_set_success(!empty($page['id']) && $_POST['old_id'] !== '' ? 'Page updated successfully.' : 'Page created successfully.');
                $stmt->close();
                clp_redirect(CLP_ADMIN_URL . '/ourwork_form.php?id=' . $page['id']);
            } else {
                clp_set_error('Failed to save page.');
            }
            $stmt->close();
        }
    }

    if (isset($_POST['save_section'])) {
        $sec = [
            'page_id' => (int)($_POST['page_id'] ?? 0),
            'section_key' => clp_sanitize($_POST['section_key'] ?? ''),
            'section_type' => clp_sanitize($_POST['section_type'] ?? 'text'),
            'content' => trim($_POST['content'] ?? ''),
            'display_order' => (int)($_POST['display_order'] ?? 0),
            'status' => clp_sanitize($_POST['status'] ?? 'published'),
        ];

        if (empty($sec['section_key']) || empty($sec['page_id'])) {
            clp_set_error('Section key and page are required.');
        } else {
            if (!empty($_POST['section_id'])) {
                $sid = (int)$_POST['section_id'];
                $stmt = $db->prepare("UPDATE clp_ourwork_sections SET section_key=?, section_type=?, content=?, display_order=?, status=? WHERE id=? AND page_id=?");
                $stmt->bind_param("sssissi", $sec['section_key'], $sec['section_type'], $sec['content'], $sec['display_order'], $sec['status'], $sid, $sec['page_id']);
            } else {
                $stmt = $db->prepare("INSERT INTO clp_ourwork_sections (page_id, section_key, section_type, content, display_order, status) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("isssis", $sec['page_id'], $sec['section_key'], $sec['section_type'], $sec['content'], $sec['display_order'], $sec['status']);
            }
            if ($stmt->execute()) {
                clp_set_success(!empty($_POST['section_id']) ? 'Section updated successfully.' : 'Section added successfully.');
            } else {
                clp_set_error('Failed to save section.');
            }
            $stmt->close();
        }
        clp_redirect(CLP_ADMIN_URL . '/ourwork_form.php?id=' . $sec['page_id']);
    }

    if (isset($_POST['delete_section'])) {
        $sid = (int)$_POST['section_id'];
        $pid = (int)$_POST['page_id'];
        $stmt = $db->prepare("DELETE FROM clp_ourwork_sections WHERE id = ? AND page_id = ?");
        $stmt->bind_param("ii", $sid, $pid);
        if ($stmt->execute()) {
            clp_set_success('Section deleted successfully.');
        } else {
            clp_set_error('Failed to delete section.');
        }
        $stmt->close();
        clp_redirect(CLP_ADMIN_URL . '/ourwork_form.php?id=' . $pid);
    }
}

$db->close();

include __DIR__ . '/includes/header.php';
?>

<style>
.ourwork-form-section { margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px solid #eef0f4; }
.ourwork-form-section:last-of-type { border-bottom: 0; }
.ourwork-form-section-title { font-size: 16px; color: #006b4f; margin: 0 0 16px; display: flex; align-items: center; gap: 8px; font-weight: 600; }
.ourwork-form-row { display: flex; flex-wrap: wrap; gap: 16px; }
.ourwork-form-row .form-group { flex: 1; min-width: 240px; }
.form-actions { display: flex; gap: 10px; margin-top: 24px; flex-wrap: wrap; }
.section-list-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
.section-list-header h4 { margin: 0; font-size: 16px; color: #333; }
.visual-editor-card { background: #f8f9fa; border: 1px dashed #d0d5dd; border-radius: 8px; padding: 16px; margin-top: 16px; }
.visual-editor-card .card-header { background: transparent; padding-bottom: 12px; margin-bottom: 12px; border-bottom: 1px solid #eef0f4; }
.structured-fields .form-group { margin-bottom: 14px; }
.structured-fields label { font-weight: 500; font-size: 13px; color: #444; margin-bottom: 6px; display: block; }
.section-form-card { border: 1px solid #e0e0e0; border-radius: 8px; padding: 20px; background: #fff; margin-top: 16px; }
</style>

<div class="content-area">
    <?php $success = clp_get_message('clp_success'); ?>
    <?php $error = clp_get_message('clp_error'); ?>
    <?php if ($success): ?>
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?php echo clp_escape($success); ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> <?php echo clp_escape($error); ?></div>
    <?php endif; ?>

    <!-- Page Settings Card -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-file-alt"></i> <?php echo !empty($page['id']) ? 'Edit' : 'Add'; ?> Page Settings</h3>
            <a href="<?php echo CLP_ADMIN_URL; ?>/ourwork.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to List</a>
        </div>
        <div class="card-body">
            <form method="post" action="">
                <input type="hidden" name="old_id" value="<?php echo clp_escape($page['id']); ?>">
                <input type="hidden" name="save_page" value="1">

                <div class="ourwork-form-section">
                    <h4 class="ourwork-form-section-title">Basic Information</h4>
                    <div class="ourwork-form-row">
                        <div class="form-group">
                            <label>Page Title <span style="color:#e74c3c;">*</span></label>
                            <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($page['title'], ENT_QUOTES); ?>" required placeholder="e.g. Computer Literacy Center (CLC)">
                            <small class="form-text">Main heading shown on the public page.</small>
                        </div>
                        <div class="form-group">
                            <label>URL Slug <span style="color:#e74c3c;">*</span></label>
                            <input type="text" name="slug" class="form-control" value="<?php echo htmlspecialchars($page['slug'], ENT_QUOTES); ?>" required placeholder="e.g. clc-teaching">
                            <small class="form-text">Used in URL: /{slug}.php</small>
                        </div>
                    </div>
                </div>

                <div class="ourwork-form-section">
                    <h4 class="ourwork-form-section-title">SEO & Social</h4>
                    <div class="ourwork-form-row">
                        <div class="form-group">
                            <label>SEO Title</label>
                            <input type="text" name="seo_title" class="form-control" value="<?php echo htmlspecialchars($page['seo_title'], ENT_QUOTES); ?>" placeholder="SEO title for search engines">
                        </div>
                        <div class="form-group">
                            <label>OG Image URL</label>
                            <input type="text" name="og_image" class="form-control" value="<?php echo htmlspecialchars($page['og_image'], ENT_QUOTES); ?>" placeholder="/path/to/social-share-image.jpg">
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:16px;">
                        <label>SEO Description</label>
                        <textarea name="seo_description" class="form-control" rows="2" placeholder="Short description for search engines..."><?php echo htmlspecialchars($page['seo_description'], ENT_QUOTES); ?></textarea>
                    </div>
                </div>

                <div class="ourwork-form-section">
                    <h4 class="ourwork-form-section-title">Publishing</h4>
                    <div class="ourwork-form-row">
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="published" <?php echo $page['status'] === 'published' ? 'selected' : ''; ?>>Published</option>
                                <option value="draft" <?php echo $page['status'] === 'draft' ? 'selected' : ''; ?>>Draft</option>
                            </select>
                            <small class="form-text">Only published pages are visible on the website.</small>
                        </div>
                        <div class="form-group">
                            <label>Display Order</label>
                            <input type="number" name="display_order" class="form-control" value="<?php echo (int)$page['display_order']; ?>" placeholder="0">
                            <small class="form-text">Lower numbers appear first in navigation/lists.</small>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Page</button>
                    <?php if (!empty($page['id'])): ?>
                        <a href="<?php echo CLP_ADMIN_URL; ?>/ourwork.php" class="btn btn-secondary">Cancel</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <?php if (!empty($page['id'])): ?>
        <!-- Sections Management Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-puzzle-piece"></i> Page Sections</h3>
                <span class="badge badge-info"><?php echo count($sections); ?> sections</span>
            </div>
            <div class="card-body">
                <?php if (empty($sections)): ?>
                    <p style="color:#999;text-align:center;padding:20px;">No sections added yet. Use the form below to add your first section.</p>
                <?php else: ?>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width:60px;">Order</th>
                                    <th>Section Key</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th style="width:220px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($sections as $sec): ?>
                                    <tr>
                                        <td><strong><?php echo (int)$sec['display_order']; ?></strong></td>
                                        <td><code><?php echo clp_escape($sec['section_key']); ?></code></td>
                                        <td><?php echo clp_escape($sec['section_type']); ?></td>
                                        <td>
                                            <span class="badge <?php echo $sec['status'] === 'published' ? 'badge-success' : 'badge-warning'; ?>">
                                                <?php echo ucfirst(clp_escape($sec['status'])); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="<?php echo CLP_ADMIN_URL; ?>/ourwork_form.php?id=<?php echo $page['id']; ?>&section_action=edit&section_id=<?php echo $sec['id']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                            <form method="post" style="display:inline;" onsubmit="return confirm('Delete this section? This action cannot be undone.');">
                                                <input type="hidden" name="delete_section" value="1">
                                                <input type="hidden" name="section_id" value="<?php echo $sec['id']; ?>">
                                                <input type="hidden" name="page_id" value="<?php echo $page['id']; ?>">
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Add / Edit Section Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-plus-circle"></i> <?php echo $editing_section ? 'Edit Section' : 'Add New Section'; ?></h3>
            </div>
            <div class="card-body">
                <form method="post" action="">
                    <input type="hidden" name="save_section" value="1">
                    <input type="hidden" name="page_id" value="<?php echo (int)$page['id']; ?>">
                    <?php if ($editing_section): ?>
                        <input type="hidden" name="section_id" value="<?php echo (int)$editing_section['id']; ?>">
                    <?php endif; ?>

                    <div class="ourwork-form-section">
                        <h4 class="ourwork-form-section-title">Section Configuration</h4>
                        <div class="ourwork-form-row">
                            <div class="form-group">
                                <label>Section Key <span style="color:#e74c3c;">*</span></label>
                                <input type="text" name="section_key" class="form-control" value="<?php echo htmlspecialchars($editing_section['section_key'] ?? '', ENT_QUOTES); ?>" required placeholder="e.g. hero, intro, gallery_1">
                                <small class="form-text">Unique identifier for this section (no spaces).</small>
                            </div>
                            <div class="form-group">
                                <label>Section Type <span style="color:#e74c3c;">*</span></label>
                                <select name="section_type" id="section_type_select" class="form-control" required>
                                    <option value="hero" <?php echo ($editing_section['section_type'] ?? '') === 'hero' ? 'selected' : ''; ?>>Hero / Banner</option>
                                    <option value="text" <?php echo ($editing_section['section_type'] ?? '') === 'text' ? 'selected' : ''; ?>>Text Block</option>
                                    <option value="text_with_carousel" <?php echo ($editing_section['section_type'] ?? '') === 'text_with_carousel' ? 'selected' : ''; ?>>Text with Image Carousel</option>
                                    <option value="text_with_map" <?php echo ($editing_section['section_type'] ?? '') === 'text_with_map' ? 'selected' : ''; ?>>Text with Map Image</option>
                                    <option value="list_cards" <?php echo ($editing_section['section_type'] ?? '') === 'list_cards' ? 'selected' : ''; ?>>List Cards</option>
                                    <option value="image" <?php echo ($editing_section['section_type'] ?? '') === 'image' ? 'selected' : ''; ?>>Image</option>
                                    <option value="sponsorship_media" <?php echo ($editing_section['section_type'] ?? '') === 'sponsorship_media' ? 'selected' : ''; ?>>Sponsorship Media (Images + Text)</option>
                                    <option value="gallery" <?php echo ($editing_section['section_type'] ?? '') === 'gallery' ? 'selected' : ''; ?>>Gallery</option>
                                    <option value="stats" <?php echo ($editing_section['section_type'] ?? '') === 'stats' ? 'selected' : ''; ?>>Stats / Counter</option>
                                    <option value="benefits" <?php echo ($editing_section['section_type'] ?? '') === 'benefits' ? 'selected' : ''; ?>>Benefits + CTA</option>
                                    <option value="video_section" <?php echo ($editing_section['section_type'] ?? '') === 'video_section' ? 'selected' : ''; ?>>Video Section</option>
                                    <option value="table" <?php echo ($editing_section['section_type'] ?? '') === 'table' ? 'selected' : ''; ?>>Table</option>
                                    <option value="cta" <?php echo ($editing_section['section_type'] ?? '') === 'cta' ? 'selected' : ''; ?>>Call to Action</option>
                                    <option value="custom" <?php echo ($editing_section['section_type'] ?? '') === 'custom' ? 'selected' : ''; ?>>Custom HTML</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Display Order</label>
                                <input type="number" name="display_order" class="form-control" value="<?php echo (int)($editing_section['display_order'] ?? 0); ?>" placeholder="0">
                                <small class="form-text">Sections are displayed in ascending order.</small>
                            </div>
                        </div>
                    </div>

                    <div class="ourwork-form-section">
                        <h4 class="ourwork-form-section-title">Content</h4>
                        <div class="form-group">
                            <label>Content JSON <span style="color:#e74c3c;">*</span></label>
                            <textarea name="content" id="section_content_json" class="form-control code-editor" rows="6" required placeholder='{"heading":"Title","body":"Paragraph text..."}'><?php echo htmlspecialchars($editing_section['content'] ?? '', ENT_QUOTES); ?></textarea>
                            <small class="form-text">This field is automatically updated from the Visual Editor below. You can also edit it manually if needed.</small>
                        </div>

                        <div class="visual-editor-card">
                            <div class="card-header" style="padding-left:0;padding-right:0;">
                                <h5 class="card-title"><i class="fas fa-sliders-h"></i> Visual Editor</h5>
                                <small class="form-text text-muted">Fill the fields below. The JSON above will update automatically.</small>
                            </div>
                            <div class="card-body" style="padding-left:0;padding-right:0;">
                                <?php
                                require_once __DIR__ . '/includes/ourwork_form_fields.php';
                                $content = json_decode($editing_section['content'] ?? '{}', true);
                                if (!is_array($content)) $content = [];
                                ourwork_form_render_fields($content, $editing_section['section_type'] ?? 'text');
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="ourwork-form-section">
                        <h4 class="ourwork-form-section-title">Publishing</h4>
                        <div class="ourwork-form-row">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="published" <?php echo ($editing_section['status'] ?? 'published') === 'published' ? 'selected' : ''; ?>>Published</option>
                                    <option value="draft" <?php echo ($editing_section['status'] ?? '') === 'draft' ? 'selected' : ''; ?>>Draft</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Section</button>
                        <?php if ($editing_section): ?>
                            <a href="<?php echo CLP_ADMIN_URL; ?>/ourwork_form.php?id=<?php echo $page['id']; ?>" class="btn btn-secondary">Cancel Edit</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
