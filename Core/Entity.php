<?php

namespace Core;

class Entity{

    function __construct($params)
    {
        if(key_exists('id',$params))
        {//instancie avec Read de l'ORM
            $a = new ORM();
            $info = $a->read('users',$params['id'])[0];
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
    

}       

$a = new Entity(['id' => '1']);