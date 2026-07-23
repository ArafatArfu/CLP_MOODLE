<?php
// CLP Admin Panel - CLC Participant Detail (View).
//
// Read-only view of a single CLC participant record from the shared CLC table
// (clp_clc_participants), with quick links to Edit and Delete.

require_once __DIR__ . '/includes/auth.php';

define('CLP_CLC_TABLE', 'clp_clc_participants');

$page_title = 'CLC Participant Details';

$db = clp_db_connect();

$id = (int)($_GET['id'] ?? 0);
$record = null;
if ($id) {
    $stmt = $db->prepare("SELECT * FROM " . CLP_CLC_TABLE . " WHERE id = ? AND program = 'clc' LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $record = clp_stmt_fetch_assoc($stmt);
    $stmt->close();
}

$db->close();

if (!$record) {
    clp_set_error('Participant record not found.');
    clp_redirect(CLP_ADMIN_URL . '/clc.php');
}

$ts = (int)($record['timecreated'] ?? 0);
$enrolYear = $ts > 0 ? date('Y', $ts) : '—';
$enrolMonth = ((int)($record['month'] ?? 0) >= 1 && (int)$record['month'] <= 12)
    ? date('F', mktime(0, 0, 0, (int)$record['month'], 1))
    : '—';

$fields = [
    'School Name'   => $record['school'],
    'Student Name'  => $record['name'],
    "Father's Name" => $record['father_name'],
    "Mother's Name" => $record['mother_name'],
    'Gender'        => $record['gender'],
    'District'      => $record['district'],
    'Division'      => $record['division'],
    'Upazila'       => $record['upazila'],
    'Mobile'        => $record['mobile'],
    'Email'         => $record['email'],
    'Enrolment Month' => $enrolMonth,
    'Enrolment Year'  => $enrolYear,
];

include __DIR__ . '/includes/header.php';
?>

<div class="content-area">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-id-card"></i> Participant Details</h3>
            <div>
                <a href="<?php echo CLP_ADMIN_URL; ?>/clc_form.php?id=<?php echo (int)$record['id']; ?>" class="btn btn-sm btn-success"><i class="fas fa-edit"></i> Edit</a>
                <a href="<?php echo CLP_ADMIN_URL; ?>/clc.php?action=delete&id=<?php echo (int)$record['id']; ?>" class="btn btn-sm btn-danger confirm-delete"><i class="fas fa-trash"></i> Delete</a>
                <a href="<?php echo CLP_ADMIN_URL; ?>/clc.php" class="btn btn-sm btn-primary"><i class="fas fa-arrow-left"></i> Back to List</a>
            </div>
        </div>

        <div class="clc-detail">
            <div class="clc-detail-head">
                <div class="clc-detail-avatar"><i class="fas fa-user-graduate"></i></div>
                <div>
                    <h2 class="clc-detail-name"><?php echo clp_escape($record['name']); ?></h2>
                    <p class="clc-detail-school"><i class="fas fa-school"></i> <?php echo clp_escape($record['school']); ?></p>
                </div>
            </div>

            <div class="clc-detail-grid">
                <?php foreach ($fields as $label => $value): ?>
                    <div class="clc-detail-item">
                        <span class="clc-detail-label"><?php echo clp_escape($label); ?></span>
                        <span class="clc-detail-value"><?php echo $value !== '' && $value !== null ? clp_escape($value) : '<em style="color:#aaa;">—</em>'; ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<style>
.clc-detail { padding: 24px; }
.clc-detail-head { display: flex; align-items: center; gap: 18px; padding-bottom: 22px; margin-bottom: 22px; border-bottom: 1px solid #eef0f4; }
.clc-detail-avatar { width: 66px; height: 66px; border-radius: 50%; background: linear-gradient(135deg, #006b4f, #12b88c); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 28px; flex-shrink: 0; }
.clc-detail-name { margin: 0; font-size: 22px; color: #1d2125; }
.clc-detail-school { margin: 4px 0 0; color: #6a737b; font-size: 14px; }
.clc-detail-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px; }
.clc-detail-item { display: flex; flex-direction: column; gap: 4px; padding: 14px 16px; background: #f8f9fb; border: 1px solid #eef0f4; border-radius: 10px; }
.clc-detail-label { font-size: 11px; text-transform: uppercase; letter-spacing: .5px; font-weight: 700; color: #006b4f; }
.clc-detail-value { font-size: 15px; color: #3e4e4a; word-break: break-word; }
</style>

<?php include __DIR__ . '/includes/footer.php'; ?>
