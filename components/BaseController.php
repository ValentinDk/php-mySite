<?php
namespace components;

class BaseController
{
	public $objView;

	public function __construct()
	{
		$this->objView = new View('layouts/main');
	}
}