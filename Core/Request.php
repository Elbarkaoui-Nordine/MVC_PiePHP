<?php

namespace Core;

class Request{

    public function secureAction(){
        foreach( $_POST as $key => $element)
        {
            $_POST[$key] = trim(stripslashes(htmlspecialchars($element, ENT_QUOTES)));
        }
        foreach( $_GET as $key => $element)
        {
            $_GET[$key] = trim(stripslashes(htmlspecialchars($element, ENT_QUOTES)));
        }
    }
}