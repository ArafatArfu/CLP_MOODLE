<?php
$passwords = ['', 'root', 'xampp', 'password', 'admin', 'mysql', 'test'];
$host = '127.0.0.1';
$found = false;
foreach ($passwords as $pwd) {
    try {
        $conn = new mysqli($host, 'root', $pwd);
        if ($conn->connect_error) {
            echo "Failed with: " . ($pwd === '' ? 'empty' : $pwd) . "\n";
        } else {
            echo "SUCCESS! Password: " . ($pwd === '' ? 'empty' : $pwd) . "\n";
            $conn->close();
            $found = true;
            break;
        }
    } catch (Exception $e) {
        echo "Failed with: " . ($pwd === '' ? 'empty' : $pwd) . "\n";
    }
}
if (!$found) {
    echo "Could not find root password\n";
}
