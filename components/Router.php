<?php
namespace components;

class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath = ROOT.'/config/routes.php'; //Путь к роуту
        $this->routes = include($routesPath);
    }

    /**
     * @return string
     */
    private function getURI() //Returns request string
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run()
    {
        $uri = $this->getURI(); //Получение строки запроса
        $result = false;
        
        //Проверка наличия такого запроса в routes.php
        foreach ($this->routes as $uriPattern => $path) { 

            //Сравниваем $uriPattern и $uri
            if (preg_match("~^$uriPattern$~", $uri)) {

                //Получение внутреннего путя из внешнего
                $internalRoute=preg_replace("~$uriPattern~", $path, $uri);

                //Определение контроллера и action'а, которые обрабатывают запрос
                $segments=explode('/', $internalRoute);
                
                $controllerName = 'controllers\\'.ucfirst(array_shift($segments).'Controller');
                $actionName = 'action'.ucfirst(array_shift($segments));
                $parameters = $segments;

                //Подключение файла класса-контроллера
                $controllerFile=ROOT.'/controllers/'.$controllerName.'.php';

                if (file_exists($controllerFile)){
                    include_once($controllerFile);
                }

                $controllerObject = new $controllerName;
                $result = call_user_func_array([$controllerObject, $actionName], $parameters);

                if ($result) {
                    break;
                }
            }
        }
        if (!$result) {
            header("HTTP/1.0 404");
            echo "404";
        }
    }
}