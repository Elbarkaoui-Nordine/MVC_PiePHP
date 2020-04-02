<?php

namespace Core;


require_once("./autoload.php");

class Entity{
    
    function __construct($params)
    {
        $table = lcfirst(str_replace('Model','',explode('\\', get_class($this))[1])."s");
        
        if(key_exists('id',$params))
        {//instancie avec Read de l'ORM
            $info = ORM::read($table,$params['id'])[0];
            foreach( $info as $key => $val)
            {
                $this->$key = $val;
              
                
            }
        }
        else
        {//instancie avec params
        
            foreach( $params as $key => $val)
            {
                $this->$key = $val;
            }
        }
    }

    public function create(){

        foreach(get_object_vars($this) as $key => $value){
            $col[] = $key;
            $val[] = $value;
        }

        ORM::create( lcfirst(str_replace('Model','',explode('\\', get_class($this))[1])."s"),['columns' => $col,'values' => $val]);
       //$this->ORM->create([$this->table,['values']])
    }

}       