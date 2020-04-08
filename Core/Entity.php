<?php

namespace Core;

class Entity{

    function __construct($params)
    {
        $table = lcfirst(str_replace('Model','',explode('\\', get_class($this))[1])."s");
        
        if(key_exists('id',$params))
        {//instancie avec Read de l'ORM
            $info = ORM::read($table,$params['id']) ? ORM::read($table,$params['id'])[0] : false;
            if($info){

                foreach( $info as $key => $val)
                {
                    $this->$key = $val;   
                }
            }
        }
        else
        {//instancie avec params

            foreach( $params as $key => $val)
            { 
                $this->$key = $val;
            }
        }
        
        if(isset($this->relation) && key_exists('has_many',$this->relation) && isset($this->id)){
       
            $tabrel = $this->relation['has_many']['table'].'s';
            $class = '\Model\\'.ucfirst($this->relation['has_many']['table']).'Model';
            $tab = ORM::find($this->relation['has_many']['table'].'s',['WHERE' => [$this->relation['has_many']['key'] => $this->id]]);
            foreach( $tab as $val)
            {
                $this->$tabrel[] = new $class($val);
            }
            if(isset($this->$tabrel)){
                foreach($this->$tabrel as $value){
                    unset($value->relation);
                }
            }
        }

        if(isset($this->relation) && key_exists('has_one',$this->relation) && isset($this->id)){
            $tabrel = $this->relation['has_one']['table'].'s';
            $class = '\Model\\'.ucfirst($this->relation['has_one']['table']).'Model';
            $keyS = $this->relation['has_one']['key'];
  
            $tab = ORM::find($this->relation['has_one']['table'].'s',['WHERE' => ['id' => $this->$keyS]]);
            foreach( $tab as $key => $val)
            {
                $this->$tabrel[] = new $class($val);
            }
            if(isset($this->$tabrel)){
                foreach($this->$tabrel as $value){
                    unset($value->relation);
                }
            }
        }
    }


    public function create(){
        return ORM::create( lcfirst(str_replace('Model','',explode('\\', get_class($this))[1])."s"),$this->param);
       
        // $this->ORM->create([$this->table,['values']])
    }

    public function delete(){

        return ORM::delete( lcfirst(str_replace('Model','',explode('\\', get_class($this))[1])."s"),$this->removeRel(get_object_vars($this))['id']);
       
    }

    public function find($param = []){
        

       return ORM::find( lcfirst(str_replace('Model','',explode('\\', get_class($this))[1])."s"),$param);
    }

    public function read(){

        return ORM::delete( lcfirst(str_replace('Model','',explode('\\', get_class($this))[1])."s"),$this->removeRel(get_object_vars($this))['id']);
       
    }

    public function update($param){

        return ORM::update( lcfirst(str_replace('Model','',explode('\\', get_class($this))[1])."s"),$this->removeRel(get_object_vars($this))['id'],$param);
    }


}       