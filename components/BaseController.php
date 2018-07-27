<?php
namespace components;

use models\Category;

class BaseController
{
	public $objView;

	public function __construct()
	{
		$this->objView = new View('layouts/main');
	}

	public function getCategoriesView()
    {
        $categories = Category::getCategoriesList();
        return $categoriesView = $this->objView->fetchPartial(
            'layouts/category',
            ['categories' => $categories]
        );
    }
}