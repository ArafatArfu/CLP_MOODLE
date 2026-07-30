<?php
// Temporary debug logging for CSRF verification
// This will be removed after debugging.
function clp_verify_csrf($token) {
    $session_token = $_SESSION['clp_csrf_token'] ?? 'NOT_SET';
    $result = isset($_SESSION['clp_csrf_token']) && hash_equals($_SESSION['clp_csrf_token'], $token);
    file_put_contents('C:/xampp/tmp/clp_csrf_debug.log', date('H:i:s') . " | verify | session=$session_token | submitted=" . substr($token, 0, 16) . "... | result=" . ($result ? 'VALID' : 'INVALID') . "\n", FILE_APPEND);
    return $result;
}
