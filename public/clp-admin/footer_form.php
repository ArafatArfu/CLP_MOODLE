<?php
// CLP Admin Panel - Footer Management Form

require_once __DIR__ . '/includes/auth.php';

$page_title = 'Footer Management';

$db = clp_db_connect();

// Ensure table exists.
$db->query("CREATE TABLE IF NOT EXISTS clp_footer_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) NOT NULL UNIQUE,
    setting_value TEXT NOT NULL,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $allowed_keys = [
        'logo', 'about_text', 'phone', 'email', 'address', 'mission', 'legal', 'copyright',
        'facebook', 'instagram', 'twitter', 'youtube', 'linkedin',
        'resources', 'quick_links'
    ];

    $success_count = 0;
    $error_count = 0;

    foreach ($allowed_keys as $key) {
        if (isset($_POST[$key])) {
            $raw = trim($_POST[$key]);
            // JSON fields: store raw trimmed value to keep valid JSON.
            // Other fields: store raw trimmed value as well so HTML is preserved where intended.
            $value = $raw;
            $stmt = $db->prepare("INSERT INTO clp_footer_settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value), updated_at = NOW()");
            $stmt->bind_param("ss", $key, $value);
            if ($stmt->execute()) {
                $success_count++;
            } else {
                $error_count++;
            }
            $stmt->close();
        }
    }

    $db->close();

    if ($error_count === 0) {
        clp_set_success('Footer settings updated successfully.');
    } else {
        clp_set_error("Updated $success_count settings, but $error_count failed.");
    }
    clp_redirect(CLP_ADMIN_URL . '/footer.php');
}

$settings = [];
$result = $db->query("SELECT * FROM clp_footer_settings ORDER BY setting_key ASC");
while ($row = $result->fetch_assoc()) {
    $settings[$row['setting_key']] = $row['setting_value'];
}
$db->close();

