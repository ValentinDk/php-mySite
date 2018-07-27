<?php
namespace controllers;

use components\BaseController;
use models\Category;
use models\Product;

class ProductController extends BaseController
{
    /**
     * @param int $productId
     * @return bool
     */
    public function actionView(int $productId)
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
