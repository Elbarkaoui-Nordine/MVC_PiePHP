<?php

namespace Core;


// require_once("./autoload.php");

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
        
        return ORM::create( lcfirst(str_replace('Model','',explode('\\', get_class($this))[1])."s"),get_object_vars($this));
       
        // $this->ORM->create([$this->table,['values']])
    }

    public function delete(){

        return ORM::delete( lcfirst(str_replace('Model','',explode('\\', get_class($this))[1])."s"),get_object_vars($this)['id']);
       
    }

    public function find($param = []){

       return ORM::find( lcfirst(str_replace('Model','',explode('\\', get_class($this))[1])."s"),$param);
    }

    public function read(){

        return ORM::delete( lcfirst(str_replace('Model','',explode('\\', get_class($this))[1])."s"),get_object_vars($this)['id']);
       
    }

    public function update($param){

        return ORM::update( lcfirst(str_replace('Model','',explode('\\', get_class($this))[1])."s"),get_object_vars($this)['id'],$param);
    }
}       