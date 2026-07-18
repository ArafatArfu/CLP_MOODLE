<?php
$host = '127.0.0.1';
$passwords = ['', 'root', 'xampp', 'password', 'admin', 'mysql', 'test', 'clp', '123456'];

foreach ($passwords as $pwd) {
    try {
        $conn = new mysqli($host, 'root', $pwd);
        if ($conn->connect_error) {
            echo "Failed: root/" . ($pwd === '' ? 'empty' : $pwd) . "\n";
        } else {
            echo "SUCCESS: root/" . ($pwd === '' ? 'empty' : $pwd) . "\n";
            $conn->close();
            exit(0);
        }
    } catch (Exception $e) {
        echo "Failed: root/" . ($pwd === '' ? 'empty' : $pwd) . "\n";
    }
}
echo "No password found\n";
