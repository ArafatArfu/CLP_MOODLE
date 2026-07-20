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
 * Render the sponsored-centre data table for a set of rows, restoring the
 * previous list design (peach sticky header, district group headers,
 * support-coloured rows, type badges and green View buttons).
 *
 * @param array $rows Centre records (stdClass) from the repository.
 * @param int $startno Serial number for the first row on this page.
 * @return string HTML table (previous Bootstrap-based list design).
 */
function local_centermanagement_render_centers_table(array $rows, int $startno = 1): string {
    $green = "#47c9a2";
    $lightGreen = "#b4f1df";

    $head = '<th class="clp-col-sl">Sl</th>'
        . '<th>Center Name</th>'
        . '<th>District</th>'
        . '<th>Start Date</th>'
        . '<th>Center Type</th>'
        . '<th>Sponsor</th>'
        . '<th>School Link</th>';

    if (empty($rows)) {
        $body = '<tr><td colspan="7" class="clp-empty">No centers found.</td></tr>';
    } else {
        // Group the (already filtered/paginated) rows by district to mirror
        // the previous list design with its per-district header rows.
        $groups = [];
        foreach ($rows as $row) {
            $groups[$row->district ?? ''][] = $row;
        }

        $sl = $startno;
        $body = '';
        foreach ($groups as $districtName => $schools) {
            $body .= '<tr class="clp-district-row">'
                . '<td colspan="7">'
                . htmlspecialchars($districtName, ENT_QUOTES)
                . '</td></tr>';

            foreach ($schools as $center) {
                $support = strtolower((string) ($center->support ?? ''));
                if (in_array($support, ['maintained', 'activated', 'supported'])) {
                    $rowColor = $green;
                } elseif ($support === 'reactivated') {
                    $rowColor = $lightGreen;
                } else {
                    $rowColor = '#FFFFFF';
                }

                $isClc = strtolower($center->center_type ?? 'clc') === 'clc';
                $typeLabel = $isClc ? 'Computer Literacy Center' : 'Smart Classroom';

                $startDate = !empty($center->start_date) ? date('Y F', $center->start_date) : '';

                $body .= '<tr style="background-color:' . $rowColor . '">'
                    . '<td class="clp-col-sl">' . $sl . '</td>'
                    . '<td>' . htmlspecialchars($center->center_name ?? '', ENT_QUOTES) . '</td>'
                    . '<td>' . htmlspecialchars($districtName, ENT_QUOTES) . '</td>'
                    . '<td>' . $startDate . '</td>'
                    . '<td><span class="badge badge-secondary text-uppercase ml-1">' . $typeLabel . '</span></td>'
                    . '<td>' . htmlspecialchars($center->sponsor_name ?? '', ENT_QUOTES) . '</td>'
                    . '<td><a class="btn btn-primary" href="school-details.php?schoolInfo=' . (int) $center->id . '">View</a></td>'
                    . '</tr>';

                $sl++;
            }
        }
    }

    return '<div class="clp-centers-table"><table>'
        . '<thead><tr>' . $head . '</tr></thead>'
        . '<tbody>' . $body . '</tbody>'
        . '</table></div>';
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
