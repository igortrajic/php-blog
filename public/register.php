<?php
require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../src/Users.php';

session_start();

$db = Database::getConnection();

$error = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF token validation failed.");
    }

    if (empty(trim($_POST['name']))) {
        $error[] = "Name is required";
    }
    if (empty(trim($_POST['email']))) {
        $error[] = "Email is required";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error[] = "Invalid email format";
    }

    if (empty($_POST['password'])) {
        $error[] = "Password is required";
    } else {
        //link https://regexr.com/8lf72
        $pattern = "/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};':\"\\|,.<>\/?]).{8,}$/";
        if (!preg_match($pattern, $_POST['password'])) {
            $error[] = "Your password must be at least 8 characters long and contain at least one number, one uppercase letter, and one special character (e.g., !@#$%^&*).";
        }
    }

    if (empty($error)) {
        $existingUser = User::getUserByEmail($db, $_POST['email']);
        if (!empty($existingUser)) {
            $error[] = "This email is already registered";
        } else {
            $securePassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
            User::createUser($db, $_POST['name'], $_POST['email'], $securePassword);
            header("Location: login.php");
            exit();
        }
    }
}

include 'registerView.php';
