<?php 

namespace Core;


class TemplateEngine{

    public function template($view,$scope){
        // //echo toutes les balises html
        // echo"This is user comments is as follows:". echo htmlentities($var); ." ";
        extract($scope);

        $view = preg_replace('/\<.*\>.*<\/.*\>|<.*>/', 'echo "$0"; ', $view);

        $view = preg_replace('/\{\{(.*?)\}\}/', "echo htmlentities($1);", $view);
       
        $view = preg_replace(['/@if\((\s*.*\s*)\)/','/@elseif\((\s*.*\s*)\)/','/\@else/','/\@endif/'], ['if($1){','}elseif($1){','}else{','}'], $view);

        $view = preg_replace(['/@foreach\((\s*.*\s*)\)/','/@endforeach/'], ['foreach($1){ ','}'], $view);

        $view = preg_replace(['/@isset\((\s*.*\s*)\)/','/@endisset/'], ['if(isset($1)){ ','}'], $view);

        $view = preg_replace(['/@empty\((\s*.*\s*)\)/','/@endempty/'], ['if(empty($1)){ ','}'], $view);

        eval($view);
    }

}