function footer_form_json_display($value) {
    if (empty($value)) return '';
    // Decode any HTML entities that may have been stored previously.
    $decoded = html_entity_decode($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $json = json_decode($decoded, true);
    if (is_array($json)) {
        return json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
    // If it is not valid JSON, return the cleaned raw string.
    return $decoded;
}

function footer_form_textarea_value($value) {
    // Keep textarea content readable: only prevent breaking out of the textarea.
    return str_replace('</textarea>', '<\/textarea>', $value ?? '');
}

include __DIR__ . '/includes/header.php';
?>

<style>
.footer-form-section { margin-bottom: 24px; padding-bottom: 8px; border-bottom: 1px solid #eef0f4; }
.footer-form-section:last-of-type { border-bottom: 0; }
.footer-form-section-title { font-size: 15px; color: #006b4f; margin: 0 0 16px; display: flex; align-items: center; gap: 8px; }
.footer-form-row { display: flex; flex-wrap: wrap; gap: 16px; }
.footer-form-row .form-group { flex: 1; min-width: 240px; }
.form-actions { display: flex; gap: 10px; margin-top: 24px; }
.form-text { font-size: 13px; color: #666; margin-top: 6px; }
.form-text code { background: #f4f4f4; padding: 2px 6px; border-radius: 4px; font-size: 12px; }
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

    <form method="POST" action="">
        <!-- General Settings -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-cog"></i> General Settings</h3>
            </div>
            <div class="card-body">
                <div class="footer-form-section">
                    <h4 class="footer-form-section-title">Basic Info</h4>
                    <div class="footer-form-row">
                        <div class="form-group">
                            <label>Logo URL</label>
                            <input type="text" name="logo" class="form-control" value="<?php echo htmlspecialchars($settings['logo'] ?? '/theme/clp/assets/images/logo/clp-logo-2022-4.png', ENT_QUOTES); ?>" placeholder="/theme/clp/assets/images/logo/logo.png">
                            <?php if (!empty($settings['logo'])): ?>
                                <img src="<?php echo htmlspecialchars($settings['logo'], ENT_QUOTES); ?>" alt="Logo Preview" style="height:40px;margin-top:8px;object-fit:contain;">
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($settings['phone'] ?? '', ENT_QUOTES); ?>" placeholder="(732) 972-8362">
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($settings['email'] ?? '', ENT_QUOTES); ?>" placeholder="info@clpweb.org">
                        </div>
                    </div>
                </div>

                <div class="footer-form-section">
                    <h4 class="footer-form-section-title">Text Content</h4>
                    <div class="form-group">
                        <label>Mailing Address</label>
                        <textarea name="address" class="form-control" rows="3" placeholder="Computer Literacy Program (CLP)&#10;6 Tharp Lane&#10;Marlboro, NJ 07746, USA"><?php echo footer_form_textarea_value($settings['address'] ?? ''); ?></textarea>
                        <p class="form-text">Use line breaks to separate address lines.</p>
                    </div>
                    <div class="form-group">
                        <label>About / Description Text</label>
                        <textarea name="about_text" class="form-control" rows="3" placeholder="Short description about the organization..."><?php echo footer_form_textarea_value($settings['about_text'] ?? ''); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Mission Text</label>
                        <textarea name="mission" class="form-control" rows="3" placeholder="Mission statement..."><?php echo footer_form_textarea_value($settings['mission'] ?? ''); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Legal Info <span style="color:#e74c3c;">(HTML allowed)</span></label>
                        <textarea name="legal" class="form-control code-editor" rows="2" placeholder="IRS ID: 46-0646134 (HTML allowed)"><?php echo footer_form_textarea_value($settings['legal'] ?? ''); ?></textarea>
                        <p class="form-text">You may use safe HTML tags like <code>&lt;strong&gt;</code>, <code>&lt;em&gt;</code>, <code>&lt;a&gt;</code>.</p>
                    </div>
                    <div class="form-group">
                        <label>Copyright Text</label>
                        <input type="text" name="copyright" class="form-control" value="<?php echo htmlspecialchars($settings['copyright'] ?? '', ENT_QUOTES); ?>" placeholder="Copyright &copy; CLP, 2026">
                    </div>
                </div>
            </div>
        </div>

        <!-- Social Media Links -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-share-alt"></i> Social Media Links</h3>
            </div>
            <div class="card-body">
                <div class="footer-form-row">
                    <div class="form-group">
                        <label>Facebook URL</label>
                        <input type="url" name="facebook" class="form-control" value="<?php echo htmlspecialchars($settings['facebook'] ?? '', ENT_QUOTES); ?>" placeholder="https://facebook.com/YourPage">
                    </div>
                    <div class="form-group">
                        <label>Instagram URL</label>
                        <input type="url" name="instagram" class="form-control" value="<?php echo htmlspecialchars($settings['instagram'] ?? '', ENT_QUOTES); ?>" placeholder="https://www.instagram.com/yourpage">
                    </div>
                    <div class="form-group">
                        <label>Twitter URL</label>
                        <input type="url" name="twitter" class="form-control" value="<?php echo htmlspecialchars($settings['twitter'] ?? '', ENT_QUOTES); ?>" placeholder="https://twitter.com/yourpage">
                    </div>
                    <div class="form-group">
                        <label>YouTube URL</label>
                        <input type="url" name="youtube" class="form-control" value="<?php echo htmlspecialchars($settings['youtube'] ?? '', ENT_QUOTES); ?>" placeholder="https://www.youtube.com/channel/...">
                    </div>
                    <div class="form-group">
                        <label>LinkedIn URL</label>
                        <input type="url" name="linkedin" class="form-control" value="<?php echo htmlspecialchars($settings['linkedin'] ?? '', ENT_QUOTES); ?>" placeholder="https://www.linkedin.com/company/...">
                    </div>
                </div>
            </div>
        </div>

        <!-- Links Lists (JSON) -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-list"></i> Footer Links Lists</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Resources Links</label>
                    <textarea name="resources" class="form-control code-editor" rows="5" placeholder='[{"label":"INDEPENDENT EVALUATION REPORT","link":"/evaluation-report.php"}]'><?php echo footer_form_textarea_value(footer_form_json_display($settings['resources'] ?? '')); ?></textarea>
                    <p class="form-text">JSON array of objects with <code>label</code> and <code>link</code> keys.</p>
                </div>
                <div class="form-group">
                    <label>Quick Links</label>
                    <textarea name="quick_links" class="form-control code-editor" rows="5" placeholder='[{"label":"DONATE ONLINE","link":"/donation-online.php"}]'><?php echo footer_form_textarea_value(footer_form_json_display($settings['quick_links'] ?? '')); ?></textarea>
                    <p class="form-text">JSON array of objects with <code>label</code> and <code>link</code> keys.</p>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Footer Settings</button>
            <a href="<?php echo CLP_ADMIN_URL; ?>/footer.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to List</a>
        </div>
    </form>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
