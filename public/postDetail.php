<?php
session_start();
require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../src/Posts.php';

$db = Database::getConnection();
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$post = Post::getPostById($db, $id);

if (!$post) {
    http_response_code(404);
    echo "Post not found.";
    exit;
}

require 'postDetailView.php';
renderPostDetail($post);