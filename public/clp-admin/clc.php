<?php
// CLP Admin Panel - CLC Computer Literacy Center Records Management (List).
//
// Lists participant records stored in the CLC database table
// (clp_clc_participants) which is shared with the public CLC page at
// /local/clp/program.php?program=clc. Provides search, filtering, sorting,
// pagination and delete. Add / Edit / View are handled by clc_form.php and
// clc_view.php.

require_once __DIR__ . '/includes/auth.php';

define('CLP_CLC_TABLE', 'clp_clc_participants');

$page_title = 'CLC – Computer Literacy Center';

$db = clp_db_connect();

// --- Handle delete action. ---
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $db->prepare("DELETE FROM " . CLP_CLC_TABLE . " WHERE id = ? AND program = 'clc'");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        clp_set_success('Participant record deleted successfully.');
    } else {
        clp_set_error('Failed to delete participant record.');
    }
    $stmt->close();
    clp_redirect(CLP_ADMIN_URL . '/clc.php');
}

// --- Read filters / search / sort / pagination from the request. ---
$q        = clp_sanitize($_GET['q'] ?? '');
$division = clp_sanitize($_GET['division'] ?? '');
$district = clp_sanitize($_GET['district'] ?? '');
$upazila  = clp_sanitize($_GET['upazila'] ?? '');
$school   = clp_sanitize($_GET['school'] ?? '');
$gender   = clp_sanitize($_GET['gender'] ?? '');
$year     = clp_sanitize($_GET['year'] ?? '');

$sortable = ['name', 'school', 'district', 'division', 'upazila', 'gender', 'mobile', 'email', 'timecreated'];
$sort = in_array(($_GET['sort'] ?? ''), $sortable, true) ? $_GET['sort'] : 'name';
$dir  = strtoupper($_GET['dir'] ?? 'ASC') === 'DESC' ? 'DESC' : 'ASC';

$perpage = 20;
$page = max(1, (int)($_GET['page'] ?? 1));

// --- Build a parameterised WHERE clause. ---
$where = ["program = 'clc'"];
$params = [];
$types = '';

if ($q !== '') {
    $like = '%' . $q . '%';
    $fields = ['name', 'father_name', 'mother_name', 'district', 'division', 'upazila', 'mobile', 'email', 'gender', 'school'];
    $ors = [];
    foreach ($fields as $f) {
        $ors[] = "$f LIKE ?";
        $params[] = $like;
        $types .= 's';
    }
    $where[] = '(' . implode(' OR ', $ors) . ')';
}

foreach (['division' => $division, 'district' => $district, 'upazila' => $upazila, 'school' => $school, 'gender' => $gender] as $col => $val) {
    if ($val !== '') {
        $where[] = "$col = ?";
        $params[] = $val;
        $types .= 's';
    }
}

if ($year !== '' && ctype_digit((string)$year)) {
    $ystart = mktime(0, 0, 0, 1, 1, (int)$year);
    $yend   = mktime(0, 0, 0, 1, 1, (int)$year + 1);
    $where[] = "timecreated >= ? AND timecreated < ?";
    $params[] = $ystart;
    $params[] = $yend;
    $types .= 'ii';
}

$whereSql = implode(' AND ', $where);

// --- Count total for pagination. ---
$countSql = "SELECT COUNT(*) AS c FROM " . CLP_CLC_TABLE . " WHERE $whereSql";
if ($params) {
    $stmt = $db->prepare($countSql);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $total = (int)(clp_stmt_fetch_assoc($stmt)['c'] ?? 0);
    $stmt->close();
} else {
    $total = (int)$db->query($countSql)->fetch_assoc()['c'];
}

$totalpages = max(1, (int)ceil($total / $perpage));
if ($page > $totalpages) {
    $page = $totalpages;
}
$offset = ($page - 1) * $perpage;

// --- Fetch the page of records. ---
$listSql = "SELECT * FROM " . CLP_CLC_TABLE . " WHERE $whereSql ORDER BY $sort $dir, id DESC LIMIT ? OFFSET ?";
$listTypes = $types . 'ii';
$listParams = array_merge($params, [$perpage, $offset]);

$stmt = $db->prepare($listSql);
$stmt->bind_param($listTypes, ...$listParams);
$stmt->execute();

