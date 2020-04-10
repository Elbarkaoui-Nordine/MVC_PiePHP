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
        $scope['dbz'] = 'dbz > all '; 
        $scope['dbgt'] = 'dbgt > all '; 
        $scope['dbs'] = 'dbs > all '; 
        $f = implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'src', 'View', str_replace('Controller', '', str_replace('\\','',basename(get_class($this)))), $view]).'.php';

        if (file_exists($f)) {            
            ob_start();
            include($f);
            $view = ob_get_clean();
            $view = $this->template($view,$scope);
            ob_start();
            //va mettre dans le view
            include(implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'src', 'View', 'index']) . '.php');
            self::$_render = ob_get_clean();
        }
    }
    public function template($view,$scope){
        //echo toutes les balises html
        extract($scope);

 
        $view = preg_replace('/@if\((\s*.*\s*)\)/', 'if($1){', $view);

        $view = preg_replace('/@elseif\((\s*.*\s*)\)/', '}elseif($1){', $view);

        $view = preg_replace('/\@else/', '}else{', $view);
        
        $view = preg_replace('/\@endif/', '}', $view);


        $view = preg_replace('/\{\{(\$.*?)\}\}/', 'echo htmlentities($1); ', $view);

        eval($view);

 
    }

    function __destruct()
    {
        echo self::$_render;
    }
}



//        $view = preg_replace('/@else(\s*.*\s*)/', '}else{$1;}', $view);