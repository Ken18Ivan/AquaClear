<?php
session_start();
include(__DIR__ . '/../Config/db.php');

$email = $_POST['email'];
$password = hash('sha256', $_POST['password']);

$stmt = $conn->prepare("SELECT user_id, username FROM User WHERE email = ? AND password = ?");
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($user_id, $username);
    $stmt->fetch();
    $_SESSION['user_id'] = $user_id;
    $_SESSION['username'] = $username;
    header("Location: ../../Frontend/pages/dashboard.php");
} else {
    header("Location: ../../Frontend/login.html?status=login_failed");
}
exit();
?>
