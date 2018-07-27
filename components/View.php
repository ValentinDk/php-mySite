<?php 
namespace components;
 
class View {

    public $layout;

    public function __construct($layout)
    {
        $this->layout = $layout;
    }
    // Получить отрендеренный шаблон с параметрами $params
    function fetchPartial($template, $params = []){
        extract($params);
        ob_start();
        include(ROOT.'/views/'.$template.'.php');
        return ob_get_clean();
    }
 
    // Вывести отрендеренный шаблон с параметрами $params
    function renderPartial($template, $params = [])
    {
        echo $this->fetchPartial($template, $params);
    }
 
    // Получить отрендеренный шаблон в переменную $content layout-а
    function fetch($template, $params = [])
    {
        $content = $this->fetchPartial($template, $params);
        $layout = $this->layout;
        return $this->fetchPartial($layout, ['content' => $content]);
    }
 
    // Вывести отрендеренный шаблон в переменную $content layout-а
    function render($template, $params = [])
    {
        echo $this->fetch($template, $params);
    }   
}