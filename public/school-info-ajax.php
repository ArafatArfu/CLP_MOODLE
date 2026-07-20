<?php
// AJAX endpoint for the dynamic filtering on the public "Your Sponsored
// Center(s)" page (school-info.php).
//
// It reuses the exact same data flow and rendering as the page itself:
//   - center_repository::search_sponsored_centers() (parameterised, SQL-safe)
//   - local_centermanagement_build_centers_data() (shared component markup)
// so the filtered result is byte-for-byte identical to a server render, just
// returned as JSON (table + pagination + meta) for a seamless, no-reload
// refresh. This mirrors the `ajax=1` behaviour of local/clp/program.php.

require_once(__DIR__ . '/config.php');

require_once(__DIR__ . '/local/centermanagement/public_view.php');

$f = [
    'q'           => trim((string)($_GET['q'] ?? '')),
    'district'    => trim((string)($_GET['district'] ?? '')),
    'division'    => trim((string)($_GET['division'] ?? '')),
    'upazila'     => trim((string)($_GET['upazila'] ?? '')),
    'center_type' => trim((string)($_GET['center_type'] ?? '')),
    'support'     => trim((string)($_GET['support'] ?? '')),
    'sort'        => trim((string)($_GET['sort'] ?? 'center_name')),
    'dir'         => strtoupper(trim((string)($_GET['dir'] ?? 'ASC'))) === 'DESC' ? 'DESC' : 'ASC',
];

$page = max(1, (int)($_GET['page'] ?? 1));

header('Content-Type: application/json; charset=utf-8');
echo json_encode(local_centermanagement_build_centers_data($f, $page));
