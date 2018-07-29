<?php
namespace controllers;

use components\BaseController;
use models\User;
use models\Product;
use models\Order;

class UserController extends BaseController
{
    public function actionRegister()
    {
        $name = '';
        $email = '';
        $password = '';
        $result = false;
        $user = [];
        $errors = [];

        if (isset($_POST['submit'])) {
            $user['name'] = $_POST['name'];
            $user['email'] = $_POST['email'];
            $user['password'] = $_POST['password'];
            $errors = User::validation($user);
            if (empty($errors)) {
                User::register($user['name'], $user['email'], $user['password']);
                $result = true;
            }
        }
        $this->objView->render(
            'user/register',
            [
                'result' => $result,
                'errors' => $errors,
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ]
        );
        var_dump($errors);
        return true;
    }

    public function actionLogin()
    {
        $email = '';
        $password = '';
        $errors = [];

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            //Проверка существования пользователя
            $user = User::checkUserData($email, $password);
            if (empty($user)) {
                $errors[] = 'Неверные данные';
            } else {
                User::auth($user);

                if (($user['cart']) != "[]") {                
                    $userOrder = json_decode($user['cart'], true);
                    $productsIds = array_keys($userOrder);
                    $orderedProd = Product::getProductsByIds($productsIds);
                    foreach ($orderedProd as $product) {
                        $uptUserOrder[$product["id"]] = $userOrder[$product["id"]];
                    }
                    $_SESSION['products'] =  $uptUserOrder;
                } else {
                    $_SESSION['products'] = [];
                }
                if ($user["role"] == "admin") {
                    header("location: /admin/");
                } else {                    
                    header("Location: /user/");
                }
            }
        }
        $this->objView->render(
            'user/login',
            [
                'errors' => $errors,
                'email' => $email,
                'password' => $password,
            ]
        );
        return true;
    }

    public function actionLogout()
    {
        $userId = $_SESSION['user']['id'];
        $products = json_encode($_SESSION['products']);
        User::saveCart($userId, $products);

        unset($_SESSION['products']);
        unset($_SESSION['user']);
        header("Location: /");

        return true;
    }

    public function actionIndex()
    {
        $user = $_SESSION['user'];

        if(!User::isGuest()) {
            $this->objView->render(
                'cabinet/index',
                ['user' => $user]
            );
        } else {
            header('Location: /user/login');
        }
        return true;
    }

    public function actionEdit()
    {
        $result = false;
        $user = $_SESSION['user'];
        $errors = [];

        $name = $user['name'];
        $password = $user['password'];

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $password= $_POST['password'];
            //Валидация полей
            if (!User::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 2-ух символов';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }
            if (empty($errors)) {
                $_SESSION['user'] = User::edit($user['id'], $name, $password);
                $result = true;
            }
        }
        $this->objView->render(
            'cabinet/edit',
            [
                'result' => $result,
                'errors' => $errors,
                'name' => $name,
                'password' => $password,
            ]
        );
        return true;
    }

    public function actionHistory()
    {
        $user = $_SESSION['user'];
        $orders = Order::getOrderByUserId($user['id']);

        $this->objView->render(
            'cabinet/history',
            [
                'user' => $user,
                'orders' => $orders,
            ]
        );
        return true;
    }
}