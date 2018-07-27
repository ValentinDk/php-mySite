<?php
namespace components;

use models\User;

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
}