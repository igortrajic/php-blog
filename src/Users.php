<?php

class User {

public static function getUserByEmail($db, $email){
    $sql = "SELECT name,email, password FROM users WHERE email = :email ";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->execute();

    return $stmt->fetch();

}
public static function CreateUser($db, $name, $email, $password){
    $sql  = "INSERT INTO users(name,email,password)
            VALUES(:name,:email,:password)";
    $stmt = $db->prepare($sql);
    return $stmt->execute([
        ':name'   => $name,
        ':email' => $email,
        ':password'   => $password,
        ]);

}
}