$records = [];
$result = $stmt->get_result();
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $records[] = $row;
    }
} else {
    // Fallback for servers without mysqlnd get_result().
    while ($row = clp_stmt_fetch_assoc($stmt)) {
        $records[] = $row;
    }
}
$stmt->close();

// --- Distinct values for filter dropdowns. ---
function clp_clc_distinct($db, $field) {
    $out = [];
    $sql = "SELECT DISTINCT $field FROM " . CLP_CLC_TABLE . " WHERE program = 'clc' AND $field <> '' ORDER BY $field ASC";
    if ($res = $db->query($sql)) {
        while ($r = $res->fetch_assoc()) {
            $out[] = $r[$field];
        }
    }
    return $out;
}
$divisions = clp_clc_distinct($db, 'division');
$districts = clp_clc_distinct($db, 'district');
$upazilas = clp_clc_distinct($db, 'upazila');
$schools = clp_clc_distinct($db, 'school');

$years = [];
if ($res = $db->query("SELECT DISTINCT FROM_UNIXTIME(timecreated, '%Y') AS yr FROM " . CLP_CLC_TABLE . " WHERE program = 'clc' AND timecreated > 0 ORDER BY yr DESC")) {
    while ($r = $res->fetch_assoc()) {
        if (!empty($r['yr'])) {
            $years[] = $r['yr'];
        }
    }
}

$db->close();

// Helper to build a URL preserving current filters, overriding some params.
function clp_clc_url($overrides = []) {
    $base = [
        'q' => $_GET['q'] ?? '',
        'division' => $_GET['division'] ?? '',
        'district' => $_GET['district'] ?? '',
        'upazila' => $_GET['upazila'] ?? '',
        'school' => $_GET['school'] ?? '',
        'gender' => $_GET['gender'] ?? '',
        'year' => $_GET['year'] ?? '',
        'sort' => $_GET['sort'] ?? 'name',
        'dir' => $_GET['dir'] ?? 'ASC',
        'page' => $_GET['page'] ?? 1,
    ];
    $params = array_merge($base, $overrides);
    $params = array_filter($params, function ($v) {
        return $v !== '' && $v !== null;
    });
    return CLP_ADMIN_URL . '/clc.php?' . http_build_query($params);
}

// Header link for a sortable column.
function clp_clc_sort_link($label, $col, $currentSort, $currentDir) {
    $newDir = ($currentSort === $col && $currentDir === 'ASC') ? 'DESC' : 'ASC';
    $arrow = '';
    if ($currentSort === $col) {
        $arrow = $currentDir === 'ASC' ? ' <i class="fas fa-sort-up"></i>' : ' <i class="fas fa-sort-down"></i>';
    } else {
        $arrow = ' <i class="fas fa-sort" style="opacity:.35"></i>';
    }
    $url = clp_clc_url(['sort' => $col, 'dir' => $newDir, 'page' => 1]);
    return '<a href="' . clp_escape($url) . '" class="clc-sort-link">' . clp_escape($label) . $arrow . '</a>';
}

