<?php


require_once __DIR__ . '/../src/Database.php'; 
require_once __DIR__ . '/../src/Posts.php';

try {
    $db = Database::getConnection();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    
    $allPosts = Post::getAllPosts($db);

} catch (Exception $e) {
    $errorMessage = "An error occurred while fetching posts. Please try again later.";
}

include 'allPostsView.php';
?>