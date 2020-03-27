<?php
spl_autoload_register('newAutoLoader');

function newAutoLoader($class)
{
  
    $namespace = explode('\\',$class)[0];
  
    $class = explode('\\',$class)[1];

    $root = pathinfo(__DIR__)['dirname'];
    searchClass($root,$namespace,$class);
}
function searchClass($path ,$namespace = '',$class = '')
{
    $pathList = array_diff(scandir($path), array('.', '..'));
    foreach($pathList as $element)
    { 
        $dir = array_reverse(explode('/',pathinfo($path.'/'.$element)['dirname']))[0];
        if(is_dir($path.'/'.$element))
        {
            searchClass($path.'/'.$element,$namespace,$class);
        }
        else if(is_file($path.'/'.$element) && $element == $class.'.php' && $dir == $namespace) 
        {
            include_once $path.'/'.$element;
        }
    }
}   

