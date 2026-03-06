<?php 
require_once __DIR__ . '/../src/Database.php'; 
require_once __DIR__ . '/../src/Posts.php';

$db = Database::getConnection();
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0; 

$post = Post::getPostById($db, $id); 

if (!$post) {
    die("Post not found."); 
}

include 'postDetailView.php';
?>