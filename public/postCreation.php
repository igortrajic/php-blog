<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../src/Database.php'; 
require_once __DIR__ . '/../src/Posts.php';

$message = ""; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = filter_var($_POST['title'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $title = trim($title);

    $content = filter_var($_POST['content'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $content = trim($content);

    if (empty($title) || empty($content)) {
        $message = "Title and conent are required!";
    } elseif(!isset($_FILES['fileToUpload']) || $_FILES['fileToUpload']['error'] !== UPLOAD_ERR_OK){
        $message = "Please select a valid image!";
    } else {
        $fileName = $_FILES['fileToUpload']['name'];
        $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png'];

        if (!in_array($extension, $allowed)) {
        $message = "Error: Only JPG, JPEG, and PNG files are allowed";
        } else {
            $tmpName   = $_FILES['fileToUpload']['tmp_name'];
            $imagePath = __DIR__ . '/../uploads/' . basename($fileName);

            $post = new Post([
                'title' => $_POST['title'],
                'content' => $_POST['content'],
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