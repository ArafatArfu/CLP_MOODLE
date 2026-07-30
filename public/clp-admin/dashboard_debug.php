<?php
declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
ini_set('log_errors', '1');
error_reporting(E_ALL);

echo '<pre>Dashboard execution started</pre>';
flush();

try {
    echo '<pre>Checkpoint 1: before auth</pre>';
    flush();
    
    require_once __DIR__ . '/includes/auth.php';
    
    echo '<pre>Checkpoint 2: auth loaded</pre>';
    flush();
    
    $page_title = 'Dashboard';
    $admin = clp_get_admin();
    echo '<pre>Checkpoint 3: admin=' . ($admin ? 'set' : 'null') . '</pre>';
    flush();
    
    $db = clp_db_connect();
    echo '<pre>Checkpoint 4: db connected</pre>';
    flush();
    
    $stats = [];
    $result = $db->query("SELECT COUNT(*) as count FROM clp_about_history WHERE status = 'published'");
    echo '<pre>Checkpoint 5: query executed</pre>';
    flush();
    
    echo '<pre>ALL CHECKPOINTS PASSED</pre>';
} catch (Throwable $e) {
    echo '<pre>FATAL ERROR: ' . htmlspecialchars($e->getMessage()) . "\nFile: " . $e->getFile() . "\nLine: " . $e->getLine() . '</pre>';
}

echo '<pre>End of script</pre>';
