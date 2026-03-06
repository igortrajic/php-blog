<?php
require_once __DIR__ . '/../src/Database.php'; 
require_once __DIR__ . '/../src/Posts.php';

$message = "";
$db = Database::getConnection();

$id = $_REQUEST['id'] ?? null; 

if (!$id) {
    die("Error: No ID received. Make sure the Edit link looks like: postEdition.php?id=123");
}

$id = (int)$id;

$post = Post::getPostById($db, $id);

if (!$post) {
    die("Error: Post not found in database.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');

    $imagePath = $post['image']; 

    if (!empty($_FILES['fileToUpload']['name'])) {
        $imagePath = 'uploads/' . basename($_FILES['fileToUpload']['name']);
    }

    if (empty($title) || empty($content)) {
        $message = "Title and content are required!";
        $post['title'] = $title;
        $post['content'] = $content;
    } else {
        $updatedPost = new Post([
            'title' => $title,
            'content' => $content,
            'image' => $imagePath
        ]);

        if (!empty($_FILES['fileToUpload']['name'])) {
            $fileName = $_FILES['fileToUpload']['name'];
            $tmpName = $_FILES['fileToUpload']['tmp_name'];
            $extenstion = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            $allowedExtensions = ['jpg', 'jpeg', 'png'];

            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $realMimeType = $finfo->file($tmpName);
            $allowedMimeTypes =  ['image/jpeg', 'image/png', 'image/jpg'];

            if (!in_array($extension, $allowedExtensions) || !in_array($realMimeType, allowedMimeType)){
                $message = "Error: Invalid image file.";
            } else {
                $imagePath = 'uploads/' . uniqid('post_', true) . '.' . $extension;
            }
        }

        if (empty($title) || empty($content)) {
            $message = "Title and content are required!";
        } elseif ($uploadSuccess) {
            $updatedPost = new Post([
                'title' => $title,
                'content' => $content,
                'image' => $imagePath
            ]);

        if ($imagePath !== $post['image']) {
            $uploadSuccess = $updatedPost->moveFile($_FILES['fileToUpload']['tmp_name']);
        }

        if ($uploadSuccess && $updatedPost->update($db, $id)) {
            header("Location: allPosts.php?message=Updated successfully");
            exit;
        } elseif (!$uploadSuccess) {
            $message = "Failed to move the uploaded image.";
        } else {
            $message = "Database error: Could not save changes.";
        }
        }
    }
}

include 'postEditionView.php';