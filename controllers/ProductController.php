<?php
namespace controllers;

use models\{Category, Product};
use components\BaseController;

class ProductController extends BaseController
{
    
    public function actionView($productId)
    {   
        $categories = Category::getCategoriesList();
        $product = Product::getProductById($productId);

        $this->objView->render(
        	'product/view',
        	[
        		'categories' => $categories,
        		'product' => $product
        	]
        );

        return true;
    }
}
