<?php
// Backend/Config/db.php

$host = '127.0.0.1:3307'; // your MySQL host, e.g., localhost or
$user   = 'root';
$pass   = ''; // your MySQL password
$dbname = 'smart_aquaclear';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    header('Content-Type: application/json', true, 500);
    echo json_encode([
        'success' => false,
        'message' => 'Database connection failed: ' . $conn->connect_error
    ]);
    exit();
}
$conn->set_charset('utf8mb4');
?>
