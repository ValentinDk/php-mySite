<?php
namespace controllers;

use components\BaseController;
use models\Product;

class ProductController extends BaseController
{
    /**
     * @param int $productId
     * @return bool
     */
    public function actionView(int $productId)
    {
        $categoriesView = $this->getCategoriesView();
        $product = Product::getProductById($productId);

        $this->objView->render(
        	'product/view',
        	[
                'categoriesView' => $categoriesView,
        		'product' => $product,
        	]
        );
        return true;
    }
}
