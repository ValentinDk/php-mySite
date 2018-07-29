<?php
namespace models;

use components\Database;
use components\Errors;

class User
{
    public static function register(string $name, string $email, string $password)
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

     public static function edit(int $id, string $name, string $password)
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

    public static function checkUserData(string $email, string $password)
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

    public static function auth(array $user)
    {
        $_SESSION['user'] = $user;
    }

    public static function checkName(string $name)
    {
        if (!(strlen($name) >= 2)) {
            return 'Имя не должно быть короче 3-ух символов';
        }
    }

    public static function checkPassword(string $password)
    {
        if (!(strlen($password) >= 6)) {
            return 'Пароль должен быть не короче 6-ти символов';
        }
    }

    public static function checkEmail(string $email)
    {
        if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
            return 'Некорректно введён email';
        }
    }

    public static function checkPhone($phone)
    {
        if (strlen($phone) >= 7) {
            return true;
        }
        return false;
    }

    public static function checkEmailExists(string $email)
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

    public static function validation(array $user)
    {
        $errors = [];
        if (isset($user['name'])) {
            $errors[] = User::checkName($user['name']);
        }
        if (isset($user['email'])) {
            if (User::checkEmailExists($user['email'])) {
                $errors[] = 'Такой email уже существует';
            } else {
            $errors[] = User::checkEmail($user['email']);
            }
        }
        if (isset($user['password'])) {
            $errors[] = User::checkPassword($user['password']);
        }
        $result = Errors::checkErrors($errors);
        return $result;
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

    public static function saveCart(int $userId, $products)
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

        $query = $db->query(
            'SELECT * FROM user
             WHERE role = "User"
             ORDER BY name ASC'
        );
        $result = $query->fetchAll();

        return $result;
    }

    public static function delete(int $id)
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