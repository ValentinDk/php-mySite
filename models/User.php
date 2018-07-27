<?php
namespace models;

use components\Database;

class User
{
    public static function register($name, $email, $password)
    {
        $db = Database::getConnection();

        $query = $db->prepare(
            'INSERT INTO user (name, email, password)
            VALUES (:name, :email, :password)'
        );
        $query->execute(
            [
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ]
        );

        $result = $query->fetch();
        
        return $result;
    }

     public static function edit($id, $name, $password)
    {
        $db = Database::getConnection();

        $query = $db->prepare(
            'UPDATE user
            SET name = :name, password = :password
            WHERE id = :id'
        );
        $query->execute(
            [
                'id' => $id,
                'name' => $name,
                'password' => $password,
            ]
        );
        $result = self::getUserById($id);
        
        return $result;
    }

    public static function checkUserData($email, $password)
    {
        $db = Database::getConnection();

        $query = $db->prepare(
            'SELECT * FROM user
            WHERE email = :email AND password = :password'
        );
        $query->execute(
            [
                'email' => $email,
                'password' => $password,
            ]
        );
        $user = $query->fetch();

        if($user) {
            return $user;
        }
        return false;
    }

    public static function auth($user)
    {
        $_SESSION['user'] = $user;
    }

    public static function checkName($name)
    {
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }

    public static function checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }

    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public static function checkPhone($phone)
    {
        if (strlen($phone) >= 7) {
            return true;
        }
        return false;
    }

    public static function checkEmailExists($email)
    {
        $db = Database::getConnection();

        $result = $db -> prepare(
            'SELECT COUNT(*) FROM user
             WHERE email = :email'
         );
        $result->execute(
            ['email' => $email]
        );

        if ($result -> fetchColumn()) {
            return true;
        }
        return false;
    }

    public static function isGuest()
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }

    public static function isAdmin()
    {
        if ($_SESSION['user']['role'] == 'admin') {
            return true;   
        }
        return false;
    }

    public static function getUserById(int $userId)
    {
        $id = intval($userId);

        if ($id) {
            $db = Database::getConnection();
            
            $query = $db->prepare(
                'SELECT * FROM user
                WHERE id = :id'
            );
            $query->execute(
                ['id' => $id]
            );
            $result = $query->fetch();

            return $result;
        }
    }

    public static function saveCart($userId, $products)
    {
        $db = Database::getConnection();
        $query = $db->prepare(
            'UPDATE user
             SET cart = :products
             WHERE id = :userId'
         );
        $query->execute(
            [
                'products' => $products,
                'userId' => $userId,
            ]
        );

        return $result = $query->fetch();
    }

    public static function getAllUser()
    {
        $db = Database::getConnection();

        $result = [];

        $query = $db->query(
            'SELECT * FROM user
             WHERE role = "User"
             ORDER BY name ASC'
        );
        $result = $query->fetchAll();

        return $result;
    }

    public static function delete($id)
    {
        $db = Database::getConnection();

        $query = $db->prepare(
            'DELETE FROM user
             WHERE id = :id'
        );
        $query->execute(
            ['id' => $id]
        );
        return $result = true;
    }
}