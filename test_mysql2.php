<?php
$host = '127.0.0.1';
$users = [
    ['user' => 'root', 'pass' => ''],
    ['user' => 'root', 'pass' => 'root'],
    ['user' => 'root', 'pass' => 'xampp'],
    ['user' => 'root', 'pass' => 'password'],
    ['user' => 'root', 'pass' => 'admin'],
    ['user' => 'root', 'pass' => 'mysql'],
    ['user' => 'root', 'pass' => 'test'],
    ['user' => 'root', 'pass' => 'clp'],
    ['user' => 'root', 'pass' => '123456'],
    ['user' => 'root', 'pass' => 'Clp@123'],
];

foreach ($users as $u) {
    try {
        $conn = new mysqli($host, $u['user'], $u['pass']);
        if ($conn->connect_error) {
            echo "Failed: " . $u['user'] . "/" . ($u['pass'] === '' ? 'empty' : $u['pass']) . "\n";
        } else {
            echo "SUCCESS: " . $u['user'] . "/" . ($u['pass'] === '' ? 'empty' : $u['pass']) . "\n";
            $conn->close();
            exit(0);
        }
    } catch (Exception $e) {
        echo "Failed: " . $u['user'] . "/" . ($u['pass'] === '' ? 'empty' : $u['pass']) . "\n";
    }
}
echo "No password found\n";
