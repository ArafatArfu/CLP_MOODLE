<?php
// CLP Admin Panel - Sponsored Centers Records Management (List).
//
// Lists the centre records stored in the shared centres table
// (mdl_local_centermanagement_centers) which powers the public
// "Your Sponsored Center(s)" page at /school-info.php. Provides search,
// filtering (district / type / status), sorting, pagination, enable/disable
// and delete. Add / Edit / View are handled by centers_form.php and
// centers_view.php. Uses the same Moodle database as the public site, so no
// manual database changes are ever required.

require_once __DIR__ . '/includes/auth.php';

// The centres table is owned by the Moodle local_centermanagement plugin and
// uses the Moodle table prefix, so it is referenced with the mdl_ prefix here.
define('CLP_CENTERS_TABLE', 'mdl_local_centermanagement_centers');

$page_title = 'Sponsored Centers';

$db = clp_db_connect();

// --- Handle enable/disable (status toggle) and delete actions. ---
if (isset($_GET['action'])) {
    $id = (int)($_GET['id'] ?? 0);

    if ($_GET['action'] === 'toggle' && $id > 0) {
        $stmt = $db->prepare("UPDATE " . CLP_CENTERS_TABLE . " SET status = 1 - status, timemodified = ? WHERE id = ?");
        $now = time();
        $stmt->bind_param("ii", $now, $id);
        if ($stmt->execute()) {
            clp_set_success('Center status updated successfully.');
        } else {
            clp_set_error('Failed to update center status.');
        }
        $stmt->close();
        clp_redirect(CLP_ADMIN_URL . '/centers.php');
    }

    if ($_GET['action'] === 'delete' && $id > 0) {
        $stmt = $db->prepare("DELETE FROM " . CLP_CENTERS_TABLE . " WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            clp_set_success('Center record deleted successfully.');
        } else {
            clp_set_error('Failed to delete center record.');
        }
        $stmt->close();
        clp_redirect(CLP_ADMIN_URL . '/centers.php');
    }
}

// --- Read filters / search / sort / pagination from the request. ---
$q       = clp_sanitize($_GET['q'] ?? '');
$district = clp_sanitize($_GET['district'] ?? '');
$type    = clp_sanitize($_GET['type'] ?? '');
$status  = clp_sanitize($_GET['status'] ?? '');

$sortable = ['center_name', 'district', 'center_type', 'start_date', 'status'];
$sort = in_array(($_GET['sort'] ?? ''), $sortable, true) ? $_GET['sort'] : 'start_date';
$dir  = strtoupper($_GET['dir'] ?? 'DESC') === 'DESC' ? 'DESC' : 'ASC';

$perpage = 20;
$page = max(1, (int)($_GET['page'] ?? 1));

// --- Build a parameterised WHERE clause. ---
$where = ["1=1"];
$params = [];
$types = '';

if ($q !== '') {
    $like = '%' . $q . '%';
    $fields = ['center_code', 'center_name', 'school_name', 'sponsor_name', 'district', 'division', 'upazila'];
    $ors = [];
    foreach ($fields as $f) {
        $ors[] = "$f LIKE ?";
        $params[] = $like;
        $types .= 's';
    }
    $where[] = '(' . implode(' OR ', $ors) . ')';
}

if ($district !== '') {
    $where[] = "district = ?";
    $params[] = $district;
    $types .= 's';
}
if ($type !== '') {
    $where[] = "center_type = ?";
    $params[] = $type;
    $types .= 's';
}
if ($status !== '') {
    $where[] = "status = ?";
    $params[] = (int)$status;
    $types .= 'i';
}

$whereSql = implode(' AND ', $where);

// --- Count total for pagination. ---
$countSql = "SELECT COUNT(*) AS c FROM " . CLP_CENTERS_TABLE . " WHERE $whereSql";
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
$allowedSort = [
    'center_name' => 'center_name',
    'district'     => 'district',
    'center_type'  => 'center_type',
    'start_date'   => 'start_date',
    'status'       => 'status',
];
$sortCol = $allowedSort[$sort];
$listSql = "SELECT * FROM " . CLP_CENTERS_TABLE . " WHERE $whereSql ORDER BY $sortCol $dir, id DESC LIMIT ? OFFSET ?";
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
    while ($row = clp_stmt_fetch_assoc($stmt)) {
        $records[] = $row;
    }
}
$stmt->close();