$showingFrom = $total === 0 ? 0 : $offset + 1;
$showingTo = min($offset + $perpage, $total);

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
            <h3 class="card-title"><i class="fas fa-laptop-code"></i> CLC – Computer Literacy Center</h3>
            <div class="clc-header-actions">
                <a href="<?php echo CLP_ADMIN_URL; ?>/clc_upload.php" class="btn btn-success"><i class="fas fa-file-excel"></i> Excel Upload</a>
                <a href="<?php echo CLP_ADMIN_URL; ?>/clc_form.php" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Participant</a>
            </div>
        </div>

        <!-- Filters / Search -->
        <form method="get" action="<?php echo CLP_ADMIN_URL; ?>/clc.php" class="clc-filter-bar">
            <div class="clc-filter-search">
                <i class="fas fa-search"></i>
                <input type="text" name="q" value="<?php echo clp_escape($q); ?>" placeholder="Search name, school, district, mobile, email…">
            </div>
            <div class="clc-filter-grid">
                <select name="division" onchange="this.form.submit()">
                    <option value="">All Divisions</option>
                    <?php foreach ($divisions as $d): ?>
                        <option value="<?php echo clp_escape($d); ?>" <?php echo $division === $d ? 'selected' : ''; ?>><?php echo clp_escape($d); ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="district" onchange="this.form.submit()">
                    <option value="">All Districts</option>
                    <?php foreach ($districts as $d): ?>
                        <option value="<?php echo clp_escape($d); ?>" <?php echo $district === $d ? 'selected' : ''; ?>><?php echo clp_escape($d); ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="upazila" onchange="this.form.submit()">
                    <option value="">All Upazilas</option>
                    <?php foreach ($upazilas as $u): ?>
                        <option value="<?php echo clp_escape($u); ?>" <?php echo $upazila === $u ? 'selected' : ''; ?>><?php echo clp_escape($u); ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="school" onchange="this.form.submit()">
                    <option value="">All Schools</option>
                    <?php foreach ($schools as $s): ?>
                        <option value="<?php echo clp_escape($s); ?>" <?php echo $school === $s ? 'selected' : ''; ?>><?php echo clp_escape($s); ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="gender" onchange="this.form.submit()">
                    <option value="">All Genders</option>
                    <?php foreach (['Male', 'Female', 'Other'] as $g): ?>
                        <option value="<?php echo $g; ?>" <?php echo $gender === $g ? 'selected' : ''; ?>><?php echo $g; ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="year" onchange="this.form.submit()">
                    <option value="">All Years</option>
                    <?php foreach ($years as $y): ?>
                        <option value="<?php echo clp_escape($y); ?>" <?php echo (string)$year === (string)$y ? 'selected' : ''; ?>><?php echo clp_escape($y); ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-filter"></i> Apply</button>
                <a href="<?php echo CLP_ADMIN_URL; ?>/clc.php" class="btn btn-secondary btn-sm"><i class="fas fa-times"></i> Reset</a>
            </div>
            <input type="hidden" name="sort" value="<?php echo clp_escape($sort); ?>">
            <input type="hidden" name="dir" value="<?php echo clp_escape($dir); ?>">
        </form>

        <div class="clc-result-meta">
            Showing <strong><?php echo $showingFrom; ?>&ndash;<?php echo $showingTo; ?></strong> of <strong><?php echo $total; ?></strong> participant<?php echo $total === 1 ? '' : 's'; ?>
        </div>

        <div class="table-container">
            <table class="clc-table">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th><?php echo clp_clc_sort_link('School Name', 'school', $sort, $dir); ?></th>
                        <th><?php echo clp_clc_sort_link('Student Name', 'name', $sort, $dir); ?></th>
                        <th>Father's Name</th>
                        <th>Mother's Name</th>
                        <th><?php echo clp_clc_sort_link('District', 'district', $sort, $dir); ?></th>
                        <th><?php echo clp_clc_sort_link('Division', 'division', $sort, $dir); ?></th>
                        <th>Upazila</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th><?php echo clp_clc_sort_link('Gender', 'gender', $sort, $dir); ?></th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($records)): ?>
                        <tr><td colspan="12" style="text-align:center;color:#999;">No participant records match your search or filters.</td></tr>
                    <?php else: ?>
                        <?php $sl = $offset + 1; foreach ($records as $r): ?>
                            <tr>
                                <td><?php echo $sl++; ?></td>
                                <td><strong><?php echo clp_escape($r['school']); ?></strong></td>
                                <td><?php echo clp_escape($r['name']); ?></td>
                                <td><?php echo clp_escape($r['father_name']); ?></td>
                                <td><?php echo clp_escape($r['mother_name']); ?></td>
                                <td><?php echo clp_escape($r['district']); ?></td>
                                <td><?php echo clp_escape($r['division']); ?></td>
                                <td><?php echo clp_escape($r['upazila']); ?></td>
                                <td><?php echo clp_escape($r['mobile']); ?></td>
                                <td><?php echo clp_escape($r['email']); ?></td>
                                <td><?php echo clp_escape($r['gender']); ?></td>
                                <td class="clc-actions">
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/clc_view.php?id=<?php echo (int)$r['id']; ?>" class="btn btn-sm btn-secondary" title="View"><i class="fas fa-eye"></i></a>
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/clc_form.php?id=<?php echo (int)$r['id']; ?>" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/clc.php?action=delete&id=<?php echo (int)$r['id']; ?>" class="btn btn-sm btn-danger confirm-delete" title="Delete"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if ($totalpages > 1): ?>
            <div class="clc-pagination">
                <a href="<?php echo clp_escape(clp_clc_url(['page' => max(1, $page - 1)])); ?>" class="clc-page-btn <?php echo $page <= 1 ? 'disabled' : ''; ?>">&lsaquo; Prev</a>
                <?php
                $window = 2;
                for ($p = 1; $p <= $totalpages; $p++) {
                    if ($p === 1 || $p === $totalpages || ($p >= $page - $window && $p <= $page + $window)) {
                        $active = $p === $page ? 'active' : '';
                        echo '<a href="' . clp_escape(clp_clc_url(['page' => $p])) . '" class="clc-page-btn ' . $active . '">' . $p . '</a>';
                    } else if ($p === $page - $window - 1 || $p === $page + $window + 1) {
                        echo '<span class="clc-page-ellipsis">&hellip;</span>';
                    }
                }
                ?>
                <a href="<?php echo clp_escape(clp_clc_url(['page' => min($totalpages, $page + 1)])); ?>" class="clc-page-btn <?php echo $page >= $totalpages ? 'disabled' : ''; ?>">Next &rsaquo;</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
