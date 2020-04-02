<?php

namespace Core;

class Request{
    private $params = [];
    public function getQueryParams(){

        foreach( $_POST as $key => $element)
        {
            $this->params[$key] = trim(stripslashes(htmlspecialchars($element, ENT_QUOTES)));
        }
 
        foreach( $_GET as $key => $element)
        {
            $this->params[$key] = trim(stripslashes(htmlspecialchars($element, ENT_QUOTES)));
        }
        return $this->params;
    }
}