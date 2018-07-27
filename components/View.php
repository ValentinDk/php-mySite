<?php 
namespace components;
 
class View {

    public $layout;

    public function __construct($layout)
    {
        $this->layout = $layout;
    }
    // получить отрендеренный шаблон с параметрами $params
    function fetchPartial($template, $params = []){
        extract($params);
        ob_start();
        include(ROOT.'/views/'.$template.'.php');
        return ob_get_clean();
    }
 
    // вывести отрендеренный шаблон с параметрами $params
    function renderPartial($template, $params = [])
    {
        echo $this->fetchPartial($template, $params);
    }
 
    // получить отрендеренный в переменную $content layout-а
    // шаблон с параметрами $params
    function fetch($template, $params = [])
    {
        $content = $this->fetchPartial($template, $params);
        $layout = $this->layout;
        return $this->fetchPartial($layout, ['content' => $content]);
    }
 
    // вывести отрендеренный в переменную $content layout-а
    // шаблон с параметрами $params    
    function render($template, $params = [])
    {
        echo $this->fetch($template, $params);
    }   
}