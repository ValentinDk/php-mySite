<?php
namespace components;

use models\User;
use models\Category;

class AdminBase
{
	public $objView;

	public function __construct()
    {
		if (!User::isGuest()){
			if (!User::isAdmin()){
				echo "Недостаточно прав";
				die;	
			} else {
				$this->objView = new View('admin/main');
			}
		} else {
			header("Location: user/login");
			die;
		}
	}

    public function getCategoriesView()
    {
        $categories = Category::getAllCategories();
        return $categoriesView = $this->objView->fetchPartial(
            'admin/layouts/category',
            ['categories' => $categories]
        );
    }
}