<?php
namespace components;

use models\User;

class AdminBase
{
	public $objView;

	public function __construct()
    {
		if (!User::isGuest()){
			//Пользователь залогирован
			if (!User::isAdmin()){
				echo "Недостаточно прав";
				die;	
			} else {
				$this->objView = new View('admin/main');
			}
		} else {
			//Пользователь незалогирован
			header("Location: user/login");
			die;
		}
	}
}