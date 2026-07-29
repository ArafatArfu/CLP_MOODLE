<?php
// CLP Admin Panel - Sponsored Centers Records Management (List).
//
// Lists the centre records stored in the shared centres table
// (mdl_local_centermanagement_centers) which powers the public
// "Your Sponsored Center(s)" page at /school-info.php.
//
// The list UI (description/hero box, filter panel, data table and pagination)
// intentionally reuses the SAME component design as the public CLC program
// page (local/clp/program.php -> program.css) and the public school-info.php
// page, so the filtering system looks and behaves identically everywhere.
// Only the data differs. Filtering/search/sort/pagination run through AJAX
// (JSON) with no full page reload, mirroring program.php's `ajax=1` flow.
// Add / Edit / View live in centers_form.php and centers_view.php.

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
        $db->query("DELETE FROM mdl_local_centermanagement_sponsors WHERE center_id = " . (int)$id);
        $db->query("DELETE FROM mdl_local_centermanagement_banner_images WHERE center_id = " . (int)$id);
        $db->query("DELETE FROM mdl_local_centermanagement_plaque_gallery WHERE center_id = " . (int)$id);
        $db->query("DELETE FROM mdl_local_centermanagement_school_photo_gallery WHERE center_id = " . (int)$id);
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
$f = [
    'q'           => clp_sanitize($_GET['q'] ?? ''),
    'district'    => clp_sanitize($_GET['district'] ?? ''),
    'division'    => clp_sanitize($_GET['division'] ?? ''),
    'upazila'     => clp_sanitize($_GET['upazila'] ?? ''),
    'center_type' => clp_sanitize($_GET['center_type'] ?? ''),
    'support'     => clp_sanitize($_GET['support'] ?? ''),
    'status'      => clp_sanitize($_GET['status'] ?? ''),
    'sort'        => clp_sanitize($_GET['sort'] ?? 'start_date'),
    'dir'         => strtoupper($_GET['dir'] ?? 'DESC') === 'DESC' ? 'DESC' : 'ASC',
];
$page = max(1, (int)($_GET['page'] ?? 1));
$perpage = 20;

/**
 * Return distinct, sorted values for a column (used for filter dropdowns).
 */
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

/**
 * Render the centres admin data table (sc-data-table) with action buttons.
 */
function clp_centers_render_table(array $rows, int $startno): string {
    $head = '<th scope="col" class="sc-col-sl">Sl</th>'
        . '<th scope="col">Code</th>'
        . '<th scope="col">Center Name</th>'
        . '<th scope="col">School</th>'
        . '<th scope="col">Type</th>'
        . '<th scope="col">District</th>'
        . '<th scope="col">Sponsor</th>'
        . '<th scope="col">Support</th>'
        . '<th scope="col">Status</th>'
        . '<th scope="col">Actions</th>';

    if (empty($rows)) {
        $body = '<tr class="sc-empty-row"><td colspan="10">No center records match your search or filters.</td></tr>';
    } else {
        $body = '';
        $sl = $startno;
        foreach ($rows as $r) {
            $ctype = strtolower($r['center_type'] ?? 'clc');
            $typeLabel = $ctype === 'scr' ? 'Smart Classroom' : 'Computer Literacy Center';
            $typeClass = $ctype === 'scr' ? 'sc-badge sc-badge-info' : 'sc-badge sc-badge-secondary';
            $isActive = !empty($r['status']);
            $statusClass = $isActive ? 'sc-badge sc-badge-success' : 'sc-badge sc-badge-secondary';
            $statusLabel = $isActive ? 'Enabled' : 'Disabled';

            $body .= '<tr>'
                . '<td class="sc-col-sl">' . $sl . '</td>'
                . '<td><strong>' . clp_escape($r['center_code']) . '</strong></td>'
                . '<td>' . clp_escape($r['center_name']) . '</td>'
                . '<td><span class="' . $typeClass . '">' . $typeLabel . '</span></td>'
                . '<td>' . clp_escape($r['district']) . '</td>'
                . '<td>' . clp_escape($r['sponsor_name']) . '</td>'
                . '<td>' . clp_escape($r['support']) . '</td>'
                . '<td><span class="' . $statusClass . '">' . $statusLabel . '</span></td>'
                . '<td class="sc-actions">'
                . '<a href="' . CLP_ADMIN_URL . '/centers_view.php?id=' . (int)$r['id'] . '" class="sc-btn sc-btn-sm sc-btn-secondary" title="View"><i class="fas fa-eye"></i></a>'
                . '<a href="' . CLP_ADMIN_URL . '/centers_form.php?id=' . (int)$r['id'] . '" class="sc-btn sc-btn-sm sc-btn-primary" title="Edit"><i class="fas fa-edit"></i></a>'
                . '<a href="' . CLP_ADMIN_URL . '/centers.php?action=toggle&id=' . (int)$r['id'] . '" class="sc-btn sc-btn-sm sc-btn-warning" title="' . ($isActive ? 'Disable' : 'Enable') . '"><i class="fas fa-' . ($isActive ? 'eye-slash' : 'eye') . '"></i></a>'
                . '<a href="' . CLP_ADMIN_URL . '/centers.php?action=delete&id=' . (int)$r['id'] . '" class="sc-btn sc-btn-sm sc-btn-danger confirm-delete" title="Delete"><i class="fas fa-trash"></i></a>'
                . '</td>'
                . '</tr>';
            $sl++;
        }
    }

    return '<table class="sc-data-table"><thead><tr>' . $head . '</tr></thead><tbody>' . $body . '</tbody></table>';
}

