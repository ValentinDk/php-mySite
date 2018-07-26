<?php
use components\Router;

ini_set('sendmail_from', 1);

ini_set('display_errors', 1);
error_reporting(E_ALL); 		//Вывод ошибок во время разработки

session_start();

define('ROOT', dirname(__FILE__));
require_once(ROOT.'/components/Autoload.php');

$router = new Router();
$router->run();