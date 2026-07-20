<?php
// AJAX endpoint for the dynamic filtering on the public "Your Sponsored
// Center(s)" page (school-info.php).
//
// It reuses the exact same data flow and rendering as the page itself:
//   - center_repository::get_sponsored_centers() (parameterised, SQL-safe)
//   - local_centermanagement_render_sponsored_tbody() (shared markup)
// so the filtered result is byte-for-byte identical to a server render, just
// without a full page reload. Responds with the <tbody> HTML snippet.

require_once(__DIR__ . '/config.php');

require_once(__DIR__ . '/local/centermanagement/public_view.php');

$search = isset($_GET['query']) ? trim((string) $_GET['query']) : '';
$district = isset($_GET['district']) ? trim((string) $_GET['district']) : '';
$centerType = isset($_GET['center_type']) ? trim((string) $_GET['center_type']) : '';

// Normalise the centre-type filter to the two known values; anything else
// (including an empty string) means "both" and is passed through as ''.
if ($centerType !== '' && !in_array($centerType, ['clc', 'scr'], true)) {
    $centerType = '';
}

try {
    $groups = \local_centermanagement\local\center_repository::get_sponsored_centers($search, $district, $centerType);
} catch (dml_exception $e) {
    $groups = [];
}

echo local_centermanagement_render_sponsored_tbody($groups);
