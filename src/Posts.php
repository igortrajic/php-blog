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
        $this->userId = 1;
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
}

?>