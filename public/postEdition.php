<?php
require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../src/Posts.php';
require_once 'flashErrors.php';


$message = "";
$title   = '';
$content = '';
$errors  = [];
$db = Database::getConnection();

$id = isset($_REQUEST['id']) ? (int)$_REQUEST['id'] : 0;
if ($id <= 0) {
    die("Error: Invalid ID.");
}

$post = Post::getPostById($db, $id);
if (!$post) {
    set_flash("Post not found.", 'error');
    header('Location: allPosts.php');
    exit;
}

if (!isset($_SESSION['id']) || ($_SESSION['id'] != $post['user_id'] && ($_SESSION['role'] ?? '') !== 'admin')) {
    set_flash("You don't have permission to edit that post!", 'error');
    header('Location: allPosts.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF token validation failed.");
    }

    $title     = trim($_POST['title'] ?? '');
    $content   = trim($_POST['content'] ?? '');
    $imagePath = $post['image'];
    $errors    = [];

    if (empty($title) || empty($content)) {
        $errors[] = "Title and content are required.";
    }
    if (mb_strlen($title) > 100) {
        $errors[] = "Title must be under 100 characters.";
    }

    if (!empty($_FILES['fileToUpload']['name']) && empty($errors)) {
        $file      = $_FILES['fileToUpload'];
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        $finfo        = new finfo(FILEINFO_MIME_TYPE);
        $realMimeType = $finfo->file($file['tmp_name']);

        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $allowedMimeTypes  = ['image/jpeg', 'image/png'];

        if (!in_array($extension, $allowedExtensions) || !in_array($realMimeType, $allowedMimeTypes)) {
            $errors[] = "Invalid image file. Only JPG, JPEG, and PNG are allowed.";
        } else {
            $newName     = uniqid('post_', true) . '.' . $extension;
            $destination = 'uploads/' . $newName;

            if (move_uploaded_file($file['tmp_name'], $destination)) {
                $imagePath = $destination;
            } else {
                $errors[] = "File system error: Failed to move uploaded image.";
            }
        }
    }

    if (empty($errors)) {
        $updatedPost = new Post([
            'title'       => $title,
            'content'     => $content,
            'image'       => $imagePath,
            'user_id'     => $post['user_id'],
            'category_id' => isset($_POST['category_id']) ? (int)$_POST['category_id'] : null,
        ]);

        if ($updatedPost->update($db, $id)) {
            set_flash("Post updated successfully.", 'success');
            header("Location: allPosts.php");
            exit;
        } else {
            $message = "Database error: Could not save changes.";
        }
    } else {
        $message = implode(" ", $errors);
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($errors)) {
    $post['title']       = $title;
    $post['content']     = $content;
    $post['category_id'] = !empty($_POST['category_id']) ? (int)$_POST['category_id'] : null;
}

$categories = Post::getAllCategories($db);
require 'postEditionView.php';
renderPostEdition($post, $categories, $message);
