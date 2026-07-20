<?php
// CLP Admin Panel - Team Members Form (Add/Edit)

require_once __DIR__ . '/includes/auth.php';

$page_title = 'Team Members Form';

$db = clp_db_connect();
$member = [
    'id' => '',
    'full_name' => '',
    'designation' => '',
    'profile_image' => '',
    'biography' => '',
    'email' => '',
    'phone' => '',
    'facebook_url' => '',
    'linkedin_url' => '',
    'other_social' => '',
    'department' => '',
    'display_order' => 0,
    'status' => 'draft'
];

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("SELECT * FROM clp_team_members WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    if ($row = clp_stmt_fetch_assoc($stmt)) {
        $member = $row;
        $member['other_social'] = is_string($member['other_social']) ? $member['other_social'] : json_encode($member['other_social'] ?? []);
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $member['full_name'] = clp_sanitize($_POST['full_name'] ?? '');
    $member['designation'] = clp_sanitize($_POST['designation'] ?? '');
    $member['profile_image'] = clp_sanitize($_POST['profile_image'] ?? '');
    $member['biography'] = trim($_POST['biography'] ?? '');
    $member['email'] = clp_sanitize($_POST['email'] ?? '');
    $member['phone'] = clp_sanitize($_POST['phone'] ?? '');
    $member['facebook_url'] = clp_sanitize($_POST['facebook_url'] ?? '');
    $member['linkedin_url'] = clp_sanitize($_POST['linkedin_url'] ?? '');
    $member['other_social'] = trim($_POST['other_social'] ?? '');
    $member['department'] = clp_sanitize($_POST['department'] ?? '');
    $member['display_order'] = (int)($_POST['display_order'] ?? 0);
    $member['status'] = clp_sanitize($_POST['status'] ?? 'draft');

    if (empty($member['full_name']) || empty($member['designation'])) {
        clp_set_error('Full name and designation are required.');
    } else {
        if (!empty($member['id'])) {
            $stmt = $db->prepare("UPDATE clp_team_members SET full_name=?, designation=?, profile_image=?, biography=?, email=?, phone=?, facebook_url=?, linkedin_url=?, other_social=?, department=?, display_order=?, status=? WHERE id=?");
            $stmt->bind_param("sssssssssisi", $member['full_name'], $member['designation'], $member['profile_image'], $member['biography'], $member['email'], $member['phone'], $member['facebook_url'], $member['linkedin_url'], $member['other_social'], $member['department'], $member['display_order'], $member['status'], $member['id']);
        } else {
            $stmt = $db->prepare("INSERT INTO clp_team_members (full_name, designation, profile_image, biography, email, phone, facebook_url, linkedin_url, other_social, department, display_order, status, created_by, updated_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $created_by = clp_get_admin()['id'];
            $stmt->bind_param("sssssssssissi", $member['full_name'], $member['designation'], $member['profile_image'], $member['biography'], $member['email'], $member['phone'], $member['facebook_url'], $member['linkedin_url'], $member['other_social'], $member['department'], $member['display_order'], $member['status'], $created_by, $created_by);
        }

        if ($stmt->execute()) {
            clp_set_success(!empty($member['id']) ? 'Team member updated successfully.' : 'Team member created successfully.');
            $stmt->close();
            $db->close();
            clp_redirect(CLP_ADMIN_URL . '/team.php');
        } else {
            clp_set_error('Failed to save team member.');
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
            <h3 class="card-title"><?php echo !empty($member['id']) ? 'Edit Team Member' : 'Add New Team Member'; ?></h3>
            <a href="<?php echo CLP_ADMIN_URL; ?>/team.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to List</a>
        </div>
        <form method="POST" action="">
            <div class="form-group">
                <label class="form-label">Full Name *</label>
                <input type="text" name="full_name" class="form-control" required value="<?php echo clp_escape($member['full_name']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Designation *</label>
                <input type="text" name="designation" class="form-control" required value="<?php echo clp_escape($member['designation']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Profile Image URL</label>
                <input type="text" name="profile_image" class="form-control" value="<?php echo clp_escape($member['profile_image']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Biography</label>
                <textarea name="biography" class="form-control" rows="4"><?php echo clp_escape($member['biography']); ?></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo clp_escape($member['email']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="<?php echo clp_escape($member['phone']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Facebook URL</label>
                <input type="text" name="facebook_url" class="form-control" value="<?php echo clp_escape($member['facebook_url']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">LinkedIn URL</label>
                <input type="text" name="linkedin_url" class="form-control" value="<?php echo clp_escape($member['linkedin_url']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Other Social Links (JSON)</label>
                <textarea name="other_social" class="form-control" rows="2" placeholder='{"twitter": "https://twitter.com/username"}'><?php echo clp_escape($member['other_social']); ?></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Department</label>
                <input type="text" name="department" class="form-control" value="<?php echo clp_escape($member['department']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Display Order</label>
                <input type="number" name="display_order" class="form-control" value="<?php echo (int)$member['display_order']; ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="draft" <?php echo $member['status'] === 'draft' ? 'selected' : ''; ?>>Draft</option>
                    <option value="published" <?php echo $member['status'] === 'published' ? 'selected' : ''; ?>>Published</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
            <a href="<?php echo CLP_ADMIN_URL; ?>/team.php" class="btn btn-primary">Cancel</a>
        </form>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
