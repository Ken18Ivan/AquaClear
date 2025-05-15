<?php
require_once __DIR__ . '/../config/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // only allow POST
    header("Location: ../SmartAquaclear/Frontend/signup1.php");
    exit();
}

$username  = trim($_POST['username']);
$email     = trim($_POST['email']);
$password  = $_POST['password'];
$pw_hash   = password_hash($password, PASSWORD_DEFAULT);

// 1) Check for existing email or username
$chk = $conn->prepare("SELECT user_id FROM User WHERE email = ? OR username = ?");
$chk->bind_param("ss", $email, $username);
$chk->execute();
$chk->store_result();

if ($chk->num_rows > 0) {
    // already exists
    header("Location: /SmartAquaclear/Frontend/signup1.php?status=exists");
    exit();
}

// 2) Insert new user
$ins = $conn->prepare("
    INSERT INTO User (username, password, full_name, email, role)
    VALUES (?, ?, ?, ?, 'operator')
");
$full_name = trim($_POST['full_name']);
$ins->bind_param("ssss", $username, $pw_hash, $full_name, $email);

if ($ins->execute()) {
    header("Location: /SmartAquaclear/Frontend/signup1.php?status=success");
} else {
    header("Location: /SmartAquaclear/Frontend/signup1.php?status=error");
}
exit();
?>
