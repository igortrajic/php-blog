<?php
require_once __DIR__ . '/../src/Database.php'; 
require_once __DIR__ . '/../src/Users.php';

$db = Database::getConnection();

$error = [];

if (empty(trim($_POST['name'])) || empty(trim($_POST['email'])) || empty(trim($_POST['password']))) {
    $error[] = "name,email and password are required";
} else {

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $error[] = "Invalid email format";
};

$pattern = "/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};':\"\\|,.<>\/?]).{8,}$/";

if (!preg_match($pattern, $_POST['password'])){ 
    $error[] = "Your passwork must be at least 8 characters long containing at least one number, one uppercase letter and one special character(#,@,$...)  ";
};
}

if (empty($error)){
    $existingUser = User::getUserByEmail($db, $_POST['email']);
    if (!empty($existingUser)){
    $error[] = "This email is already registered";
} else {
$securePassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
User::CreateUser($db, $_POST['name'], $_POST['email'], $securePassword);
header("Location: loginForm.php");
exit();

}
};

include 'registerView.php';