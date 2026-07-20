<?php
// Shared rendering helpers for the public "Your Sponsored Center(s)" page
// (school-info.php) and its AJAX filter endpoint (school-info-ajax.php).
//
// The markup and behaviour deliberately mirror the CLC program page
// (local/clp/program.php + local/clp/program.css) so that both pages expose
// the *same* component: the description/hero box, the filter panel, the
// responsive data table and the pagination. Only the data differs. Keeping
// the render logic here means the initial server render and the dynamic
// AJAX refresh stay 100% identical (no duplicated markup).

use local_centermanagement\local\center_repository;

defined('MOODLE_INTERNAL') || define('MOODLE_INTERNAL', true);

/**
 * Render the centres data table (sc-data-table) for a set of rows.
 *
 * @param array $rows Centre records (stdClass) from the repository.
 * @param int $startno Serial number for the first row on this page.
 * @return string HTML table (matches the program page table component).
 */
function local_centermanagement_render_centers_table(array $rows, int $startno = 1): string {
    $head = '<th scope="col" class="sc-col-sl">Sl</th>'
        . '<th scope="col">Center Name</th>'
        . '<th scope="col">District</th>'
        . '<th scope="col">Division</th>'
        . '<th scope="col">Start Date</th>'
        . '<th scope="col">Center Type</th>'
        . '<th scope="col">Sponsor</th>'
        . '<th scope="col">View</th>';

    if (empty($rows)) {
        $body = '<tr class="sc-empty-row"><td colspan="8">No centers match your search or filters.</td></tr>';
    } else {
        $body = '';
        $sl = $startno;
        foreach ($rows as $row) {
            $ctype = strtolower($row->center_type ?? 'clc');
            $typeLabel = $ctype === 'scr' ? 'Smart Classroom' : 'Computer Literacy Center';
            $startDate = !empty($row->start_date) ? date('M Y', (int)$row->start_date) : '—';
            $body .= '<tr>'
                . '<td class="sc-col-sl">' . $sl . '</td>'
                . '<td>' . htmlspecialchars($row->center_name ?? '', ENT_QUOTES) . '</td>'
                . '<td>' . htmlspecialchars($row->district ?? '', ENT_QUOTES) . '</td>'
                . '<td>' . htmlspecialchars($row->division ?? '', ENT_QUOTES) . '</td>'
                . '<td>' . $startDate . '</td>'
                . '<td>' . $typeLabel . '</td>'
                . '<td>' . htmlspecialchars($row->sponsor_name ?? '', ENT_QUOTES) . '</td>'
                . '<td><a class="sc-link" href="school-details.php?schoolInfo=' . (int)$row->id . '">View</a></td>'
                . '</tr>';
            $sl++;
        }
    }

    return '<table class="sc-data-table"><thead><tr>' . $head . '</tr></thead><tbody>' . $body . '</tbody></table>';
}

/**
 * Render the pagination controls (sc-pagination) for the centres list.
 *
 * @param int $page Current page.
 * @param int $totalpages Total number of pages.
 * @param int $total Total number of matching records.
 * @param int $perpage Records per page.
 * @return string HTML pagination (matches the program page pagination component).
 */
function local_centermanagement_render_centers_pagination(int $page, int $totalpages, int $total, int $perpage = 20): string {
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
 * Build the full data payload (table + pagination + meta) for the centres
 * list, mirroring local_clp_build_program_data() from the CLC program page.
 *
 * @param array $f Filter array passed to center_repository::search_sponsored_centers().
 * @param int $page Current page.
 * @param int $perpage Records per page.
 * @return array ['table', 'pagination', 'total', 'page', 'totalpages']
 */
function local_centermanagement_build_centers_data(array $f, int $page, int $perpage = 20): array {
    $data = center_repository::search_sponsored_centers($f, $page, $perpage);
    $startno = (($data['page'] - 1) * $perpage) + 1;

    return [
        'table'       => local_centermanagement_render_centers_table($data['rows'], $startno),
        'pagination'  => local_centermanagement_render_centers_pagination($data['page'], $data['totalpages'], $data['total'], $perpage),
        'total'       => $data['total'],
        'page'        => $data['page'],
        'totalpages'  => $data['totalpages'],
    ];
}
