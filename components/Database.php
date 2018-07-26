<?php
namespace components;

class Database
{
	public static function getConnection()
	{
		$paramsPath = ROOT.'/config/db_params.php';
		$params = include($paramsPath);

		$db = new \PDO("mysql:host={$params['host']}; dbname={$params['dbname']}", $params['user'], $params['password'], $params['options']);
		$db -> exec("set names utf8");

		return $db;

	}
}