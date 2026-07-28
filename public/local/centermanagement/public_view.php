<?php
// Shared rendering helpers for the public "School Information" page
// (school-info.php) and its AJAX filter endpoint (school-info-ajax.php).

use local_centermanagement\local\center_repository;

defined('MOODLE_INTERNAL') || define('MOODLE_INTERNAL', true);

function local_centermanagement_render_centers_table(array $rows, int $startno = 1): string {
    if (empty($rows)) {
        return '<div class="clp-program-tablewrap"><table class="clp-centers-table"><thead><tr>'
            . '<th class="clp-col-sl">' . get_string('sl', 'local_centermanagement') . '</th>'
            . '<th>' . get_string('centername', 'local_centermanagement') . '</th>'
            . '<th>' . get_string('division', 'local_centermanagement') . '</th>'
            . '<th>' . get_string('district', 'local_centermanagement') . '</th>'
            . '<th>' . get_string('upazila', 'local_centermanagement') . '</th>'
            . '<th>' . get_string('startdate', 'local_centermanagement') . '</th>'
            . '<th>' . get_string('centertype', 'local_centermanagement') . '</th>'
            . '<th>' . get_string('sponsorname', 'local_centermanagement') . '</th>'
            . '<th>' . get_string('schoollink', 'local_centermanagement') . '</th>'
            . '</tr></thead><tbody>'
            . '<tr><td colspan="9" class="clp-empty">' . get_string('nocentersfound', 'local_centermanagement') . '</td></tr>'
            . '</tbody></table></div>';
    }

    $sl = $startno;
    $html = '<div class="clp-program-tablewrap"><table class="clp-centers-table"><thead><tr>'
        . '<th class="clp-col-sl">' . get_string('sl', 'local_centermanagement') . '</th>'
        . '<th>' . get_string('centername', 'local_centermanagement') . '</th>'
        . '<th>' . get_string('division', 'local_centermanagement') . '</th>'
        . '<th>' . get_string('district', 'local_centermanagement') . '</th>'
        . '<th>' . get_string('upazila', 'local_centermanagement') . '</th>'
        . '<th>' . get_string('startdate', 'local_centermanagement') . '</th>'
        . '<th>' . get_string('centertype', 'local_centermanagement') . '</th>'
        . '<th>' . get_string('sponsorname', 'local_centermanagement') . '</th>'
        . '<th>' . get_string('schoollink', 'local_centermanagement') . '</th>'
        . '</tr></thead><tbody>';

    foreach ($rows as $center) {
        $ct = strtolower((string)($center->center_type ?? 'clc'));
        if ($ct === 'clc_scr') {
            $typeLabel = get_string('centertypeclcscr', 'local_centermanagement');
            $typeClass = 'clp-type clp-type-clcscr';
        } elseif ($ct === 'scr') {
            $typeLabel = get_string('centertypescr', 'local_centermanagement');
            $typeClass = 'clp-type clp-type-scr';
        } elseif ($ct === 'other') {
            $typeLabel = get_string('centertypeother', 'local_centermanagement');
            $typeClass = 'clp-type clp-type-other';
        } else {
            $typeLabel = get_string('centertypeclc', 'local_centermanagement');
            $typeClass = 'clp-type clp-type-clc';
        }

        $startDate = '';
        if (!empty($center->start_date)) {
            $startDate = userdate($center->start_date, get_string('strftimedate', 'langconfig'));
        }

        $sponsor = '';
        $rawSponsor = (string)($center->sponsor_name ?? '');
        if ($rawSponsor !== '') {
            $sponsor = mb_strlen($rawSponsor) > 50
                ? htmlspecialchars(mb_substr($rawSponsor, 0, 47)) . '...'
                : htmlspecialchars($rawSponsor, ENT_QUOTES);
        }

        $centerName = htmlspecialchars((string)($center->center_name ?? ''), ENT_QUOTES);
        $division = htmlspecialchars((string)($center->division ?? ''), ENT_QUOTES);
        $district = htmlspecialchars((string)($center->district ?? ''), ENT_QUOTES);
        $upazila = htmlspecialchars((string)($center->upazila ?? ''), ENT_QUOTES);
        $centerId = (int)$center->id;

        $html .= '<tr>'
            . '<td class="clp-col-sl">' . $sl . '</td>'
            . '<td>' . $centerName . '</td>'
            . '<td>' . $division . '</td>'
            . '<td>' . $district . '</td>'
            . '<td>' . $upazila . '</td>'
            . '<td>' . $startDate . '</td>'
            . '<td><span class="' . $typeClass . '">' . htmlspecialchars($typeLabel, ENT_QUOTES) . '</span></td>'
            . '<td>' . $sponsor . '</td>'
            . '<td class="clp-view-cell"><a class="btn btn-sm btn-primary" href="school-details.php?schoolInfo=' . $centerId . '">' . get_string('view', 'local_centermanagement') . '</a></td>'
            . '</tr>';
        $sl++;
    }

    $html .= '</tbody></table></div>';
    return $html;
}

function local_centermanagement_render_centers_pagination(int $page, int $totalpages, int $total, int $perpage = 20): string {
    $start = $total === 0 ? 0 : (($page - 1) * $perpage) + 1;
    $end = min($page * $perpage, $total);

    if ($totalpages <= 1) {
        return '<div class="sc-pagination-info">Showing ' . $start . '–' . $end . ' of ' . $total
            . ' center' . ($total === 1 ? '' : 's') . '</div>';
    }

    $info = '<div class="sc-pagination-info">Showing ' . $start . '–' . $end . ' of ' . $total
        . ' &middot; Page ' . $page . ' of ' . $totalpages . '</div>';

    $buttons = '<div class="sc-pagination-buttons">';

    $buttons .= '<button type="button" class="sc-page-btn' . ($page <= 1 ? ' is-disabled' : '') . '" data-page="' . ($page - 1) . '"'
        . ($page <= 1 ? ' disabled' : '') . '><span class="material-icons">chevron_left</span></button>';

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

    $buttons .= '<button type="button" class="sc-page-btn' . ($page >= $totalpages ? ' is-disabled' : '') . '" data-page="' . ($page + 1) . '"'
        . ($page >= $totalpages ? ' disabled' : '') . '><span class="material-icons">chevron_right</span></button>';

    $buttons .= '</div>';

    return $info . $buttons;
}

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
