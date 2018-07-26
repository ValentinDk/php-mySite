<?php
namespace controllers;

use models\{Category, Product};
use components\{Pagination, BaseController};

class CatalogController extends BaseController
{
    public function actionIndex($page = 1)
    {

        $categories = Category::getCategoriesList();
        $products = Product::getProductsByPage($page);
        $total = Product::getTotalProducts(); 

        $pagination = new Pagination(
            $total,
            $page,
            Product::SHOW_BY_DEFAULT,
            'page-'
        );

        $categoriesView = $this->objView->fetchPartial(
            'layouts/category',
            ['categories' => $categories]
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
                'pagination' => $pagination
            ]
        );

        return true;
    }

    public function actionCategory($categoryId, $page = 1)
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
                'categoryId' => $categoryId
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
                'pagination' => $pagination
            ]
        );

        return true;
    }
}