<?php
// CLP Admin Panel - CLC Excel Upload (bulk import).
//
// Migrated from the SkillConnect dashboard (local/skillconnect/upload.php +
// upload.mustache). Provides:
//   - Download an .xlsx template with the expected columns.
//   - Upload an .xlsx / .csv file of participant records.
//   - Validate rows, import valid ones, and show a summary
//     (imported / invalid / duplicate) plus the uploaded records.
//
// Records are written to the shared CLC table (mdl_clp_clc_participants), so
// imports appear immediately on the public CLC page and in the CLC list.

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/excel_lib.php';

$page_title = 'CLC – Excel Upload';

// Map a PHP upload error code to a friendly message.
function clp_clc_upload_error_message($code) {
    switch ($code) {
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            return 'The uploaded file is too large.';
        case UPLOAD_ERR_PARTIAL:
            return 'The file was only partially uploaded. Please try again.';
        case UPLOAD_ERR_NO_FILE:
            return 'Please choose a file to upload.';
        case UPLOAD_ERR_NO_TMP_DIR:
        case UPLOAD_ERR_CANT_WRITE:
            return 'Server error while handling the upload. Please contact the administrator.';
        default:
            return 'The file could not be uploaded. Please try again.';
    }
}

// --- Template download (must happen before any HTML output). ---
if (isset($_GET['mode']) && $_GET['mode'] === 'template') {
    Clp_Clc_Excel::download_template();
    exit;
}

$importresult = null;
$validrecords = [];
$invalidrecords = [];
$uploadError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!clp_verify_csrf($_POST['csrf_token'] ?? '')) {
        $uploadError = 'Invalid security token. Please try again.';
    } else if (!isset($_FILES['excelfile']) || $_FILES['excelfile']['error'] !== UPLOAD_ERR_OK) {
        $uploadError = clp_clc_upload_error_message($_FILES['excelfile']['error'] ?? UPLOAD_ERR_NO_FILE);
    } else {
        $original = $_FILES['excelfile']['name'];
        $ext = strtolower(pathinfo($original, PATHINFO_EXTENSION));
        if (!in_array($ext, ['xlsx', 'xls', 'csv', 'txt'], true)) {
            $uploadError = 'Unsupported file type. Please upload an .xlsx or .csv file.';
        } else {
            $preview = Clp_Clc_Excel::preview($_FILES['excelfile']['tmp_name'], $original);
            $validrecords = $preview['valid'];
            $invalidrecords = $preview['invalid'];

            if ($preview['total'] === 0) {
                $uploadError = 'No data rows were found in the uploaded file. Make sure the first row is the header and data starts on row 2.';
            } else {
                $importresult = Clp_Clc_Excel::import($validrecords);
                // "failed" from validation-invalid rows are reflected as invalid count.
                $importresult['failed'] = ($importresult['failed'] ?? 0) + count($invalidrecords);
                clp_set_success('Import complete: ' . (int)$importresult['inserted'] . ' imported, '
                    . (int)$importresult['failed'] . ' invalid, ' . (int)$importresult['skipped'] . ' duplicate.');
            }
        }
    }
    if ($uploadError !== '') {
        clp_set_error($uploadError);
    }
}

