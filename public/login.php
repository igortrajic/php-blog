<?php
session_start();
require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../src/Users.php';

$db = Database::getConnection();
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['email'] ?? '');
  $password = $_POST['password'] ?? '';

  $user = User::getUserByEmail($db, $email);

  if (!empty($user)) {
    if (password_verify($password, $user['password'])) {
      session_regenerate_id(true);
      $_SESSION['id'] = $user['id'];
      $_SESSION['name'] = $user['name'];
      header("Location: index.php" );
      exit();
    } else {
      $error = "Invalid email or password";
    }
  } else {
    $error = "Invalid email or password";
  }
}
include "loginView.php";
