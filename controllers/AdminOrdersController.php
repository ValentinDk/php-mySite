<?php
namespace controllers;

use components\AdminBase;
use models\Order;
use models\Cart;
use models\Product;

class AdminOrdersController extends AdminBase
{
    public function actionIndex()
    {
        $orders = Order::getAllOrders();

        $this->objView->render(
            'admin/orders/index',
            ['orders' => $orders]
        );
        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function actionDelete(int $id)
    {
        $result = false;
        $order = Order::getOrderById($id);

        if (isset($_POST['delete'])) {
            Order::delete($id);
            $result = true;
        } elseif (isset($_POST['undelete'])) {
            header('Location: /admin');
        }
        $this->objView->render(
            '/admin/orders/delete',
            [
                'result' => $result,
                'order' => $order,
            ]
        );
        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function actionView(int $id)
    {
        $order = Order::getOrderById($id);
        $productsInCart = Cart::getProducts();
        $userProducts = json_decode($order['products'], true);
        $productsIds = array_keys($userProducts);
        $products = Product::getProductsByIds($productsIds);
        $totalPrice = Cart::getAdminTotalPrice($products, $userProducts);
        $totalQuantity = Cart::countItems();

        $this->objView->render(
            '/admin/orders/order',
            [
                'order' => $order,
                'products' => $products,
                'userProducts' => $userProducts,
                'totalPrice' => $totalPrice,
            ]
        );
        return true;
    }
}