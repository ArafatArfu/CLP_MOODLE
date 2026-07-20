<?php
// Reusable rendering helper for the public "Your Sponsored Center(s)" page
// (school-info.php) and its AJAX filter endpoint (school-info-ajax.php).
//
// This keeps the table body markup in a single place so the initial server
// render and the dynamic AJAX refresh stay 100% consistent (no duplicated
// markup). The function only renders the <tbody> contents; callers wrap it
// inside a <table>.

use local_centermanagement\local\center_repository;

defined('MOODLE_INTERNAL') || define('MOODLE_INTERNAL', true);

/**
 * Render the sponsored-centre table body for a set of district groups.
 *
 * @param array $groups Associative array district => list of centre records,
 *                       exactly as returned by
 *                       center_repository::get_sponsored_centers().
 * @return string HTML <tbody> element (with id="centers-tbody") containing the
 *                district headers and centre rows.
 */
function local_centermanagement_render_sponsored_tbody(array $groups): string {
    $green = "#47c9a2";
    $lightGreen = "#b4f1df";

    if (empty($groups)) {
        return '<tbody id="centers-tbody">'
            . '<tr><td colspan="7" class="text-center">No centers found.</td></tr>'
            . '</tbody>';
    }

    $sl = 1;
    $html = '<tbody id="centers-tbody">';

    foreach ($groups as $districtName => $schools) {
        $html .= '<tr>'
            . '<td colspan="7" class="text-center bg-warning district">'
            . htmlspecialchars($districtName, ENT_QUOTES)
            . '</td></tr>';

        foreach ($schools as $center) {
            $support = strtolower((string) ($center->support ?? ''));
            if (in_array($support, ['maintained', 'activated', 'supported'])) {
                $rowColor = $green;
            } elseif ($support === 'reactivated') {
                $rowColor = $lightGreen;
            } else {
                $rowColor = '#FFF';
            }

            $isClc = strtolower($center->center_type ?? 'clc') === 'clc';
            $typeLabel = $isClc ? 'Computer Literacy Center' : 'Smart Classroom';

            $startDate = !empty($center->start_date) ? date('Y F', $center->start_date) : '';

            $html .= '<tr style="background-color:' . $rowColor . '">'
                . '<td>' . $sl . '</td>'
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

    $html .= '</tbody>';

    return $html;
}
