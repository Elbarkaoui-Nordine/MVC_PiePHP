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

    public function __construct()
    {
        $req = new Request();
        $req->secureAction();
    }

    protected function render($view, $scope = [])
    {
        extract($scope);
        $f = implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'src', 'View', str_replace('Controller', '', str_replace('\\','',basename(get_class($this)))), $view]).'.php';

        if (file_exists($f)) {            
            ob_start();
            include($f);
            $view = ob_get_clean();
            ob_start();
            //va mettre dans le view
            include(implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'src', 'View', 'index']) . '.php');
            return self::$_render = ob_get_clean();
        }
    }
}

