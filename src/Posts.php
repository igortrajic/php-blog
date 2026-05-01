<?php

class Post
{
    public string $title;
    public string $image;
    public string $content;
    public int $userId;
    public ?int $categoryId;

    public function __construct(array $data)
    {
        $this->title   = $data['title'];
        $this->content = $data['content'];
        $this->image   = $data['image'];
        $this->userId  = $data['user_id'] ?? 1;
        $this->categoryId = isset($data['category_id']) ? (int)$data['category_id'] : null;
    }

    public function create(PDO $db): bool
    {
        $sql = "INSERT INTO posts (title, image, content, user_id, category_id)
            VALUES (:title, :image, :content, :user_id, :category_id)";
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            ':title'       => $this->title,
            ':content'     => $this->content,
            ':image'       => $this->image,
            ':user_id'     => $this->userId,
            ':category_id' => $this->categoryId,
        ]);
    }

    public function moveFile(string $temporaryPath): bool
    {
        if (move_uploaded_file($temporaryPath, $this->image)) {
            return true;
        }
        return false;
    }

    public static function getAllCategories(PDO $db): array
    {
        $stmt = $db->prepare("SELECT id, name FROM categories ORDER BY name ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public static function getRecentPosts(PDO $db, int $limit = 3): array
    {
        $sql = "SELECT posts.id, posts.title, posts.image, categories.name AS category_name
            FROM posts
            LEFT JOIN categories ON posts.category_id = categories.id
            ORDER BY posts.id DESC LIMIT :limit";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function getAllPosts(PDO $db): array
    {
        $sql = "SELECT posts.id, posts.title, posts.content, posts.image, categories.name AS category_name
            FROM posts
            LEFT JOIN categories ON posts.category_id = categories.id
            ORDER BY posts.id DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function getPostById(PDO $db, int $id): array|false
    {
        $sql = "SELECT posts.id, posts.title, posts.content, posts.image, posts.user_id, posts.category_id,
                   posts.created_at, categories.name AS category_name, users.name AS author_name
            FROM posts
            LEFT JOIN categories ON posts.category_id = categories.id
            LEFT JOIN users ON posts.user_id = users.id
            WHERE posts.id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function update(PDO $db, int $id): bool
    {
        $sql = "UPDATE posts
            SET title = :title, content = :content, image = :image, category_id = :category_id
            WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':title',       $this->title,      PDO::PARAM_STR);
        $stmt->bindValue(':content',     $this->content,    PDO::PARAM_STR);
        $stmt->bindValue(':image',       $this->image,      PDO::PARAM_STR);
        $stmt->bindValue(':category_id', $this->categoryId, $this->categoryId === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindValue(':id',          $id,               PDO::PARAM_INT);
        return $stmt->execute();
    }

    public static function delete(PDO $db, int $id): bool
    {
        $sql = "DELETE FROM posts WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public static function getPostsByCategory(PDO $db, int $categoryId): array
    {
        $sql = "SELECT posts.id, posts.title, posts.content, posts.image, categories.name AS category_name
            FROM posts
            LEFT JOIN categories ON posts.category_id = categories.id
            WHERE posts.category_id = :category_id
            ORDER BY posts.id DESC";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
