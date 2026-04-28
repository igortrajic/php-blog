<?php
session_start();
require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../src/Users.php';
require_once 'flashErrors.php';

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

$db = Database::getConnection();
$errors = [];
$section = '';

$user = User::getUserById($db, (int)$_SESSION['id']);
if (!$user) {
    session_destroy();
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF token validation failed.");
    }

    $section = $_POST['form'] ?? '';

    if ($section === 'profile') {
        $name  = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');

        if (empty($name)) {
            $errors[] = "Name is required.";
        }
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "A valid email is required.";
        }
        if (empty($errors)) {
            $existing = User::getUserByEmail($db, $email);
            if ($existing && (int)$existing['id'] !== (int)$_SESSION['id']) {
                $errors[] = "That email is already in use.";
            }
        }

        if (empty($errors)) {
            if (User::updateProfile($db, (int)$_SESSION['id'], $name, $email)) {
                $_SESSION['name'] = $name;
                $user['name']     = $name;
                $user['email']    = $email;
                set_flash("Profile updated successfully.", 'success');
                header('Location: profile.php');
                exit();
            } else {
                $errors[] = "Could not update profile. Please try again.";
            }
        }
    } elseif ($section === 'password') {
        $current  = $_POST['current_password'] ?? '';
        $new      = $_POST['new_password'] ?? '';
        $confirm  = $_POST['confirm_password'] ?? '';

        $fullUser = User::getUserByEmail($db, $user['email']);

        if (!password_verify($current, $fullUser['password'])) {
            $errors[] = "Current password is incorrect.";
        }
        if (empty($new)) {
            $errors[] = "New password is required.";
        } else {
            //link https://regexr.com/8lf72
            $pattern = "/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};':\"\\|,.<>\/?]).{8,}$/";
            if (!preg_match($pattern, $new)) {
                $errors[] = "Password must be at least 8 characters with one uppercase letter, one number, and one special character.";
            }
        }
        if ($new !== $confirm) {
            $errors[] = "New passwords do not match.";
        }

        if (empty($errors)) {
            $hashed = password_hash($new, PASSWORD_DEFAULT);
            if (User::updatePassword($db, (int)$_SESSION['id'], $hashed)) {
                set_flash("Password updated successfully.", 'success');
                header('Location: profile.php');
                exit();
            } else {
                $errors[] = "Could not update password. Please try again.";
            }
        }
    }
}

require 'profileView.php';
renderProfile($user, $errors, $section);
