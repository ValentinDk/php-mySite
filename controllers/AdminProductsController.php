<?php
namespace controllers;

use components\AdminBase;
use components\Pagination;
use models\Product;
use models\Category;

class AdminProductsController extends AdminBase
{
    /**
     * @return bool
     */
    public function actionHidden()
    {
        $categories = Category::getAllCategories();
        $products = Product::getHiddenProducts();

        $categoriesView = $this->objView->fetchPartial(
            'admin/layouts/category',
            ['categories' => $categories]
        );
        $this->objView->render(
            'admin/products/hiddenProducts',
            [
                'categoriesView' => $categoriesView,
                'products' => $products,
            ]
        );
        return true;
    }

    public function actionEdit(int $id)
    {
        $result = false;
        $product = Product::getProductById($id);
        $categories = Category::getCategoriesList();
       
        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования
            $name = $_POST['name'];
            $code = $_POST['code'];
            $price = $_POST['price'];
            $category_id = $_POST['category_id'];
            $brand = $_POST['brand'];
            $availability = $_POST['availability'];
            $description = $_POST['description'];
            $is_new = $_POST['is_new'];
            $is_recommended = $_POST['is_recommended'];
            $status = $_POST['status'];

            Product::edit(
                $product['id'],
                $name,
                $category_id,
                $code,
                $price,
                $availability,
                $brand,
                $description,
                $is_new,
                $is_recommended,
                $status
            );
            Product::setImage($product['id']);

            $result = true;
        }

        $this->objView->render(
            'admin/products/edit',
            [
                'id' => $id,
                'product' => $product,
                'categories' => $categories,
                'result' => $result,
            ]
        );
        return true;
    }

    /**
     * @param $id
     * @return bool
     */
    public function actionDelete(int $id)
    {
        $result = false;
        $product = Product::getProductById($id);

        if (isset($_POST['delete'])) {
            Product::delete($product['id']);
            Product::deleteImage($id);
            $result = true;
            
        } elseif (isset($_POST['undelete'])) {
            header ('Location: /admin');
            exit;
        }
        $this->objView->render(
            'admin/products/delete',
            [
                'result' => $result,
                'product' => $product,
            ]
        );
        return true;
    }

    /**
     * @return bool
     */
    public function actionCreate()
    {
        $result = false;
        $categories = Category::getCategoriesList();

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $code = $_POST['code'];
            $price = $_POST['price'];
            $category_id = $_POST['category_id'];
            $brand = $_POST['brand'];
            $availability = $_POST['availability'];
            $description = $_POST['description'];
            $is_new = $_POST['is_new'];
            $is_recommended = $_POST['is_recommended'];
            $status = $_POST['status'];

            $id = Product::create(
                $name,
                $category_id,
                $code,
                $price,
                $availability,
                $brand,
                $description,
                $is_new,
                $is_recommended,
                $status
            );
            Product::setImage($id);

            $result = true;
        }
        $this->objView->render(
            'admin/products/create',
            [
                'result' => $result,
                'categories' => $categories,
            ]
        );
        return true;
    }
}