<?php
namespace controllers;

use components\Pagination;
use components\BaseController;
use models\Category;
use models\Product;

class CatalogController extends BaseController
{
    public function actionIndex($page = 1)
    {
        $products = Product::getProductsByPage($page);
        $total = Product::getTotalProducts();
        $categoriesView = $this->getCategoriesView();

        $pagination = new Pagination(
            $total,
            $page,
            Product::SHOW_BY_DEFAULT,
            'page-'
        );
        $productsView = $this->objView->fetchPartial(
            'product/fetchProducts',
            ['products' => $products]
        );
        $this->objView->render(
            'catalog/index',
            [
                'categoriesView' => $categoriesView,
                'productsView' => $productsView,
                'pagination' => $pagination,
            ]
        );
        return true;
    }

    /**
     * @param int $categoryId
     * @param int $page
     * @return bool
     */
    public function actionCategory(int $categoryId,$page = 1)
    {
        $categories = Category::getCategoriesList();
        $categoryProducts = Product::getProductsListByCategory($categoryId, $page);
        $total = Product::getTotalProductsInCategory($categoryId);

        $pagination = new Pagination(
            $total,
            $page,
            Product::SHOW_BY_DEFAULT,
            'page-'
        );
        $categoriesView = $this->objView->fetchPartial(
            'layouts/category',
            [
                'categories' => $categories,
                'categoryId' => $categoryId,
            ]
        );
        $productsView = $this->objView->fetchPartial(
            'product/fetchProducts',
            ['products' => $categoryProducts]
        );
        $this->objView->render(
            'catalog/category',
            [
                'categoriesView' => $categoriesView,
                'productsView' => $productsView,
                'pagination' => $pagination,
            ]
        );
        return true;
    }
}