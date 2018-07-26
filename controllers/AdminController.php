<?php
namespace controllers;

use models\{Category, Product};
use components\{Pagination, AdminBase};

class AdminController extends AdminBase
{
    public function actionIndex($page = 1)
    {
        $categories = Category::getAllCategories();
        $products = Product::getProductsByPage($page);
        $total = Product::getTotalProducts();

        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');

        $productsView = $this->objView->fetchPartial(
            'admin/products/fetchProducts', 
            ['products' => $products]
        );
        $categoriesView = $this->objView->fetchPartial(
            'admin/layouts/category',
            ['categories' => $categories]
        );
        $this->objView->render(
            'admin/index',
            [
                'categoriesView' => $categoriesView,
                'productsView' => $productsView,
                'pagination' => $pagination
            ]
        );      

        return true;
    }
}