// --- Distinct values for filter dropdowns. ---
function clp_centers_distinct($db, $field) {
    $out = [];
    $sql = "SELECT DISTINCT $field FROM " . CLP_CENTERS_TABLE . " WHERE $field <> '' ORDER BY $field ASC";
    if ($res = $db->query($sql)) {
        while ($r = $res->fetch_assoc()) {
            $out[] = $r[$field];
        }
    }
    return $out;
}
$districts = clp_centers_distinct($db, 'district');

$db->close();

// Helper to build a URL preserving current filters, overriding some params.
function clp_centers_url($overrides = []) {
    $base = [
        'q' => $_GET['q'] ?? '',
        'district' => $_GET['district'] ?? '',
        'type' => $_GET['type'] ?? '',
        'status' => $_GET['status'] ?? '',
        'sort' => $_GET['sort'] ?? 'start_date',
        'dir' => $_GET['dir'] ?? 'DESC',
        'page' => $_GET['page'] ?? 1,
    ];
    $params = array_merge($base, $overrides);
    $params = array_filter($params, function ($v) {
        return $v !== '' && $v !== null;
    });
    return CLP_ADMIN_URL . '/centers.php?' . http_build_query($params);
}

// Header link for a sortable column.
function clp_centers_sort_link($label, $col, $currentSort, $currentDir) {
    $newDir = ($currentSort === $col && $currentDir === 'ASC') ? 'DESC' : 'ASC';
    $arrow = '';
    if ($currentSort === $col) {
        $arrow = $currentDir === 'ASC' ? ' <i class="fas fa-sort-up"></i>' : ' <i class="fas fa-sort-down"></i>';
    } else {
        $arrow = ' <i class="fas fa-sort" style="opacity:.35"></i>';
    }
    $url = clp_centers_url(['sort' => $col, 'dir' => $newDir, 'page' => 1]);
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
            <h3 class="card-title"><i class="fas fa-building"></i> Sponsored Centers</h3>
            <div class="clc-header-actions">
                <a href="<?php echo CLP_ADMIN_URL; ?>/centers_form.php" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Center</a>
            </div>
        </div>

        <!-- Filters / Search -->
        <form method="get" action="<?php echo CLP_ADMIN_URL; ?>/centers.php" class="clc-filter-bar">
            <div class="clc-filter-search">
                <i class="fas fa-search"></i>
                <input type="text" name="q" value="<?php echo clp_escape($q); ?>" placeholder="Search code, name, school, sponsor, district…">
            </div>
            <div class="clc-filter-grid">
                <select name="district" onchange="this.form.submit()">
                    <option value="">All Districts</option>
                    <?php foreach ($districts as $d): ?>
                        <option value="<?php echo clp_escape($d); ?>" <?php echo $district === $d ? 'selected' : ''; ?>><?php echo clp_escape($d); ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="type" onchange="this.form.submit()">
                    <option value="">All Types</option>
                    <option value="clc" <?php echo $type === 'clc' ? 'selected' : ''; ?>>CLC</option>
                    <option value="scr" <?php echo $type === 'scr' ? 'selected' : ''; ?>>SCR</option>
                </select>
                <select name="status" onchange="this.form.submit()">
                    <option value="">All Statuses</option>
                    <option value="1" <?php echo $status === '1' ? 'selected' : ''; ?>>Enabled</option>
                    <option value="0" <?php echo $status === '0' ? 'selected' : ''; ?>>Disabled</option>
                </select>
                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-filter"></i> Apply</button>
                <a href="<?php echo CLP_ADMIN_URL; ?>/centers.php" class="btn btn-secondary btn-sm"><i class="fas fa-times"></i> Reset</a>
            </div>
            <input type="hidden" name="sort" value="<?php echo clp_escape($sort); ?>">
            <input type="hidden" name="dir" value="<?php echo clp_escape($dir); ?>">
        </form>

        <div class="clc-result-meta">
            Showing <strong><?php echo $showingFrom; ?>&ndash;<?php echo $showingTo; ?></strong> of <strong><?php echo $total; ?></strong> center<?php echo $total === 1 ? '' : 's'; ?>
        </div>

        <div class="table-container">
            <table class="clc-table">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th><?php echo clp_centers_sort_link('Code', 'center_name', $sort, $dir); ?></th>
                        <th>Center Name</th>
                        <th>School</th>
                        <th><?php echo clp_centers_sort_link('Type', 'center_type', $sort, $dir); ?></th>
                        <th><?php echo clp_centers_sort_link('District', 'district', $sort, $dir); ?></th>
                        <th>Sponsor</th>
                        <th>Support</th>
                        <th><?php echo clp_centers_sort_link('Status', 'status', $sort, $dir); ?></th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($records)): ?>
                        <tr><td colspan="10" style="text-align:center;color:#999;">No center records match your search or filters.</td></tr>
                    <?php else: ?>
                        <?php $sl = $offset + 1; foreach ($records as $r): ?>
                            <?php
                            $ctype = strtolower($r['center_type'] ?? 'clc');
                            $typeLabel = $ctype === 'scr' ? 'Smart Classroom (SCR)' : 'Computer Literacy Center (CLC)';
                            $typeClass = $ctype === 'scr' ? 'badge badge-info' : 'badge badge-secondary';
                            $isActive = !empty($r['status']);
                            $statusClass = $isActive ? 'badge badge-success' : 'badge badge-secondary';
                            $statusLabel = $isActive ? 'Enabled' : 'Disabled';
                            $startDate = !empty($r['start_date']) ? date('M Y', (int)$r['start_date']) : '—';
                            ?>
                            <tr>
                                <td><?php echo $sl++; ?></td>
                                <td><strong><?php echo clp_escape($r['center_code']); ?></strong></td>
                                <td><?php echo clp_escape($r['center_name']); ?></td>
                                <td><?php echo clp_escape($r['school_name']); ?></td>
                                <td><span class="<?php echo $typeClass; ?>"><?php echo $typeLabel; ?></span></td>
                                <td><?php echo clp_escape($r['district']); ?></td>
                                <td><?php echo clp_escape($r['sponsor_name']); ?></td>
                                <td><?php echo clp_escape($r['support']); ?></td>
                                <td><span class="<?php echo $statusClass; ?>"><?php echo $statusLabel; ?></span></td>
                                <td class="clc-actions">
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/centers_view.php?id=<?php echo (int)$r['id']; ?>" class="btn btn-sm btn-secondary" title="View"><i class="fas fa-eye"></i></a>
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/centers_form.php?id=<?php echo (int)$r['id']; ?>" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/centers.php?action=toggle&id=<?php echo (int)$r['id']; ?>" class="btn btn-sm btn-warning" title="<?php echo $isActive ? 'Disable' : 'Enable'; ?>"><i class="fas fa-<?php echo $isActive ? 'eye-slash' : 'eye'; ?>"></i></a>
                                    <a href="<?php echo CLP_ADMIN_URL; ?>/centers.php?action=delete&id=<?php echo (int)$r['id']; ?>" class="btn btn-sm btn-danger confirm-delete" title="Delete"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if ($totalpages > 1): ?>
            <div class="clc-pagination">
                <a href="<?php echo clp_escape(clp_centers_url(['page' => max(1, $page - 1)])); ?>" class="clc-page-btn <?php echo $page <= 1 ? 'disabled' : ''; ?>">&lsaquo; Prev</a>
                <?php
                $window = 2;
                for ($p = 1; $p <= $totalpages; $p++) {
                    if ($p === 1 || $p === $totalpages || ($p >= $page - $window && $p <= $page + $window)) {
                        $active = $p === $page ? 'active' : '';
                        echo '<a href="' . clp_escape(clp_centers_url(['page' => $p])) . '" class="clc-page-btn ' . $active . '">' . $p . '</a>';
                    } else if ($p === $page - $window - 1 || $p === $page + $window + 1) {
                        echo '<span class="clc-page-ellipsis">&hellip;</span>';
                    }
                }
                ?>
                <a href="<?php echo clp_escape(clp_centers_url(['page' => min($totalpages, $page + 1)])); ?>" class="clc-page-btn <?php echo $page >= $totalpages ? 'disabled' : ''; ?>">Next &rsaquo;</a>
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

/* Frontend-matched table heading design (teal scheme) */
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
.clc-table thead th:first-child { text-align: center; border-top-left-radius: 8px; }
.clc-table thead th:last-child { border-top-right-radius: 8px; }
.clc-table tbody tr:nth-child(even) td { background: #fafbfc; }
.clc-table tbody tr:hover td { background: #e6f5f0; }
.clc-table tbody td:first-child { text-align: center; font-weight: 700; color: #006b4f; }
.clc-table tbody td { vertical-align: middle; }
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
