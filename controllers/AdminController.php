<?php
namespace controllers;

use components\Pagination;
use components\AdminBase;
use models\Product;

class AdminController extends AdminBase
{
    /**
     * @param int $page
     * @return bool
     */
    public function actionIndex(int $page = 1)
    {

        $products = Product::getProductsByPage($page);
        $total = Product::getTotalProducts();
        $categoriesView = $this->getCategoriesView();

        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');

        $productsView = $this->objView->fetchPartial(
            'admin/products/fetchProducts', 
            ['products' => $products]
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
