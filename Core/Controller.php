<?php

namespace Core;

class Controller
{ 
    /*
    Votre Controller doit implémenter une fonction render qui doit afficher la view passée en paramètre dans le layout index.
    L’attribut $_render sera affiché à la toute fin de l’exécution du script. Trouvez un moyen astucieux de le faire
    proprement. Pensez à __construct qui est appelé à la création d’un objet.
    */
    public static $_render;
    protected $request;

    public function __construct()
    {
        $this->request = new \Core\Request();
    }
    protected function render($view, $scope = [])
    {
 
        $f = implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'src', 'View', str_replace('Controller', '', str_replace('\\','',basename(get_class($this)))), $view]).'.php';

        if (file_exists($f)) {            
            ob_start();
            include($f);
            $view = ob_get_clean();
            $template = new TemplateEngine();
            $view = $template->template($view,$scope);
            ob_start();
            //va mettre dans le view
            include(implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'src', 'View', 'index']) . '.php');
            self::$_render = ob_get_clean();
        }
    }


    function __destruct()
    {
        echo self::$_render;
    }
}



//        $view = preg_replace('/@else(\s*.*\s*)/', '}else{$1;}', $view);