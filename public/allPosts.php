<?php
require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../src/Posts.php';
require_once 'flashErrors.php';

$selectedCategory = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;
$categories = [];
$allPosts = [];
$errorMessage = '';

try {
    $db = Database::getConnection();

    $categories = Post::getAllCategories($db);

    if ($selectedCategory > 0) {
        $allPosts = Post::getPostsByCategory($db, $selectedCategory);
    } else {
        $allPosts = Post::getAllPosts($db);
    }
} catch (Exception $e) {
    $errorMessage = "An error occurred while fetching posts. Please try again later.";
}

require 'allPostsView.php';
renderAllPosts($allPosts, $categories, $selectedCategory, $errorMessage ?? '');