.clc-filter-bar { padding: 16px 20px; border-bottom: 1px solid #eef0f4; }
.clc-filter-search { position: relative; margin-bottom: 12px; }
.clc-filter-search i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #9aa2ad; }
.clc-filter-search input { width: 100%; height: 42px; padding: 0 14px 0 40px; border: 1px solid #dfe3ea; border-radius: 8px; font-size: 14px; }
.clc-filter-search input:focus { outline: none; border-color: #006b4f; box-shadow: 0 0 0 3px rgba(0,107,79,.12); }
.clc-filter-grid { display: flex; flex-wrap: wrap; gap: 10px; align-items: center; }
.clc-filter-grid select { height: 40px; padding: 0 12px; border: 1px solid #dfe3ea; border-radius: 8px; font-size: 13px; background: #fff; min-width: 150px; }
.clc-filter-grid select:focus { outline: none; border-color: #006b4f; }
.clc-result-meta { padding: 12px 20px; font-size: 13px; color: #6a737b; }

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
    position: sticky;
    top: 0;
    z-index: 2;
}
.clc-table thead th:first-child {
    text-align: center;
    border-top-left-radius: 8px;
}
.clc-table thead th:last-child {
    border-top-right-radius: 8px;
}
.clc-table tbody tr:nth-child(even) td { background: #fafbfc; }
.clc-table tbody tr:hover td { background: #e6f5f0; }
.clc-table tbody td:first-child { text-align: center; font-weight: 700; color: #006b4f; }
.clc-sort-link { color: #fff; text-decoration: none; display: inline-flex; align-items: center; gap: 5px; transition: color .15s ease; }
.clc-sort-link:hover { color: #d7fff2; text-decoration: underline; }
.clc-actions { white-space: nowrap; }
.clc-actions .btn { padding: 5px 9px; }
.clc-pagination { display: flex; flex-wrap: wrap; gap: 6px; padding: 16px 20px; justify-content: flex-end; align-items: center; }
.clc-page-btn { min-width: 38px; height: 36px; padding: 0 12px; display: inline-flex; align-items: center; justify-content: center; border: 1px solid #dfe3ea; border-radius: 8px; background: #fff; color: #3e4e4a; font-size: 14px; text-decoration: none; }
.clc-page-btn:hover:not(.disabled):not(.active) { border-color: #006b4f; color: #006b4f; }
.clc-page-btn.active { background: #006b4f; border-color: #006b4f; color: #fff; }
.clc-page-btn.disabled { opacity: .45; pointer-events: none; }
.clc-page-ellipsis { align-self: center; color: #9aa2ad; padding: 0 2px; }
.btn-secondary { background: #eef0f4; color: #3e4e4a; }
.btn-secondary:hover { background: #e2e6ec; }
</style>

<?php include __DIR__ . '/includes/footer.php'; ?>
