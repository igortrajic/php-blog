<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../src/Database.php'; 
require_once __DIR__ . '/../src/Posts.php';

try {
    $db = Database::getConnection();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    
    $allPosts = Post::getAllPosts($db);

} catch (Exception $e) {
    $allPosts = [];
    $errorMessage = "Database Error: " . $e->getMessage(); 
}

include 'allPostsView.php';
?>