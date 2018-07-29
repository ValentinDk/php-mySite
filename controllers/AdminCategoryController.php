<?php
namespace controllers;

use components\AdminBase;
use models\Category;
use models\Product;

class AdminCategoryController extends AdminBase
{
    /**
     * @param int $categoryId
     * @param int $page
     * @return bool
     */
    public function actionIndex(int $categoryId, $page = 1)
    {
        $categories = Category::getAllCategories();
        $categoryProducts = Product::getProductsListByCategory($categoryId, $page);

        $categoriesView = $this->objView->fetchPartial(
            'admin/layouts/category',
        	[
                'categories' => $categories,
                'categoryId' => $categoryId,
            ]
        );
        $productsView = $this->objView->fetchPartial(
            'admin/products/fetchProducts',
        	['products' => $categoryProducts]
        );
        $this->objView->render(
            'admin/catalog/category',
        	[
        		'categoriesView' => $categoriesView,
                'productsView' => $productsView,
            ]
        );
        return true;
    }

    /**
     * @param int $categoryId
     * @return bool
     */
    public function actionEdit(int $categoryId)
    {
        $result = false;
        $categories = Category::getCategoryById($categoryId);

        if (isset($_POST['submit'])) {
           $name = $_POST['name'];
           $sort_order = $_POST['sort_order'];
           $status = $_POST['status'];

            Category::edit(
                $categories['id'],
                $name,
                $sort_order,
                $status
            );
            $result = true;
        }
        $this->objView->render(
            'admin/catalog/edit',
            [
                'result' => $result,
                'categories' => $categories,
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

        if (isset($_POST['submit'])) {
           $name = $_POST['name'];
           $sort_order = $_POST['sort_order'];
           $status = $_POST['status'];

            Category::create(
                $name,
                $sort_order,
                $status
            );
            $result = true;
        }
        $this->objView->render(
            'admin/catalog/create',
            ['result' => $result]
        );
        return true;
    }

    /**
     * @param int $categoryId
     * @return bool
     */
    public function actionDelete(int $categoryId)
    {
        $result = false;
        $categories = Category::getCategoryById($categoryId);

        if (isset($_POST['delete'])) {
            Category::delete($categoryId);
            $result = true;
        } elseif (isset($_POST['undelete'])) {
            header ('Location: /admin');
            exit;
        }
        $this->objView->render(
            'admin/catalog/delete',
            [
                'result' => $result,
                'categories' => $categories,
            ]
        );
        return true; 
    }
}