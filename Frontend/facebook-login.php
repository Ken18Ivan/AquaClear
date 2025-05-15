<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Facebook SDK
include(__DIR__ . '/../Backend/Config/db.php');
session_start();

// Facebook config
$fb = new \Facebook\Facebook([
  'app_id' => '2507544729606394',
  'app_secret' => '577fa6a4ff7fcd21fb2599c9202ea4cf',
  'default_graph_version' => 'v17.0',
]);

$helper = $fb->getRedirectLoginHelper();

try {
  if (!isset($_GET['code'])) {
    $permissions = ['email'];
    $callbackUrl = 'http://localhost/SmartAquaclear/Frontend/facebook-login.php';
    $loginUrl = $helper->getLoginUrl($callbackUrl, $permissions);
    header("Location: " . $loginUrl);
    exit();
  }

  $accessToken = $helper->getAccessToken();

  if (!$accessToken) {
    throw new Exception("Facebook access denied.");
  }

  $response = $fb->get('/me?fields=name,email', $accessToken);
  $userNode = $response->getGraphUser();

  $email = $userNode->getEmail();
  $name = $userNode->getName();
  $username = explode("@", $email)[0];

  // Check if user exists
  $check = $conn->prepare("SELECT user_id FROM User WHERE email = ?");
  $check->bind_param("s", $email);
  $check->execute();
  $check->store_result();

  if ($check->num_rows === 0) {
    $default_pw = hash('sha256', $userNode->getId());
    $stmt = $conn->prepare("INSERT INTO User (username, password, full_name, email, role) VALUES (?, ?, ?, ?, 'operator')");
    $stmt->bind_param("ssss", $username, $default_pw, $name, $email);
    $stmt->execute();
    $stmt->close();
  }

  // Fetch ID for session
  $getUser = $conn->prepare("SELECT user_id FROM User WHERE email = ?");
  $getUser->bind_param("s", $email);
  $getUser->execute();
  $getUser->bind_result($user_id);
  $getUser->fetch();

  $_SESSION['user_id'] = $user_id;
  $_SESSION['username'] = $username;

  header("Location: ../Frontend/pages/dashboard.php");
  exit();

} catch (Exception $e) {
  echo 'Facebook Login Error: ' . $e->getMessage();
}
?>