/**
 * Render the pagination controls (sc-pagination).
 */
function clp_centers_render_pagination(int $page, int $totalpages, int $total, int $perpage): string {
    $start = $total === 0 ? 0 : (($page - 1) * $perpage) + 1;
    $end = min($page * $perpage, $total);

    if ($totalpages <= 1) {
        return '<div class="sc-pagination-info">Showing ' . $start . '&ndash;' . $end . ' of ' . $total
            . ' center' . ($total === 1 ? '' : 's') . '</div>';
    }

    $info = '<div class="sc-pagination-info">Showing ' . $start . '&ndash;' . $end . ' of ' . $total
        . ' &middot; Page ' . $page . ' of ' . $totalpages . '</div>';

    $buttons = '<div class="sc-pagination-buttons">';
    $prevdisabled = $page <= 1 ? ' disabled' : '';
    $buttons .= '<button type="button" class="sc-page-btn' . $prevdisabled . '" data-page="' . ($page - 1) . '"'
        . ($page <= 1 ? ' disabled' : '') . '>&lsaquo; Prev</button>';

    $window = 2;
    for ($p = 1; $p <= $totalpages; $p++) {
        if ($p === 1 || $p === $totalpages || ($p >= $page - $window && $p <= $page + $window)) {
            $active = $p === $page ? ' is-active' : '';
            $buttons .= '<button type="button" class="sc-page-btn' . $active . '" data-page="' . $p . '"'
                . ($p === $page ? ' disabled' : '') . '>' . $p . '</button>';
        } else if ($p === $page - $window - 1 || $p === $page + $window + 1) {
            $buttons .= '<span class="sc-page-ellipsis">&hellip;</span>';
        }
    }

    $nextdisabled = $page >= $totalpages ? ' disabled' : '';
    $buttons .= '<button type="button" class="sc-page-btn' . $nextdisabled . '" data-page="' . ($page + 1) . '"'
        . ($page >= $totalpages ? ' disabled' : '') . '>Next &rsaquo;</button>';
    $buttons .= '</div>';

    return $info . $buttons;
}

/**
 * Build the data payload (table + pagination + meta) for the centres list.
 */
