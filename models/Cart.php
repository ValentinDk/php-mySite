<?php
namespace models;

class Cart
{

    public static function addProduct($id)
    {
        $id = intval($id);

        // Пустой массив для товаров в корзине
        $productsInCart = array();

        // Если в корзине уже есть товары
        if (isset($_SESSION['products'])) {
            // То заполним массив товарами
            $productsInCart = $_SESSION['products'];
        }

        // Увеличение кол-ва, если товар добавлен повторно
        if (array_key_exists($id, $productsInCart)) {
            $productsInCart[$id] ++;
        } else {
            // Добавление нового товара
            $productsInCart[$id] = 1;
        }

        $_SESSION['products'] = $productsInCart;

        return self::countItems();
    }

    public static function deleteProduct($id)
    {
        $id = intval($id);
        // Если в корзине уже есть товары
        if (isset($_SESSION['products'])) {
            // То заполним массив товарами
            $productsInCart = $_SESSION['products'];
        }

        // Уменьшение товара, если его больше, чем 1
        if (array_key_exists($id, $productsInCart)) {
            $productsInCart[$id] --;
        } else {
            // Удаление
            $productsInCart[$id] = 0;
        }
        if ($productsInCart[$id] == 0) {
            unset($productsInCart[$id]);
        }

        $_SESSION['products'] = $productsInCart;

        return self::countItems();
    }

    // Подсчёт кол-ва товаров в корзине
    public static function countItems()
    {
        if (isset($_SESSION['products'])) {
            $count = 0;
            foreach ($_SESSION['products'] as $id => $quantity) {
                $count = $count + $quantity;
            }
            return $count;
        } else {
            return 0;
        }
    }

    public static function getProducts()
    {
        if (isset($_SESSION['products'])) {
            return $_SESSION['products'];
        }
        return false;
    }

    public static function getTotalPrice($products)
    {
        $productsInCart = self::getProducts();

        $total = 0;

        if ($productsInCart) {
            foreach ($products as $item) {
                $total += $item['price'] * $productsInCart[$item['id']];
            }
        }
        return $total;
    }

    public static function getAdminTotalPrice($products, $userProducts)
    {
        $total = 0;

        if ($userProducts) {
            foreach ($products as $item) {
                $total += $item['price'] * $userProducts[$item['id']];
            }
        }
        return $total;
    }

    public static function clear()
    {
        if (isset($_SESSION['products'])) {
            unset($_SESSION['products']);
            $_SESSION['products'] = array();
        }
    }
}