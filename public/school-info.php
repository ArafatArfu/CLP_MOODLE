<?php
require_once(__DIR__ . '/config.php');
use local_centermanagement\local\center_repository;

header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
header('Expires: 0');

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/school-info.php');
$PAGE->set_title('CLP | Your Sponsored Center(s)');
$PAGE->set_heading('CLP | Your Sponsored Center(s)');
echo "<!DOCTYPE html>\n<html lang=\"en\">\n";
?>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>CLP | Your Sponsored Center(s)</title>
    <link href="/theme/clp/assets/images/favicon-icon.png" rel="icon" sizes="32x32" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons&display=swap">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/theme/clp/assets/css/style.css">
    <link rel="stylesheet" href="/theme/clp/assets/css/responsive.css">
    <link rel="stylesheet" href="/theme/clp/assets/css/jp-style.css">
    <!-- Reuse the CLC program page component styles so this page and
         /local/clp/program.php share one identical filtering component. -->
    <link rel="stylesheet" href="/local/clp/program.css">
    <style>
        /* Restore the sponsored-centers list to its previous Bootstrap table
           design: peach sticky header, per-district group rows, support-coloured
           rows, type badges and green View buttons. Scoped under .clp-centers-table
           so program.css (used by the filter/pagination) cannot break it. */
        .clp-centers-table { width: 100%; }
        .clp-centers-table table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            font-family: 'Noto Serif', serif;
            font-size: 14px;
            color: #000;
        }
        .clp-centers-table th,
        .clp-centers-table td {
            padding: 9px 12px;
            text-align: left;
            border-bottom: 1px solid #e3e3e3;
            vertical-align: middle;
        }
        .clp-centers-table thead th {
            background-color: #f9cdb7;
            color: #000;
            font-size: 1.15em;
            position: sticky;
            top: 0;
            z-index: 2;
            white-space: nowrap;
        }
        .clp-centers-table tbody tr:nth-child(even) { background-color: #EEE; }
        .clp-centers-table .clp-district-row td {
            background-color: #ffc107 !important;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
        }
        .clp-centers-table .clp-col-sl {
            width: 44px;
            text-align: center;
            white-space: nowrap;
        }
        .clp-centers-table .clp-empty {
            text-align: center;
            padding: 30px;
            color: #666;
            font-style: italic;
        }
        .clp-centers-table .clp-type {
            display: inline-block;
            padding: 3px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .3px;
            text-transform: uppercase;
            color: #fff;
            white-space: nowrap;
        }
        .clp-centers-table .clp-type-clc { background-color: #0d9488; }
        .clp-centers-table .clp-type-scr { background-color: #2563eb; }
        .clp-centers-table .clp-type-clcscr { background-color: #b45309; }
        .clp-centers-table .clp-type-other { background-color: #52525b; }
        .clp-centers-table .clp-view-cell { text-align: center; }
        .clp-centers-table .clp-view-cell .btn { white-space: nowrap; }
        .sc-program-tablewrap.is-loading { opacity: .55; }
        /* Let the hero/component sit naturally under the theme navbar. */
        body { background: #f5f6f8; }
    </style>
</head>
<body>

<?php
$navContext = [
    'output' => $OUTPUT,
    'config' => [
        'wwwroot' => '',
        'homeurl' => '/',
    ],
];
echo $OUTPUT->render_from_template('theme_clp/navbar', $navContext);
?>

<?php
// --- Data preparation (mirrors local/clp/program.php) ----------------------
$totalClcCount = get_config('local_centermanagement', 'total_clc_count');
if ($totalClcCount === false || $totalClcCount === '') {
    $totalClcCount = 309;
}
$totalScrCount = get_config('local_centermanagement', 'total_scr_count');
if ($totalScrCount === false || $totalScrCount === '') {
    $totalScrCount = 209;
}

// Read the same filter/search/sort parameters the component exposes.
$f = [
    'q'           => trim((string)($_GET['q'] ?? '')),
    'division'    => trim((string)($_GET['division'] ?? '')),
    'district'    => trim((string)($_GET['district'] ?? '')),
    'upazila'     => trim((string)($_GET['upazila'] ?? '')),
    'center_type' => trim((string)($_GET['center_type'] ?? '')),
    'sponsor'     => trim((string)($_GET['sponsor'] ?? '')),
    'status'      => trim((string)($_GET['status'] ?? '')),
    'sort'        => trim((string)($_GET['sort'] ?? 'center_name')),
    'dir'         => strtoupper(trim((string)($_GET['dir'] ?? 'ASC'))) === 'DESC' ? 'DESC' : 'ASC',
];
$page = max(1, (int)($_GET['page'] ?? 1));
$perpage = (int)optional_param('perpage', 20, PARAM_INT);
$allowed_perpage = [10, 20, 50, 100];
if (!in_array($perpage, $allowed_perpage, true)) {
    $perpage = 20;
}

require_once($CFG->dirroot . '/local/centermanagement/public_view.php');

$districts = center_repository::get_distinct_field('district');
$divisions = center_repository::get_distinct_field('division');
$upazilas  = center_repository::get_distinct_field('upazila');

$types = [
    'clc' => get_string('centertypeclc', 'local_centermanagement'),
    'scr' => get_string('centertypescr', 'local_centermanagement'),
    'clc_scr' => get_string('centertypeclcscr', 'local_centermanagement'),
    'other' => get_string('centertypeother', 'local_centermanagement'),
];
$sponsors = center_repository::get_distinct_sponsors();
$statuses = [
    '1' => get_string('supported', 'local_centermanagement'),
    '0' => get_string('nonsupported', 'local_centermanagement'),
];
$sortoptions = [
    'center_name'  => get_string('sortnameasc', 'local_centermanagement'),
    'center_name DESC' => get_string('sortnamedesc', 'local_centermanagement'),
    'start_date ASC' => get_string('sortdateasc', 'local_centermanagement'),
    'start_date DESC' => get_string('sortdatedesc', 'local_centermanagement'),
];

$allowed_sort = [
    'center_name'  => 'center_name',
    'division'     => 'division',
    'district'     => 'district',
    'upazila'     => 'upazila',
    'start_date'   => 'start_date',
    'center_type'  => 'center_type',
    'sponsor_name' => 'sponsor_name',
    'status'       => 'status',
];
$f['sort'] = $allowed_sort[$f['sort']] ?? 'center_name';

$initial = local_centermanagement_build_centers_data($f, $page, $perpage);

// AJAX request: return JSON and stop (identical to program.php behaviour).
if (isset($_GET['ajax'])) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($initial);
    exit;
}

$totalCenters = $initial['total'];

/**
 * Render <option> elements for a select, marking the active value.
 */
function school_info_options(array $values, string $current, string $allLabel): string {
    $html = '<option value="">' . htmlspecialchars($allLabel, ENT_QUOTES) . '</option>';
    foreach ($values as $value) {
        $selected = (string)$value === (string)$current ? ' selected' : '';
        $html .= '<option value="' . htmlspecialchars($value, ENT_QUOTES) . '"' . $selected . '>'
            . htmlspecialchars($value, ENT_QUOTES) . '</option>';
    }
    return $html;
}

function school_info_assoc_options(array $map, string $current, string $allLabel): string {
    $html = '<option value="">' . htmlspecialchars($allLabel, ENT_QUOTES) . '</option>';
    foreach ($map as $value => $label) {
        $selected = (string)$value === (string)$current ? ' selected' : '';
        $html .= '<option value="' . htmlspecialchars($value, ENT_QUOTES) . '"' . $selected . '>'
            . htmlspecialchars($label, ENT_QUOTES) . '</option>';
    }
    return $html;
}
?>

<div class="sc-program-page" data-ajaxurl="school-info-ajax.php" data-program="centers">
    <header class="sc-program-header">
        <span class="sc-program-eyebrow">Database</span>
        <h1 class="sc-program-title">Your Sponsored Center(s)</h1>
        <p class="sc-program-desc">CLP establishes and supports Computer Literacy Centers (CLCs) and Smart Classrooms (SCRs) across Bangladesh. The directory below lists every sponsored center&mdash;filter by location, type or support status to explore them.</p>
        <div class="sc-program-meta">
            <span class="sc-program-badge">
                <span class="sc-program-dot" aria-hidden="true"></span>Centers
            </span>
            <span class="sc-program-count"><strong id="sc-program-total"><?php echo (int)$totalCenters; ?></strong> centers listed</span>
        </div>

        <div class="sc-program-stats">
            <div class="sc-stat-box">
                <span class="sc-stat-value"><?php echo (int)$totalClcCount; ?></span>
                <span class="sc-stat-label">Computer Literacy Centers (CLCs)</span>
            </div>
            <div class="sc-stat-box">
                <span class="sc-stat-value"><?php echo (int)$totalScrCount; ?></span>
                <span class="sc-stat-label">Smart Classrooms (SCRs)</span>
            </div>
        </div>
    </header>

    <section class="sc-program-panel">
        <form class="sc-program-filters" id="sc-program-filters" method="get" autocomplete="off">
            <div class="sc-filter-search">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21 21l-4.3-4.3M11 18a7 7 0 1 0 0-14 7 7 0 0 0 0 14Z"/></svg>
                <input type="search" name="q" value="<?php echo htmlspecialchars($f['q'], ENT_QUOTES); ?>" placeholder="Search by center, school, sponsor, district…" aria-label="Search centers">
            </div>

            <div class="sc-filter-grid">
                <div class="sc-filter-field">
                    <label for="f-search"><?php echo get_string('search', 'local_centermanagement'); ?></label>
                    <input type="search" id="f-search" name="q" value="<?php echo htmlspecialchars($f['q'], ENT_QUOTES); ?>" placeholder="<?php echo get_string('searchbyname', 'local_centermanagement'); ?>" aria-label="Search centers">
                </div>
                <div class="sc-filter-field">
                    <label for="f-division"><?php echo get_string('division', 'local_centermanagement'); ?></label>
                    <select id="f-division" name="division">
                        <?php echo school_info_options($divisions, $f['division'], get_string('filterbydivision', 'local_centermanagement')); ?>
                    </select>
                </div>
                <div class="sc-filter-field">
                    <label for="f-district"><?php echo get_string('district', 'local_centermanagement'); ?></label>
                    <select id="f-district" name="district">
                        <?php echo school_info_options($districts, $f['district'], get_string('filterbydistrict', 'local_centermanagement')); ?>
                    </select>
                </div>
                <div class="sc-filter-field">
                    <label for="f-upazila"><?php echo get_string('upazila', 'local_centermanagement'); ?></label>
                    <select id="f-upazila" name="upazila">
                        <?php echo school_info_options($upazilas, $f['upazila'], get_string('filterbyupazila', 'local_centermanagement')); ?>
                    </select>
                </div>
                <div class="sc-filter-field">
                    <label for="f-center_type"><?php echo get_string('centertype', 'local_centermanagement'); ?></label>
                    <select id="f-center_type" name="center_type">
                        <?php echo school_info_assoc_options($types, $f['center_type'], get_string('filterbytype', 'local_centermanagement')); ?>
                    </select>
                </div>
                <div class="sc-filter-field">
                    <label for="f-sponsor"><?php echo get_string('sponsor', 'local_centermanagement'); ?></label>
                    <select id="f-sponsor" name="sponsor">
                        <?php echo school_info_options($sponsors, $f['sponsor'], get_string('filterbysponsor', 'local_centermanagement')); ?>
                    </select>
                </div>
                <div class="sc-filter-field">
                    <label for="f-status"><?php echo get_string('status', 'local_centermanagement'); ?></label>
                    <select id="f-status" name="status">
                        <?php echo school_info_assoc_options($statuses, $f['status'], get_string('filterbystatus', 'local_centermanagement')); ?>
                    </select>
                </div>
                <div class="sc-filter-field">
                    <label for="f-sort"><?php echo get_string('sortby', 'local_centermanagement'); ?></label>
                    <select id="f-sort" name="sort">
                        <?php
                        foreach ($sortoptions as $key => $label) {
                            $sel = (string)$key === (string)$f['sort'] ? ' selected' : '';
                            echo '<option value="' . htmlspecialchars($key, ENT_QUOTES) . '"' . $sel . '>' . htmlspecialchars($label, ENT_QUOTES) . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="sc-filter-field">
                    <label for="f-dir">Order</label>
                    <select id="f-dir" name="dir">
                        <option value="ASC" <?php echo $f['dir'] !== 'DESC' ? 'selected' : ''; ?>>Ascending</option>
                        <option value="DESC" <?php echo $f['dir'] === 'DESC' ? 'selected' : ''; ?>>Descending</option>
                    </select>
                </div>
                <div class="sc-filter-field">
                    <label for="f-perpage"><?php echo get_string('results', 'local_centermanagement'); ?></label>
                    <select id="f-perpage" name="perpage">
                        <?php
                        foreach ($allowed_perpage as $pp) {
                            $sel = $pp === $perpage ? ' selected' : '';
                            echo '<option value="' . (int)$pp . '"' . $sel . '>' . (int)$pp . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="sc-filter-actions">
                    <button type="submit" class="sc-btn sc-btn-primary"><?php echo get_string('search', 'local_centermanagement'); ?></button>
                    <button type="button" class="sc-btn sc-btn-ghost" data-reset><?php echo get_string('reset', 'local_centermanagement'); ?></button>
                </div>
            </div>
        </form>

        <div class="sc-program-toolbar">
            <h2 class="sc-panel-title"><?php echo get_string('schoolinformationmanagement', 'local_centermanagement'); ?></h2>
            <p class="sc-panel-sub">Center directory</p>
        </div>

        <div class="sc-program-tablewrap" id="sc-program-table" aria-live="polite" aria-busy="false">
            <?php echo $initial['table']; ?>
        </div>

        <nav class="sc-pagination" id="sc-program-pagination" aria-label="Centers pagination">
            <?php echo $initial['pagination']; ?>
        </nav>
    </section>
</div>

<div class="donate-popup" id="donate-popup">
    <div class="close-donate theme-btn"><span class="fa fa-close"></span></div>
    <div class="popup-inner">
        <div class="container">
            <div class="donate-form-area">
                <div class="section-title center"><h2>Donate</h2></div>
                <div class="row">
                    <div class="col-sm-12">
                        <p style="margin:30px 0;"><strong style="color: #00140F; font-size: 24px; line-height: 32px; font-weight: bold;">Donate to CLP</strong></p>
                        <div class="row">
                            <div class="col-md-auto"></div>
                            <div class="col-sm-6 col-xs-12">
                                <div style="text-align: center; border: solid 1px #ccc; border-radius: 10px; padding: 5px 5px 15px 5px; margin-bottom: 15px; color:black">
                                    <h5>All-Purpose</h5><br>
                                    <p><a href="sponsor-form.php"><img border="0" alt="" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" class="donate-img"></a></p>
                                </div>
                            </div>
                            <div class="col-md-auto"></div>
                            <div class="col-sm-6 col-xs-12">
                                <div style="text-align: center; border: solid 1px #ccc; border-radius: 10px; padding: 5px 5px 15px 5px; margin-bottom: 15px; color:black">
                                    <h5>Sherpur Project</h5><br>
                                    <p><a href="https://na01.safelinks.protection.outlook.com/?url=https%3A%2F%2Fwww.paypal.com%2Fdonate%3Fhosted_button_id%3DV6D3X44Q434VC&data=04%7C01%7C%7C55db0d88c5c0408b0deb08d8bbd957c2%7C84df9e7fe9f640afb435aaaaaaaaaaaa%7C1%7C0%7C637465889434712419%7CUnknown%7CTWFpbGZsb3d8eyJWIjoiMC4wLjAwMDAiLCJQIjoiV2luMzIiLCJBTiI6Ik1haWwiLCJXVCI6Mn0%3D%7C1000&sdata=dBM7VYebTlhl%2BD9nki7ERXG9u3ajtdfduu0cNPJHauw%3D&reserved=0"><img border="0" alt="" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" class="donate-img"></a></p>
                                </div>
                            </div>
                        </div>
                        <div style="margin: 0 auto; padding-top:10px;">
                            <p style="font-size: 20px; margin-bottom: 10px; margin-top: 5px; text-align: center;">Or</p>
                            <div style="text-align: center; max-width: 196px; margin: 0 auto; border-radius: 10px; padding: 10px; line-height: 22px; color:black; font-weight:bold;">Mail Check payable to CLP, 6 Tharp Lane, Marlboro, NJ07746.</div>
                        </div>
                        <div style="margin: 0 auto; width: 100%; text-align: center; color:black;"><strong>Tax ID # 46-0646134</strong></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="clp-footer">
    <section class="container-fluid">
        <div class="row">
            <div class="col-sm-4 col-xs-12" style="background-color: #f7f1e3; height: 520px;">
                <h3 class="footer-title">Resources</h3>
                <ul class="footer-list-menu">
                    <li><a href="evaluation-report.php">INDEPENDENT EVALUATION REPORT</a></li>
                    <li><a href="formative-reports.php">FORMATIVE REPORT</a></li>
                    <li><a href="annual-report.php">ANNUAL REPORT</a></li>
                    <li><a href="magazines.php">MAGAZINES</a></li>
                    <li><a href="brochure.php">BROCHURE</a></li>
                </ul>
                <h3 class="footer-title">Contact Info</h3>
                <a style="color:black;" href="tel:+7329728362">(732) 972-8362</a> <br/>
                <a style="color:black;" href="mailto:clp@clpweb.org">clp@clpweb.org</a>
                <h3 class="footer-title">Mailing Address</h3>
                <p class="address">Computer Literacy Program (CLP)<br>6 Tharp Lane <br/> Marlboro, NJ 07746, USA</p>
            </div>
            <div class="col-sm-4 col-xs-12" style="height: 520px;">
                <h3 class="footer-title">CLP Mission</h3>
                <p style="line-height: 20px;">Empowering underprivileged youths through computer literacy training and technology-aided education.</p>
                <h3 class="footer-title">Follow Us</h3>
                <div class="row">
                    <div class="footer-social">
                        <a target="_blank" href="https://facebook.com/CLPUSAA" class="fa fa-facebook social-fb"></a>
                        <a target="_blank" href="https://www.instagram.com/clp_usa/" class="fa fa-instagram social-instagram"></a>
                        <a target="_blank" href="https://twitter.com/clp_usa" class="fa fa-twitter social-twitter"></a>
                        <a target="_blank" href="https://www.youtube.com/channel/UC3CIzUUXeDXspImUjubA19A" class="fa fa-youtube social-youtube"></a>
                        <a target="_blank" href="https://www.linkedin.com/company/computer-literacy-program-volunteers-for-underprivileged/" class="fa fa-linkedin social-linkedin"></a>
                    </div>
                </div>
                <h3 class="footer-title">Legal Info</h3>
                <ul class="footer-list-menu">
                    <li>IRS ID: <strong>46-0646134</strong></li>
                </ul>
            </div>
            <div class="col-sm-4 col-xs-12" style="background-color: #f7f1e3; height: 520px;">
                <h3 class="footer-title">Quick Links</h3>
                <ul class="footer-list-menu">
                    <li><a href="donation-online.php">DONATE ONLINE</a></li>
                    <li><a href="donation-mail.php">DONATE BY MAIL</a></li>
                    <li><a href="donation-amazon.php">DONATE BY AMAZON-SMILE</a></li>
                    <li><a href="sponsor-clc.php">SPONSOR A CLC</a></li>
                    <li><a href="sponsor-scr.php">SPONSOR A SCR</a></li>
                    <li><a href="sponsor-tokai.php">SPONSOR A TOKAI(টোকাই)-CLC</a></li>
                    <li><a href="sponsor-computer.php">SPONSOR A COMPUTER</a></li>
                    <li><a href="volunteer.php">BE A VOLUNTEER</a></li>
                    <li><a href="contact-us.php">CONTACT US</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="background-color: #232121;">
                <p class="text-center" style="color: #FFF; padding: 5px;">Copyright &copy; CLP, 2026</p>
            </div>
        </div>
    </section>
</footer>

<script type="text/javascript">
    (function () {
        var wrap = document.querySelector('.sc-program-page');
        if (!wrap) {
            return;
        }
        var form = wrap.querySelector('#sc-program-filters');
        var tableBox = wrap.querySelector('#sc-program-table');
        var pageBox = wrap.querySelector('#sc-program-pagination');
        var totalEl = wrap.querySelector('#sc-program-total');
        var url = window.location.href.split('?')[0];
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
                    var top = wrap.getBoundingClientRect().top + window.scrollY - 90;
                    window.scrollTo({ top: top, behavior: 'smooth' });
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

<script src="/theme/clp/assets/js/jquery.min.js"></script>
<script src="/theme/clp/assets/js/jquery.js"></script>
<script src="/theme/clp/assets/js/menu.js"></script>
<script src="/theme/clp/assets/js/jquery.magnific-popup.min.js"></script>
<script src="/theme/clp/assets/js/SmoothScroll.js"></script>
<script src="/theme/clp/assets/js/bootstrap.min.js"></script>
<script src="/theme/clp/assets/js/owl.carousel.min.js"></script>
<script src="/theme/clp/assets/js/custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>
</html>
