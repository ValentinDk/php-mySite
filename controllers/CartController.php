<?php
namespace controllers;

use models\{Cart, Category, Product, User, Order};
use components\BaseController;

class CartController extends BaseController
{
    public function actionAddAjax($id)
    {
        //Добавляем товар в корзину
        echo Cart::addProduct($id);

        return true;
    }

    public function actionDeleteAjax($id)
    {
        // Удаление товара из корзины
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

    public function actionCheckout()
    {
        // Список категорий для левого меню
        $categories = Category::getCategoriesList();
        // Статус успешного оформления заказа
        $result = false;
        $errors = array();
        $totalQuantity = 0;
        $totalPrice = 0;
        // Если форма отправлена, то считываем данные формы
        if (isset($_POST['submit'])) {

            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];
            // Валидация полей
            if (!User::checkName($userName))
                $errors[] = 'Неправильное имя';
            if (!User::checkPhone($userPhone))
                $errors[] = 'Неправильный телефон';
            // Если форма заполнена корректно, то сохраняем заказ в БД
            if (empty($errors)) {
                // Собираем информацию о заказе
                $productsInCart = Cart::getProducts();
                $productsIds = array_keys($productsInCart);
                $products = Product::getProductsByIds($productsIds);
                $totalPrice = Cart::getTotalPrice($products);
                if (User::isGuest()) {
                    $userId = false;
                } else {
                    $userId = $_SESSION['user']['id'];
                }

                $result = Order::save(
                    $userName,
                    $userPhone,
                    $userComment,
                    $userId,
                    $productsInCart,
                    $totalPrice
                );

                if ($result) {
                    // Оповещаем администратора о новом заказе
                    $adminEmail = 'tarasenok2012@mail.ru';
                    $message = 'http://localhost/admin/orders/index';
                    $subject = 'Новый заказ!';
                    mail($adminEmail, $subject, $message);
                    // Очищаем корзину
                    Cart::clear();
                }
            // Если форма заполнена некорректн, то подводим итоги
            } else {
                $productsInCart = Cart::getProducts();
                $productsIds = array_keys($productsInCart);
                $products = Product::getProductsByIds($productsIds);
                $totalPrice = Cart::getTotalPrice($products);
                $totalQuantity = Cart::countItems();
            }
        // Если форма не отправлена, то получаем данные из корзины
        } else {
            $productsInCart = Cart::getProducts();
            // Если в корзине нет товаров, то отправляем на главную
            if ($productsInCart == false) {   
                header("Location: /");
            // Если в корзине есть товары, то подводим итоги
            } else {
                $productsIds = array_keys($productsInCart);
                $products = Product::getProductsByIds($productsIds);
                $totalPrice = Cart::getTotalPrice($products);
                $totalQuantity = Cart::countItems();

                $userName = false;
                $userPhone = false;
                $userComment = false;

                // Если пользователь не авторизирован, то форма пустая
                if (User::isGuest()) {
                // Если пользователь авторизирован подставляем информацию с БД      
                } else {
                    $userName = $_SESSION['user']['name'];
                }
            }
        }   

    $this->objView->render(
        'cart/checkout', 
        [
            'categories' => $categories,
            'productsInCart' => $productsInCart,
            'result' => $result,
            'totalQuantity' => $totalQuantity,
            'totalPrice' => $totalPrice,
            'errors' => $errors,
            'userName' => $userName,
            'userPhone' => $userPhone,
            'userComment' => $userComment
        ]
    );

    return true;
    }

    private function getPartial()
    {
        $categories = Category::getCategoriesList();
        $products = array();
        $totalPrice = 0;
        // Получаем данные из корзины
        $productsInCart = Cart::getProducts();

        if ($productsInCart) {
            // Получаем полную информацию о товарах
            $productsIds = array_keys($productsInCart);
            $products = Product::getProductsByIds($productsIds);

            // Общая стоимость товара
            $totalPrice = Cart::getTotalPrice($products);

            $tableInCart = $this->objView->fetchPartial(
                'cart/table',
                [
                    'products' => $products,
                    'productsInCart' => $productsInCart,
                    'totalPrice' => $totalPrice
                ]
            );
            $categoriesView = $this->objView->fetchPartial(
                'layouts/category',
                ['categories' => $categories]
            );
            return $this->objView->fetchPartial(
                'cart/index',
                [
                    'categoriesView' => $categoriesView,
                    'productsInCart' => $productsInCart,
                    'tableInCart' => $tableInCart
                ]
            );

        } else {
            $categoriesView = $this->objView->fetchPartial(
                'layouts/category',
                ['categories' => $categories]
            );
            return $this->objView->fetchPartial(
                'cart/emptyCart',
                ['categoriesView' => $categoriesView]
            );
        }
    }
}