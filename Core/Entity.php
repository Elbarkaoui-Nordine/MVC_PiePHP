<?php

namespace Core;

class Entity{

    function __construct($params, $class = null)
    {
        if($class == null){
            $class = get_class($this);
        }
        
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
        
        if( $class == get_class($this)){
         
            if(isset($this->relation) && key_exists('has_many',$this->relation) && isset($this->id)){
        
                foreach($this->relation['has_many'] as $value){
    
                    if(is_array($value) && key_exists('table',$value)){
    
                        $tabrel = $value['table'].'s';
                        $class = '\Model\\'.ucfirst($value['table']).'Model';
                        $tab = ORM::find($value['table'].'s',['WHERE' => [$value['key'] => $this->id]]);
                        foreach( $tab as $val)
                        {
                            $this->$tabrel[] = new $class($val,$class);
                        }
                    }
                }
            }

            if(isset($this->relation) && key_exists('has_one',$this->relation) && isset($this->id) ){
                   
                foreach($this->relation['has_one'] as $value){
    
                    if(is_array($value) && key_exists('table',$value)){
    
                        $tabrel = $value['table'];
                        $class = '\Model\\'.ucfirst($value['table']).'Model';
                        $keyS = $value['key'];
            
                        if(isset($this->$keyS)){
                            $tab = ORM::find($value['table'].'s',['WHERE' => ['id' => $this->$keyS]]);
                            foreach( $tab as $key => $val)
                            {
                                $this->$tabrel = new $class($val,$class);
                            }
                        }
                    }
                }
            }
                
            if(isset($this->relation) && key_exists('many_to_many',$this->relation) && isset($this->id)){
                foreach($this->relation['many_to_many'] as $value){
    
                    if(is_array($value) && key_exists('table1',$value)){
    
                        $table1 = $value['table1'].'s';
                        $table2 = $value['table2'].'s';
                        $pivot = $table1.'_'.$table2;
    
                        $class = '\Model\\'.ucfirst($value['table2']).'Model';
                
                        $tab = ORM::find($pivot,['WHERE' => [$value['table1'].'_id' => $this->id]]);
    
                        foreach( $tab as $val)
                        {
                            $this->$table2[] = new $class(['id' => $val[$value['table2'].'_id']],$class);
                        }
                    }
                }
            }
            
        }
        
        foreach(get_object_vars($this) as $key => $value){
            if(is_array($value)){
                if($key == 'relation'){
                    unset($this->$key);
                }                
            }
        }
       
    }


    public function create(){

        return ORM::create( lcfirst(str_replace('Model','',explode('\\', get_class($this))[1])."s"),get_object_vars($this));
       
        // $this->ORM->create([$this->table,['values']])
    }

    public function delete(){

        if(isset($this->id)){
            return ORM::delete( lcfirst(str_replace('Model','',explode('\\', get_class($this))[1])."s"),get_object_vars($this)['id']);
        }
       
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

    public function readAll($param = []){
        $list = ORM::find( lcfirst(str_replace('Model','',explode('\\', get_class($this))[1])."s"),$param);
        $class = get_class($this);
        $models = [];
        foreach($list as $value){
            $models[] = new $class(['id' => $value['id']]);
        }
        return $models;
    }


    // function __destruct()
    // {
    //     foreach($GLOBALS as $key => $value){
    //         if($value == 'exist'){
    //             $GLOBALS[$key] = 'dont exist';
    //         }
    //     }
    // }
}       