<?php

require_once 'flashErrors.php';
require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../src/Posts.php';

$message = "";
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF token validation failed.");
    }
    $title = filter_var($_POST['title'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $title = trim($title);


    $content = filter_var($_POST['content'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $content = trim($content);

    if (empty($title) || empty($content)) {
        $message = "Title and content are required!";
    } elseif (mb_strlen($title) > 100) {
        $message = "Title must be under 100 characters.";
    } elseif (!isset($_FILES['fileToUpload']) || $_FILES['fileToUpload']['error'] !== UPLOAD_ERR_OK) {
        $message = "Please select a valid image!";
    } else {
        $fileName = $_FILES['fileToUpload']['name'];
        $tmpName = $_FILES['fileToUpload']['tmp_name'];

        $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png'];

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $realMimeType = $finfo->file($tmpName);
        $allowedMimeTypes = ['image/jpeg', 'image/png'];

        if (!in_array($extension, $allowedExtensions)) {
            $message = "Error: Invalid file extension.";
        } elseif (!in_array($realMimeType, $allowedMimeTypes)) {
            $message = "Error: File content does not match its extension.";
        } else {
            $imagePath = 'uploads/' . uniqid('post_', true) . '.' . $extension;


            $post = new Post([
                'title' => $title,
                'content' => $content,
                'image' => $imagePath,
                'user_id' => $_SESSION['id'],
                'category_id' => isset($_POST['category_id']) ? (int)$_POST['category_id'] : null,
            ]);

            if ($post->moveFile($tmpName)) {
                $db = Database::getConnection();

                if ($post->create($db)) {
                    $message = "Post created successfully!";
                    set_flash('Post created successfully.', 'success');
                    header("Location: index.php");
                    exit();
                } else {
                    $message = "Error saving post.";
                }
            } else {
                $message = "Failed to upload the image.";
            }
        }
    }
}
$postData = [
    'title'       => $_POST['title'] ?? '',
    'content'     => $_POST['content'] ?? '',
    'category_id' => $_POST['category_id'] ?? '',
];

$categories = Post::getAllCategories(Database::getConnection());
require 'postCreationView.php';
renderPostCreation($postData, $categories, $message);
