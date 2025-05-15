<?php
require_once __DIR__ . '/../vendor/autoload.php';
include(__DIR__ . '/../Backend/Config/db.php');
session_start();


// Google Client config
$client = new Google_Client();
$client->setClientId('932665609081-16upi2mbe8j642bfrcs38046g65rv9hm.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/SmartAquaclear/Frontend/google-login.php');
$client->addScope("email");
$client->addScope("profile");

if (!isset($_GET['code'])) {
    $auth_url = $client->createAuthUrl();
    header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
    exit();
} else {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    $google_oauth = new Google\Service\Oauth2($client);
    $user_info = $google_oauth->userinfo->get();

    $email = $user_info->email;
    $name = $user_info->name;
    $google_id = $user_info->id;
    $username = explode("@", $email)[0]; // use part of email

    // Check if user exists
    $check = $conn->prepare("SELECT user_id FROM User WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows === 0) {
        // Insert new user
        $default_pw = hash('sha256', $google_id); // temp password
        $stmt = $conn->prepare("INSERT INTO User (username, password, full_name, email, role) VALUES (?, ?, ?, ?, 'operator')");
        $stmt->bind_param("ssss", $username, $default_pw, $name, $email);
        $stmt->execute();
        $stmt->close();
    }

    // Fetch user info again for login
    $getUser = $conn->prepare("SELECT user_id FROM User WHERE email = ?");
    $getUser->bind_param("s", $email);
    $getUser->execute();
    $getUser->bind_result($user_id);
    $getUser->fetch();

    $_SESSION['user_id'] = $user_id;
    $_SESSION['username'] = $username;

    header("Location: ../Frontend/pages/dashboard.php");
    exit();
}
?>