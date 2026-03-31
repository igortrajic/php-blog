<?php

class Post {
    public $title;
    public $image;
    public $content;
    public $userId;

    public function __construct($data) {
        $this->title = $data['title']; 
        $this->content = $data['content'];
        $this->image = $data['image'];
        $this->userId = $data['user_id'] ?? 1;
    }


    public function create($db) {
        $sql = "INSERT INTO posts (title, image, content, user_id)
        VALUES (:title, :image, :content, :user_id)";

        $stmt = $db->prepare($sql);

        return $stmt->execute([
        ':title'   => $this->title,
        ':content' => $this->content,
        ':image'   => $this->image,
        ':user_id' => $this->userId
        ]);
    }

    
    public function moveFile($temporaryPath){
        if (move_uploaded_file($temporaryPath, $this->image)) {
        return true;
    }
    return false;
    }

    public static function getRecentPosts($db, $limit = 3) {
        $sql = "SELECT id, title, image FROM posts ORDER BY id DESC LIMIT :limit";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }

    public static function getAllPosts($db){
        $sql = "SELECT id,title,content,image FROM posts ORDER BY id DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function getPostById($db, $id){
        $sql = "SELECT id, title, content, image,  user_id  FROM posts WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch();

    }

    public function update($db, $id) {
        $sql = "UPDATE posts 
        SET title = :title, content = :content, image = :image 
        WHERE id = :id";

        $stmt = $db->prepare($sql);

        $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
        $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);
        $stmt->bindValue(':image', $this->image, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}

?>