function clp_centers_build_data($db, array $f, int $page, int $perpage) {
    $where = ['1=1'];
    $params = [];
    $types = '';

    if ($f['q'] !== '') {
        $like = '%' . $f['q'] . '%';
        $fields = ['center_code', 'center_name', 'sponsor_name', 'district', 'division', 'upazila'];
        $ors = [];
        foreach ($fields as $field) {
            $ors[] = "$field LIKE ?";
            $params[] = $like;
            $types .= 's';
        }
        $where[] = '(' . implode(' OR ', $ors) . ')';
    }

    foreach (['district', 'division', 'upazila', 'center_type', 'support'] as $col) {
        if ($f[$col] !== '') {
            $where[] = "$col = ?";
            $params[] = $f[$col];
            $types .= 's';
        }
    }
    if ($f['status'] !== '') {
        $where[] = "status = ?";
        $params[] = (int)$f['status'];
        $types .= 'i';
    }

    $whereSql = implode(' AND ', $where);

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
    $page = max(1, min($page, $totalpages));
    $offset = ($page - 1) * $perpage;

    $allowedSort = [
        'center_name' => 'center_name',
        'district'    => 'district',
        'division'    => 'division',
        'start_date'  => 'start_date',
        'sponsor_name' => 'sponsor_name',
        'support'     => 'support',
        'status'      => 'status',
    ];
    $sortfield = $allowedSort[$f['sort']] ?? 'start_date';
    $dir = $f['dir'] === 'DESC' ? 'DESC' : 'ASC';

    $listSql = "SELECT * FROM " . CLP_CENTERS_TABLE . " WHERE $whereSql ORDER BY $sortfield $dir, id DESC LIMIT ? OFFSET ?";
    $listTypes = $types . 'ii';
    $listParams = array_merge($params, [$perpage, $offset]);

    $stmt = $db->prepare($listSql);
    $stmt->bind_param($listTypes, ...$listParams);
    $stmt->execute();

    $rows = [];
    $result = $stmt->get_result();
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
    } else {
        while ($row = clp_stmt_fetch_assoc($stmt)) {
            $rows[] = $row;
        }
    }
    $stmt->close();

    $startno = (($page - 1) * $perpage) + 1;

    return [
        'table'       => clp_centers_render_table($rows, $startno),
        'pagination'  => clp_centers_render_pagination($page, $totalpages, $total, $perpage),
        'total'       => $total,
        'page'        => $page,
        'totalpages'  => $totalpages,
    ];
}

// AJAX request: return JSON and stop.
if (isset($_GET['ajax'])) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(clp_centers_build_data($db, $f, $page, $perpage));
    $db->close();
    exit;
}

// Distinct values for the filter dropdowns.
$districts = clp_centers_distinct($db, 'district');
$divisions = clp_centers_distinct($db, 'division');
$upazilas  = clp_centers_distinct($db, 'upazila');

$types = ['clc' => 'CLC', 'scr' => 'SCR'];
$supports = [
    'maintained'  => 'Maintained',
    'activated'   => 'Activated',
    'reactivated' => 'Reactivated',
    'supported'   => 'Supported',
];
$sortoptions = [
    'center_name'  => 'Center Name',
    'district'     => 'District',
    'division'     => 'Division',
    'start_date'   => 'Start Date',
    'sponsor_name' => 'Sponsor',
    'support'      => 'Support',
    'status'       => 'Status',
];

$initial = clp_centers_build_data($db, $f, $page, $perpage);

// Dashboard stat cards.
$totalAll = (int)$db->query("SELECT COUNT(*) AS c FROM " . CLP_CENTERS_TABLE)->fetch_assoc()['c'];
$totalActive = (int)$db->query("SELECT COUNT(*) AS c FROM " . CLP_CENTERS_TABLE . " WHERE status = 1")->fetch_assoc()['c'];

$db->close();

include __DIR__ . '/includes/header.php';
?>

