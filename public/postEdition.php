<?php
require_once __DIR__ . '/../src/Database.php'; 
require_once __DIR__ . '/../src/Posts.php';

$message = "";
$db = Database::getConnection();

$id = $_REQUEST['id'] ?? null; 

$id = (int)$id;

$post = Post::getPostById($db, $id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = filter_var($_POST['title'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $content = filter_var($_POST['content'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);

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
            $updatedPost->moveFile($_FILES['fileToUpload']['tmp_name']);
        }

        if ($updatedPost->update($db, $id)) {
            header("Location: allPosts.php?message=Updated successfully");
            exit;
        } else {
            $message = "Database error: Could not save changes.";
        }
    }
}

include 'postEditionView.php';