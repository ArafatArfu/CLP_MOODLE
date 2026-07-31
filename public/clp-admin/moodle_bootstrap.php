<?php
// CLP Admin Panel - Moodle Bootstrap
// Loads Moodle core so admin pages can use $DB, $USER, File API, etc.

if (defined('MOODLE_INTERNAL')) {
    return;
}

// Preserve CLP admin session data before Moodle initializes its session.
$clp_session_backup = [];
foreach ($_SESSION as $key => $value) {
    if (str_starts_with($key, 'clp_')) {
        $clp_session_backup[$key] = $value;
    }
}
$clp_session_id = session_id();

$autoloader = __DIR__ . '/../../vendor/autoload.php';
if (file_exists($autoloader)) {
    require_once $autoloader;
}

require_once __DIR__ . '/../../config.php';

if (!defined('MOODLE_INTERNAL')) {
    define('MOODLE_INTERNAL', true);
}

// Restore CLP admin session data after Moodle has set up its session globals.
// If Moodle regenerated the session ID, the old session data may be lost,
// so we restore from the saved copy.
foreach ($clp_session_backup as $key => $value) {
    $_SESSION[$key] = $value;
}

// Import globals
global $DB, $USER, $CFG, $SESSION, $PAGE, $OUTPUT, $FULLME;
