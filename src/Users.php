<?php

class User
{

    public static function getUserByEmail(PDO $db, string $email): array|false
    {
        $sql = "SELECT name, email, password, id, role FROM users WHERE email = :email";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function createUser(PDO $db, string $name, string $email, string $password): bool
    {
        $sql  = "INSERT INTO users(name, email, password, role)
            VALUES(:name, :email, :password, 'user')";
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            ':name'     => $name,
            ':email'    => $email,
            ':password' => $password,
        ]);
    }

    public static function getUserById(PDO $db, int $id): array|false
    {
        $sql = "SELECT id, name, email, role FROM users WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function updateProfile(PDO $db, int $id, string $name, string $email): bool
    {
        $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            ':name'  => $name,
            ':email' => $email,
            ':id'    => $id,
        ]);
    }

    public static function updatePassword(PDO $db, int $id, string $hashedPassword): bool
    {
        $sql = "UPDATE users SET password = :password WHERE id = :id";
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            ':password' => $hashedPassword,
            ':id'       => $id,
        ]);
    }
}
