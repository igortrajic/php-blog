<?php
session_start();
require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../src/Posts.php';
require_once 'flashErrors.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit();
}

if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("CSRF token validation failed.");
}

if (!isset($_SESSION['id'])) {
    set_flash("You must be logged in.", 'error');
    header('Location: login.php');
    exit();
}

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
if ($id <= 0) {
    set_flash("Invalid post.", 'error');
    header('Location: allPosts.php');
    exit();
}

$db = Database::getConnection();
$post = Post::getPostById($db, $id);

if (!$post) {
    set_flash("Post not found.", 'error');
    header('Location: allPosts.php');
    exit();
}

if ($_SESSION['id'] != $post['user_id'] && ($_SESSION['role'] ?? '') !== 'admin') {
    set_flash("You don't have permission to delete that post.", 'error');
    header('Location: allPosts.php');
    exit();
}

if (Post::delete($db, $id)) {
    set_flash("Post deleted successfully.", 'success');
} else {
    set_flash("Failed to delete the post.", 'error');
}

header('Location: allPosts.php');
exit();