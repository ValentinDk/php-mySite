<?php
namespace controllers;

use components\Pagination;
use components\AdminBase;
use models\Category;
use models\Product;

class AdminController extends AdminBase
{
    /**
     * @param int $page
     * @return bool
     */
    public function actionIndex(int $page = 1)
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
                'pagination' => $pagination,
            ]
        );

        return true;
    }
}
