<?php
require_once __DIR__ . '/../src/Database.php'; 
require_once __DIR__ . '/../src/Posts.php';

try {
    $db = Database::getConnection();

    $recentPosts = Post::getRecentPosts($db, 3);

} catch (Exception $e) {
    $recentPosts = [];
    $errorMessage = "Could not load recent posts.";
}

include 'indexView.php';
?>