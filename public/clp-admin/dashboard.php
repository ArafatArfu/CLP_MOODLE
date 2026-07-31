<?php
// CLP Admin Panel - Dashboard

require_once __DIR__ . '/includes/auth.php';

$page_title = 'Dashboard';
$admin = clp_get_admin();

// Get dashboard statistics
$db = clp_db_connect();

// Count all content
$stats = [];

$result = $db->query("SELECT COUNT(*) as count FROM clp_about_history WHERE status = 'published'");
$stats['history'] = $result->fetch_assoc()['count'];

$result = $db->query("SELECT COUNT(*) as count FROM clp_about_impact WHERE status = 'published'");
$stats['impact'] = $result->fetch_assoc()['count'];

$result = $db->query("SELECT COUNT(*) as count FROM clp_about_mission WHERE status = 'published'");
$stats['mission'] = $result->fetch_assoc()['count'];

$result = $db->query("SELECT COUNT(*) as count FROM clp_partners WHERE status = 'published'");
$stats['partners'] = $result->fetch_assoc()['count'];

$result = $db->query("SELECT COUNT(*) as count FROM clp_team_members WHERE status = 'published'");
$stats['team'] = $result->fetch_assoc()['count'];

    $result = $db->query("SELECT COUNT(*) as count FROM clp_faqs WHERE status = 'published'");
    $stats['faq'] = $result->fetch_assoc()['count'];

    $result = $db->query("SELECT COUNT(*) as count FROM clp_news_coverage WHERE status = 'published'");
    $stats['news'] = $result->fetch_assoc()['count'];

    $result = $db->query("SELECT COUNT(*) as count FROM clp_blog_posts WHERE status = 'published'");
    $stats['blog'] = $result->fetch_assoc()['count'];

    $result = $db->query("SELECT COUNT(*) as count FROM clp_eos_reports WHERE status = 'published'");
    $stats['eos'] = $result->fetch_assoc()['count'];

    $result = $db->query("SELECT COUNT(*) as count FROM clp_evaluation_reports WHERE status = 'published'");
    $stats['evaluation'] = $result->fetch_assoc()['count'];

    $result = $db->query("SELECT COUNT(*) as count FROM clp_magazines WHERE status = 'published'");
    $stats['magazines'] = $result->fetch_assoc()['count'];

// CLC participants (owned by the local_clp Moodle plugin, uses mdl_ prefix).
$stats['clc'] = 0;
$clc_recent = [];
if ($res = $db->query("SHOW TABLES LIKE 'mdl_clp_clc_participants'")) {
    if ($res->num_rows > 0) {
        $r = $db->query("SELECT COUNT(*) as count FROM mdl_clp_clc_participants WHERE program = 'clc'");
        $stats['clc'] = (int)$r->fetch_assoc()['count'];

        $r = $db->query("SELECT name, school, timecreated FROM mdl_clp_clc_participants WHERE program = 'clc' ORDER BY timecreated DESC, id DESC LIMIT 5");
        while ($row = $r->fetch_assoc()) {
            $clc_recent[] = $row;
        }
    }
}

// Sponsored centers (owned by the local_centermanagement Moodle plugin). These
// are the records shown on the public "Your Sponsored Center(s)" page.
$stats['centers'] = 0;
$centers_recent = [];
if ($res = $db->query("SHOW TABLES LIKE 'mdl_local_centermanagement_centers'")) {
    if ($res->num_rows > 0) {
        $r = $db->query("SELECT COUNT(*) as count FROM mdl_local_centermanagement_centers WHERE status = 1");
        $stats['centers'] = (int)$r->fetch_assoc()['count'];

        $r = $db->query("SELECT center_name, district, start_date FROM mdl_local_centermanagement_centers ORDER BY timemodified DESC, id DESC LIMIT 5");
        while ($row = $r->fetch_assoc()) {
            $centers_recent[] = $row;
        }
    }
}

