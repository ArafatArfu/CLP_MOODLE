<?php
$passwords = ['root', 'xampp', 'password', 'admin', ''];
$host = '127.0.0.1';
$found = false;
foreach ($passwords as $pwd) {
    try {
        $conn = new mysqli($host, 'root', $pwd);
        if ($conn->connect_error) {
            echo 'Failed with: ' . ($pwd === '' ? 'empty' : $pwd) . PHP_EOL;
        } else {
            echo 'SUCCESS! Password: ' . ($pwd === '' ? 'empty' : $pwd) . PHP_EOL;
            $conn->close();
            $found = true;
            break;
        }
    } catch (Exception $e) {
        echo 'Failed with: ' . ($pwd === '' ? 'empty' : $pwd) . PHP_EOL;
    }
}
if (!$found) {
    echo 'Could not find root password' . PHP_EOL;
}
