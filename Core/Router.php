<?php
namespace Core;
class Router
{
    public static $id;
    private static $routes ;
    public static function connect ( $url , $route )
    {
        self::$routes[$url] = $route ;
    }
    
    public static function get ( $url )
    {
        $expURL = explode('/',$url);
        if(intval($expURL[count($expURL)-1]) && !preg_match("/[a-z]/i", $expURL[count($expURL)-1])){
            self::$id = preg_replace('/[^0-9]/', '', $expURL[count($expURL)-1]);
            $expURL[count($expURL)-1] = '{id}';
            $url = implode('/',$expURL);
        }

        if(!empty(self::$routes)){
            return array_key_exists($url,self::$routes)  ?   self::$routes[$url] :  null;  
        }
        // retourne un tableau associatif contenant
        // - le controller a instancier
        // - la methode du controller a appeler
    }
}
