<?php
namespace Core;
class Router
{
    private static $routes ;
    public static function connect ( $url , $route )
    {
        self::$routes[$url] = $route ;
    }
    
    public static function get ( $url )
    {
        if(!empty(self::$routes)){
            return array_key_exists($url,self::$routes)  ?   self::$routes[$url] :  null;  
        }
        // retourne un tableau associatif contenant
        // - le controller a instancier
        // - la methode du controller a appeler
    }
}