// Get recent activities
$recent_activities = [];
$result = $db->query("
    (SELECT 'history' as type, title, updated_at, 'History' as label FROM clp_about_history ORDER BY updated_at DESC LIMIT 3)
    UNION ALL
    (SELECT 'impact' as type, title, updated_at, 'Impact' as label FROM clp_about_impact ORDER BY updated_at DESC LIMIT 3)
    UNION ALL
    (SELECT 'mission' as type, title, updated_at, 'Mission' as label FROM clp_about_mission ORDER BY updated_at DESC LIMIT 3)
    UNION ALL
    (SELECT 'partners' as type, name as title, updated_at, 'Partner' as label FROM clp_partners ORDER BY updated_at DESC LIMIT 3)
    UNION ALL
    (SELECT 'team' as type, full_name as title, updated_at, 'Team Member' as label FROM clp_team_members ORDER BY updated_at DESC LIMIT 3)
    UNION ALL
    (SELECT 'faq' as type, question as title, updated_at, 'FAQ' as label FROM clp_faqs ORDER BY updated_at DESC LIMIT 3)
    UNION ALL
    (SELECT 'news' as type, title, updated_at, 'News Coverage' as label FROM clp_news_coverage ORDER BY updated_at DESC LIMIT 3)
    UNION ALL
    (SELECT 'blog' as type, title, updated_at, 'Blog' as label FROM clp_blog_posts ORDER BY updated_at DESC LIMIT 3)
    UNION ALL
    (SELECT 'eos' as type, title, updated_at, 'EOS Report' as label FROM clp_eos_reports ORDER BY updated_at DESC LIMIT 3)
    UNION ALL
    (SELECT 'evaluation' as type, title, updated_at, 'Evaluation Report' as label FROM clp_evaluation_reports ORDER BY updated_at DESC LIMIT 3)
    ORDER BY updated_at DESC
    LIMIT 10
");

while ($row = $result->fetch_assoc()) {
    $recent_activities[] = $row;
}

$db->close();

include __DIR__ . '/includes/header.php';
?>

<div class="content-area">
        <!-- Flash Messages -->
        <?php $success = clp_get_message('clp_success'); ?>
        <?php $error = clp_get_message('clp_error'); ?>
        <?php if ($success): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <?php echo clp_escape($success); ?>
            </div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <?php echo clp_escape($error); ?>
            </div>
        <?php endif; ?>
        
        <!-- Stats Grid -->
        <div class="stats-grid">
            <a href="<?php echo CLP_ADMIN_URL; ?>/history.php" class="stat-card-link">
                <div class="stat-card">
                    <div class="stat-icon blue">
                        <i class="fas fa-history"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo $stats['history']; ?></h3>
                        <p>History Content</p>
                    </div>
                </div>
            </a>
            
            <a href="<?php echo CLP_ADMIN_URL; ?>/impact.php" class="stat-card-link">
                <div class="stat-card">
                    <div class="stat-icon green">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo $stats['impact']; ?></h3>
                        <p>Impact Statistics</p>
                    </div>
                </div>
            </a>
            
            <a href="<?php echo CLP_ADMIN_URL; ?>/mission.php" class="stat-card-link">
                <div class="stat-card">
                    <div class="stat-icon orange">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo $stats['mission']; ?></h3>
                        <p>Mission Content</p>
                    </div>
                </div>
            </a>
            
            <a href="<?php echo CLP_ADMIN_URL; ?>/partners.php" class="stat-card-link">
                <div class="stat-card">
                    <div class="stat-icon purple">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo $stats['partners']; ?></h3>
                        <p>Partners</p>
                    </div>
                </div>
            </a>
            
            <a href="<?php echo CLP_ADMIN_URL; ?>/team.php" class="stat-card-link">
                <div class="stat-card">
                    <div class="stat-icon blue">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo $stats['team']; ?></h3>
                        <p>Team Members</p>
                    </div>
                </div>
            </a>
            
            <a href="<?php echo CLP_ADMIN_URL; ?>/faq.php" class="stat-card-link">
                <div class="stat-card">
                    <div class="stat-icon green">
                        <i class="fas fa-question-circle"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo $stats['faq']; ?></h3>
                        <p>FAQs</p>
                    </div>
                </div>
            </a>

            <a href="<?php echo CLP_ADMIN_URL; ?>/clc.php" class="stat-card-link">
                <div class="stat-card">
                    <div class="stat-icon orange">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo $stats['clc']; ?></h3>
                        <p>CLC Participants</p>
                    </div>
                </div>
            </a>

            <a href="<?php echo CLP_ADMIN_URL; ?>/centers.php" class="stat-card-link">
                <div class="stat-card">
                    <div class="stat-icon blue">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo $stats['centers']; ?></h3>
                        <p>Sponsored Centers</p>
                    </div>
                </div>
            </a>

            <a href="<?php echo CLP_ADMIN_URL; ?>/news_coverage.php" class="stat-card-link">
                <div class="stat-card">
                    <div class="stat-icon orange">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo $stats['news']; ?></h3>
                        <p>News Coverage</p>
                    </div>
                </div>
            </a>

            <a href="<?php echo CLP_ADMIN_URL; ?>/blog.php" class="stat-card-link">
                <div class="stat-card">
                    <div class="stat-icon green">
                        <i class="fas fa-blog"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo $stats['blog']; ?></h3>
                        <p>Blog Posts</p>
                    </div>
                </div>
            </a>

            <a href="<?php echo CLP_ADMIN_URL; ?>/eos-reports.php" class="stat-card-link">
                <div class="stat-card">
                    <div class="stat-icon purple">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo $stats['eos']; ?></h3>
                        <p>EOS Reports</p>
                    </div>
                </div>
            </a>

            <a href="<?php echo CLP_ADMIN_URL; ?>/evaluation-reports.php" class="stat-card-link">
                <div class="stat-card">
                    <div class="stat-icon teal">
                        <i class="fas fa-file-signature"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo $stats['evaluation'] ?? 0; ?></h3>
                        <p>Evaluation Reports</p>
                    </div>
                </div>
            </a>

            <a href="<?php echo CLP_ADMIN_URL; ?>/magazines_admin.php" class="stat-card-link">
                <div class="stat-card">
                    <div class="stat-icon orange">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo $stats['magazines'] ?? 0; ?></h3>
                        <p>Magazines</p>
                    </div>
                </div>
            </a>
        </div>
        
        <!-- Recent Activity -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-clock"></i> Recent Activity</h3>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Title</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($recent_activities)): ?>
                            <tr>
                                <td colspan="3" style="text-align: center; color: #999;">No activity yet. Start adding content!</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($recent_activities as $activity): ?>
                                <tr>
                                    <td><span class="badge badge-success"><?php echo clp_escape($activity['label']); ?></span></td>
                                    <td><?php echo clp_escape($activity['title']); ?></td>
                                    <td><?php echo clp_format_date($activity['updated_at']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent CLC Enrolments -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-laptop-code"></i> Recent CLC Enrolments</h3>
                <a href="<?php echo CLP_ADMIN_URL; ?>/clc.php" class="btn btn-sm btn-primary"><i class="fas fa-external-link-alt"></i> View All</a>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>School</th>
                            <th>Enrolment Year</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($clc_recent)): ?>
                            <tr>
                                <td colspan="3" style="text-align: center; color: #999;">No CLC participants yet. <a href="<?php echo CLP_ADMIN_URL; ?>/clc_form.php">Add the first participant</a>.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($clc_recent as $row): ?>
                                <tr>
                                    <td><strong><?php echo clp_escape($row['name']); ?></strong></td>
                                    <td><?php echo clp_escape($row['school']); ?></td>
                                    <td><?php echo !empty($row['timecreated']) ? date('Y', (int)$row['timecreated']) : '—'; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Sponsored Centers -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-building"></i> Recent Sponsored Centers</h3>
                <a href="<?php echo CLP_ADMIN_URL; ?>/centers.php" class="btn btn-sm btn-primary"><i class="fas fa-external-link-alt"></i> View All</a>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Center Name</th>
                            <th>District</th>
                            <th>Start Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($centers_recent)): ?>
                            <tr>
                                <td colspan="3" style="text-align: center; color: #999;">No sponsored centers yet. <a href="<?php echo CLP_ADMIN_URL; ?>/centers_form.php">Add the first center</a>.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($centers_recent as $row): ?>
                                <tr>
                                    <td><strong><?php echo clp_escape($row['center_name']); ?></strong></td>
                                    <td><?php echo clp_escape($row['district']); ?></td>
                                    <td><?php echo !empty($row['start_date']) ? date('Y', (int)$row['start_date']) : '—'; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <?php include __DIR__ . '/includes/footer.php'; ?>
