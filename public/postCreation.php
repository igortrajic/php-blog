<?php

require_once __DIR__ . '/../src/Database.php'; 
require_once __DIR__ . '/../src/Posts.php';

$message = ""; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = filter_var($_POST['title'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $title = trim($title);


    $content = filter_var($_POST['content'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $content = trim($content);

    if (empty($title) || empty($content)) {
        $message = "Title and content are required!";
    } elseif(!isset($_FILES['fileToUpload']) || $_FILES['fileToUpload']['error'] !== UPLOAD_ERR_OK){
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
                'user_id' => 1
            ]);

            if ($post->moveFile($tmpName)) {
                $db = Database::getConnection();

                if ($post->create($db)) {
                    $message = "Post created successfully!";
                } else {
                    $message = "Error saving post.";
                }
            } else {
                $message = "Failed to upload the image.";
            }
        }
    }
}

include 'postCreationView.php';
?>