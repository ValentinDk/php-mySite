<?php
namespace controllers;

use components\BaseController;
use models\Cart;
use models\Category;
use models\Product;
use models\User;
use models\Order;

class CartController extends BaseController
{
    public function actionAddAjax(int $id)
    {
        echo Cart::addProduct($id);

        return true;
    }

    public function actionDeleteAjax(int $id)
    {
        Cart::deleteProduct($id);
        echo $this->getPartial();

        return true;
    }   

    public function actionIndex()
    {
        $content = $this->getPartial();
        $this->objView->renderPartial(
            'layouts/main', 
            ['content' => $content]
        );

        return true;
    }

    private function validation(string $userName, string $userPhone)
    {
        $errors = [];
        if (!User::checkName($userName))
            $errors[] = 'Неправильное имя';
        if (!User::checkPhone($userPhone))
            $errors[] = 'Неправильный телефон';
        return $errors;
    }

    private function saveOrder(
        string $userName,
        string $userPhone,
        string $userComment,
        array $productsInCart,
        float $totalPrice
    )
    {
        if (User::isGuest()) {
            $userId = false;
        } else {
            $userId = $_SESSION['user']['id'];
        }
        Order::save($userName, $userPhone, $userComment, $userId, $productsInCart, $totalPrice);
        return true;
    }

    private function sendMessageAdmin(boolean $result)
    {
        if ($result) {
            $adminEmail = 'tarasenok2012@mail.ru';
            $message = 'http://localhost/admin/orders/index';
            $subject = 'Новый заказ!';
            mail($adminEmail, $subject, $message);
            Cart::clear();
        }
    }

    private function workWithForm(string $userName, string $userPhone, string $userComment, array $errors)
    {
        if (empty($errors)) {
            $productsInCart = Cart::getProducts();
            $totalPrice = $this->getPrice();
            $result = $this->saveOrder($userName, $userPhone, $userComment, $productsInCart, $totalPrice);
            $this->sendMessageAdmin($result);
            return true;
        }
    }

    private function getName()
    {
        if (!User::isGuest()) {
            $userName = $_SESSION['user']['name'];
        } else {
            $userName = false;
        }
        return $userName;
    }

    private function getPrice()
    {
        $productsInCart = Cart::getProducts();
        $productsIds = array_keys($productsInCart);
        $products = Product::getProductsByIds($productsIds);
        $totalPrice = Cart::getTotalPrice($products);
        return $totalPrice;
    }

    public function actionCheckout()
    {
        $categories = Category::getCategoriesList();
        $totalPrice = $this->getPrice();
        $totalQuantity = Cart::countItems();
        $result = false;
        $errors = [];

        if (isset($_POST['submit'])) {
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];
            $errors = $this->validation($userName, $userPhone);
            $result = $this->workWithForm($userName, $userPhone, $userComment, $errors);
        } else {
            $userName = $this->getName();
        }
        $this->objView->render(
        'cart/checkout', 
            [
                'categories' => $categories,
                'result' => $result,
                'totalQuantity' => $totalQuantity,
                'totalPrice' => $totalPrice,
                'errors' => $errors,
                'userName' => $userName,
            ]
        );
        return true;
    }

    private function getPartial()
    {
        $productsInCart = Cart::getProducts();
        $categoriesView = $this->getCategoriesView();

        if ($productsInCart) {
            $productsIds = array_keys($productsInCart);
            $products = Product::getProductsByIds($productsIds);
            $totalPrice = Cart::getTotalPrice($products);
            $tableInCart = $this->objView->fetchPartial(
                'cart/table',
                [
                    'products' => $products,
                    'productsInCart' => $productsInCart,
                    'totalPrice' => $totalPrice,
                ]
            );
            return $this->objView->fetchPartial(
                'cart/index',
                [
                    'categoriesView' => $categoriesView,
                    'productsInCart' => $productsInCart,
                    'tableInCart' => $tableInCart,
                ]
            );
        } else {
            return $this->objView->fetchPartial(
                'cart/emptyCart',
                ['categoriesView' => $categoriesView]
            );
        }
    }
}