<link rel="stylesheet" href="/local/clp/program.css">
<style>
    .sc-link, .sc-btn { font-family: 'Roboto', sans-serif; }
    .sc-badge { display: inline-block; padding: 3px 10px; border-radius: 999px; font-size: 12px; font-weight: 700; }
    .sc-badge-secondary { background: #eef0f4; color: #3e4e4a; }
    .sc-badge-info { background: #e0f2fe; color: #0369a1; }
    .sc-badge-success { background: #e6f5f0; color: #006b4f; }
    .sc-btn-sm { height: 34px; padding: 0 12px; font-size: 13px; }
    .sc-btn-secondary { background: #eef0f4; color: #3e4e4a; }
    .sc-btn-secondary:hover { background: #e2e6ec; }
    .sc-btn-warning { background: #fff3e0; color: #b45309; border-color: #ffd8a8; }
    .sc-btn-warning:hover { background: #ffe8c2; }
    .sc-btn-danger { background: #fdeaea; color: #b82b00; border-color: #f5c2c2; }
    .sc-btn-danger:hover { background: #f9d2d2; }
    .sc-actions { white-space: nowrap; }
    .sc-actions .sc-btn { margin-right: 4px; }
    /* Lift the component above the admin card so it matches the public look. */
    .content-area { background: transparent; }
    .sc-program-panel { margin-top: 28px; }
    .sc-program-toolbar .sc-btn { margin-left: auto; }
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

    <div class="sc-program-page" data-ajaxurl="centers.php" data-program="centers">
        <header class="sc-program-header">
            <span class="sc-program-eyebrow">Database</span>
            <h1 class="sc-program-title">Sponsored Centers</h1>
            <p class="sc-program-desc">Manage the Computer Literacy Centers (CLCs) and Smart Classrooms (SCRs) that appear on the public &ldquo;Your Sponsored Center(s)&rdquo; page. Search, filter and sort the directory, or add and edit records.</p>
            <div class="sc-program-meta">
                <span class="sc-program-badge">
                    <span class="sc-program-dot" aria-hidden="true"></span>Centers
                </span>
                <span class="sc-program-count"><strong id="sc-program-total"><?php echo (int)$initial['total']; ?></strong> centers</span>
            </div>

            <div class="sc-program-stats">
                <div class="sc-stat-box">
                    <span class="sc-stat-value"><?php echo $totalAll; ?></span>
                    <span class="sc-stat-label">Total Centers</span>
                </div>
                <div class="sc-stat-box">
                    <span class="sc-stat-value"><?php echo $totalActive; ?></span>
                    <span class="sc-stat-label">Enabled (visible on site)</span>
                </div>
            </div>
        </header>

        <section class="sc-program-panel">
            <form class="sc-program-filters" id="sc-program-filters" method="get" autocomplete="off">
                <div class="sc-filter-search">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21 21l-4.3-4.3M11 18a7 7 0 1 0 0-14 7 7 0 0 0 0 14Z"/></svg>
                    <input type="search" name="q" value="<?php echo clp_escape($f['q']); ?>" placeholder="Search by code, name, school, sponsor, district…" aria-label="Search centers">
                </div>

                <div class="sc-filter-grid">
                    <div class="sc-filter-field">
                        <label for="f-district">District</label>
                        <select id="f-district" name="district">
                            <option value="">All districts</option>
                            <?php foreach ($districts as $d): ?>
                                <option value="<?php echo clp_escape($d); ?>" <?php echo $f['district'] === $d ? 'selected' : ''; ?>><?php echo clp_escape($d); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="sc-filter-field">
                        <label for="f-division">Division</label>
                        <select id="f-division" name="division">
                            <option value="">All divisions</option>
                            <?php foreach ($divisions as $d): ?>
                                <option value="<?php echo clp_escape($d); ?>" <?php echo $f['division'] === $d ? 'selected' : ''; ?>><?php echo clp_escape($d); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="sc-filter-field">
                        <label for="f-upazila">Upazila</label>
                        <select id="f-upazila" name="upazila">
                            <option value="">All upazilas</option>
                            <?php foreach ($upazilas as $u): ?>
                                <option value="<?php echo clp_escape($u); ?>" <?php echo $f['upazila'] === $u ? 'selected' : ''; ?>><?php echo clp_escape($u); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="sc-filter-field">
                        <label for="f-center_type">Center Type</label>
                        <select id="f-center_type" name="center_type">
                            <option value="">All types</option>
                            <?php foreach ($types as $v => $l): ?>
                                <option value="<?php echo $v; ?>" <?php echo $f['center_type'] === $v ? 'selected' : ''; ?>><?php echo $l; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="sc-filter-field">
                        <label for="f-support">Support</label>
                        <select id="f-support" name="support">
                            <option value="">All support</option>
                            <?php foreach ($supports as $v => $l): ?>
                                <option value="<?php echo $v; ?>" <?php echo $f['support'] === $v ? 'selected' : ''; ?>><?php echo $l; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="sc-filter-field">
                        <label for="f-status">Status</label>
                        <select id="f-status" name="status">
                            <option value="">All statuses</option>
                            <option value="1" <?php echo $f['status'] === '1' ? 'selected' : ''; ?>>Enabled</option>
                            <option value="0" <?php echo $f['status'] === '0' ? 'selected' : ''; ?>>Disabled</option>
                        </select>
                    </div>
                    <div class="sc-filter-field">
                        <label for="f-sort">Sort by</label>
                        <select id="f-sort" name="sort">
                            <?php foreach ($sortoptions as $k => $l): ?>
                                <option value="<?php echo $k; ?>" <?php echo $f['sort'] === $k ? 'selected' : ''; ?>><?php echo $l; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="sc-filter-field">
                        <label for="f-dir">Order</label>
                        <select id="f-dir" name="dir">
                            <option value="ASC" <?php echo $f['dir'] !== 'DESC' ? 'selected' : ''; ?>>Ascending</option>
                            <option value="DESC" <?php echo $f['dir'] === 'DESC' ? 'selected' : ''; ?>>Descending</option>
                        </select>
                    </div>
                    <div class="sc-filter-actions">
                        <button type="submit" class="sc-btn sc-btn-primary">Search</button>
                        <button type="button" class="sc-btn sc-btn-ghost" data-reset>Reset</button>
                    </div>
                </div>
            </form>

            <div class="sc-program-toolbar">
                <h2 class="sc-panel-title">Centers</h2>
                <p class="sc-panel-sub">Center directory</p>
                <a href="<?php echo CLP_ADMIN_URL; ?>/centers_form.php" class="sc-btn sc-btn-primary"><i class="fas fa-plus"></i> Add New Center</a>
            </div>

            <div class="sc-program-tablewrap" id="sc-program-table" aria-live="polite" aria-busy="false">
                <?php echo $initial['table']; ?>
            </div>

            <nav class="sc-pagination" id="sc-program-pagination" aria-label="Centers pagination">
                <?php echo $initial['pagination']; ?>
            </nav>
        </section>
    </div>
</div>

<script>
(function () {
    var wrap = document.querySelector('.sc-program-page');
    if (!wrap) {
        return;
    }
    var form = wrap.querySelector('#sc-program-filters');
    var tableBox = wrap.querySelector('#sc-program-table');
    var pageBox = wrap.querySelector('#sc-program-pagination');
    var totalEl = wrap.querySelector('#sc-program-total');
    var url = wrap.getAttribute('data-ajaxurl');
    var loading = false;
    var typingTimer;

    function buildQuery(page) {
        var params = [];
        var fd = new FormData(form);
        fd.forEach(function (value, key) {
            if (value !== '') {
                params.push(encodeURIComponent(key) + '=' + encodeURIComponent(value));
            }
        });
        params.push('ajax=1');
        params.push('page=' + page);
        return params.join('&');
    }

    function load(page) {
        if (loading) {
            return;
        }
        loading = true;
        tableBox.classList.add('is-loading');

        var xhr = new XMLHttpRequest();
        xhr.open('GET', url + '?' + buildQuery(page), true);
        xhr.responseType = 'json';
        xhr.onload = function () {
            if (xhr.status === 200 && xhr.response) {
                var d = xhr.response;
                tableBox.innerHTML = d.table;
                pageBox.innerHTML = d.pagination;
                if (totalEl) {
                    totalEl.textContent = d.total;
                }
                bindPagination();
            }
            loading = false;
            tableBox.classList.remove('is-loading');
        };
        xhr.onerror = function () {
            loading = false;
            tableBox.classList.remove('is-loading');
        };
        xhr.send();
    }

    function bindPagination() {
        pageBox.querySelectorAll('.sc-page-btn:not([disabled])').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var p = parseInt(btn.getAttribute('data-page'), 10);
                if (!isNaN(p)) {
                    load(p);
                }
            });
        });
    }

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        load(1);
    });

    form.querySelectorAll('select').forEach(function (sel) {
        sel.addEventListener('change', function () {
            load(1);
        });
    });

    var search = form.querySelector('input[name="q"]');
    if (search) {
        search.addEventListener('input', function () {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(function () {
                load(1);
            }, 350);
        });
    }

    var reset = form.querySelector('[data-reset]');
    if (reset) {
        reset.addEventListener('click', function () {
            form.reset();
            load(1);
        });
    }

    bindPagination();
})();
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