$columns = Clp_Clc_Excel::columns();
$hasresult = !empty($importresult);
$templateUrl = CLP_ADMIN_URL . '/clc_upload.php?mode=template';

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
            <h3 class="card-title"><i class="fas fa-file-excel"></i> CLC – Excel Upload</h3>
            <a href="<?php echo CLP_ADMIN_URL; ?>/clc.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to List</a>
        </div>

        <div class="clc-upload">
            <p class="clc-upload-desc">
                Bulk import Computer Literacy Center participant records from an Excel/CSV file.
                Download the template, fill in your records (one per row), then upload the file below.
            </p>

            <?php if ($hasresult): ?>
                <!-- Import summary -->
                <div class="clc-upload-section">Import Summary</div>
                <div class="clc-summary-grid">
                    <div class="clc-summary-box success">
                        <span class="clc-summary-num"><?php echo (int)$importresult['inserted']; ?></span>
                        <span class="clc-summary-label">Imported</span>
                    </div>
                    <div class="clc-summary-box danger">
                        <span class="clc-summary-num"><?php echo (int)$importresult['failed']; ?></span>
                        <span class="clc-summary-label">Invalid</span>
                    </div>
                    <div class="clc-summary-box warning">
                        <span class="clc-summary-num"><?php echo (int)$importresult['skipped']; ?></span>
                        <span class="clc-summary-label">Duplicate (skipped)</span>
                    </div>
                </div>

                <?php if (!empty($validrecords)): ?>
                    <div class="clc-upload-section">Imported / Processed Records</div>
                    <div class="table-container" style="overflow-x:auto;">
                        <table class="clc-table">
                            <thead>
                                <tr>
                                    <th>Row</th>
                                    <?php foreach ($columns as $label): ?>
                                        <th><?php echo clp_escape($label); ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($validrecords as $r): ?>
                                    <tr>
                                        <td><?php echo (int)($r['row'] ?? 0); ?></td>
                                        <?php foreach (array_keys($columns) as $key): ?>
                                            <td><?php echo clp_escape($r[$key] ?? ''); ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>

                <?php if (!empty($invalidrecords)): ?>
                    <div class="clc-upload-section danger-text">Invalid Rows (not imported)</div>
                    <div class="table-container" style="overflow-x:auto;">
                        <table class="clc-table">
                            <thead>
                                <tr>
                                    <th>Row</th>
                                    <th>School</th>
                                    <th>Student Name</th>
                                    <th>Problem(s)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($invalidrecords as $r): ?>
                                    <tr>
                                        <td><?php echo (int)($r['row'] ?? 0); ?></td>
                                        <td><?php echo clp_escape($r['school'] ?? ''); ?></td>
                                        <td><?php echo clp_escape($r['name'] ?? ''); ?></td>
                                        <td class="danger-text"><?php echo clp_escape(implode(' ', $r['errors'] ?? [])); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>

                <div class="clc-upload-actions">
                    <a href="<?php echo clp_escape($templateUrl); ?>" class="btn btn-secondary"><i class="fas fa-download"></i> Download Template</a>
                    <a href="<?php echo CLP_ADMIN_URL; ?>/clc_upload.php" class="btn btn-primary"><i class="fas fa-upload"></i> Upload Another File</a>
                    <a href="<?php echo CLP_ADMIN_URL; ?>/clc.php" class="btn btn-success"><i class="fas fa-list"></i> View All Participants</a>
                </div>

            <?php else: ?>
                <!-- Upload form -->
                <div class="clc-upload-actions" style="margin-bottom:22px;">
                    <a href="<?php echo clp_escape($templateUrl); ?>" class="btn btn-secondary"><i class="fas fa-download"></i> Download Template</a>
                </div>

                <div class="clc-upload-cols">
                    <strong>Expected columns (in order):</strong>
                    <?php echo clp_escape(implode(' · ', array_values($columns))); ?>
                </div>

                <form method="POST" action="" enctype="multipart/form-data" class="clc-upload-form">
                    <input type="hidden" name="csrf_token" value="<?php echo clp_csrf_token(); ?>">
                    <div class="form-group">
                        <label class="form-label">Select Excel / CSV file *</label>
                        <input type="file" name="excelfile" id="excelfile" class="form-control" accept=".xlsx,.xls,.csv" required>
                        <small style="color:#6a737b;">Accepted formats: .xlsx, .csv. The first row must be the header; data starts on row 2.</small>
                    </div>
                    <button type="submit" class="btn btn-success"><i class="fas fa-upload"></i> Upload &amp; Import</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
.clc-upload { padding: 22px; }
.clc-upload-desc { color: #4a5560; font-size: 14px; margin: 0 0 20px; line-height: 1.6; }
/* Frontend-matched table heading design (teal scheme from local/clp/program.css) */
.clc-table { border-collapse: collapse; }
.clc-table thead th {
    background: linear-gradient(135deg, #006b4f 0%, #12b88c 100%);
    color: #fff;
    font-family: 'Roboto Slab', 'Segoe UI', serif;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 12px;
    letter-spacing: .5px;
    text-align: left;
    padding: 14px 16px;
    white-space: nowrap;
    border-bottom: 3px solid #01543f;
}
.clc-table thead th:first-child { border-top-left-radius: 8px; }
.clc-table thead th:last-child { border-top-right-radius: 8px; }
.clc-table tbody tr:nth-child(even) td { background: #fafbfc; }
.clc-table tbody tr:hover td { background: #e6f5f0; }
.clc-upload-section { font-size: 14px; font-weight: 700; color: #006b4f; text-transform: uppercase; letter-spacing: .4px; margin: 22px 0 12px; padding-bottom: 6px; border-bottom: 2px solid #eef0f4; }
.clc-upload-section.danger-text { color: #b82b00; }
.danger-text { color: #b82b00; }
.clc-summary-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 14px; margin-bottom: 10px; }
.clc-summary-box { padding: 18px; border-radius: 12px; text-align: center; border: 1px solid #eef0f4; }
.clc-summary-box.success { background: #e9f7f1; border-color: #bfe6d7; }
.clc-summary-box.danger { background: #fdeeea; border-color: #f4ccc0; }
.clc-summary-box.warning { background: #fff6e6; border-color: #f5e0b3; }
.clc-summary-num { display: block; font-size: 30px; font-weight: 700; color: #1d2125; }
.clc-summary-label { display: block; margin-top: 4px; font-size: 12px; text-transform: uppercase; letter-spacing: .5px; color: #6a737b; }
.clc-upload-cols { background: #f8f9fb; border: 1px solid #eef0f4; border-radius: 10px; padding: 12px 16px; font-size: 13px; color: #4a5560; margin-bottom: 20px; }
.clc-upload-form { max-width: 560px; }
.clc-upload-actions { display: flex; flex-wrap: wrap; gap: 10px; }
.btn-secondary { background: #eef0f4; color: #3e4e4a; }
.btn-secondary:hover { background: #e2e6ec; }
</style>

<?php include __DIR__ . '/includes/footer.php'; ?>
