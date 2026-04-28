<?php
session_start();
require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../src/Users.php';
require_once 'flashErrors.php';

$db = Database::getConnection();
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("CSRF token validation failed.");
  }
  $email = trim($_POST['email'] ?? '');
  $password = $_POST['password'] ?? '';

  $user = User::getUserByEmail($db, $email);

  if (!empty($user)) {
    if (password_verify($password, $user['password'])) {
      session_regenerate_id(true);
      $_SESSION['id'] = $user['id'];
      $_SESSION['name'] = $user['name'];
      $_SESSION['role'] = $user['role'];
      set_flash('You have been logged in successfully.', 'success');
      header("Location: index.php");
      exit();
    } else {
      $error = "Invalid email or password";
    }
  } else {
    $error = "Invalid email or password";
  }
}
include "loginView.php";
