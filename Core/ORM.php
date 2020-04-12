<?php
namespace Core;

class ORM{

    //  string $table $field['colums' => ['email'] , 'values' => ['nordine@hotmail.fr'] ]
    public static function create($table, $fields){
        $bdd = Database::connect();
        foreach($fields as $key => $val){
            $fields['columns'][] = $key;
            $fields['values'][] = $val;
        }
        $executeArray = [];

        $query = "INSERT INTO " . $table . "(";
        for ($i = 0; $i < count($fields['columns']);$i++)
        {
          $query .= $fields['columns'][$i] . ", ";
        }
        $query = substr($query, 0, -2);
        $query .= ") VALUES (";
        for ($i = 0; $i < count($fields['values']);$i++)
        {
          $query .= "?, ";
          array_push($executeArray, $fields['values'][$i]);
        }
        $query = substr($query, 0, -2);
        $query .= ")";
    
   
        $req = $bdd->prepare($query);
        $req->execute($executeArray);
        return $bdd->lastInsertId();
    }

    public static function read($table,$id){
        $bdd = Database::connect();
        $query = "SELECT * FROM $table WHERE id = ?";
        $req = $bdd->prepare($query);
        $req->execute([$id]);
        $res = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $res;
        
    }

    public static function update($table,$id,$fields){
        $bdd = Database::connect();

        $executeArray = [];

        $query = "UPDATE " . $table . " SET ";
        foreach ($fields as $key => $value) {
        $query .= $key . ' = ? , ';
        array_push($executeArray, $value);
        }
        $query = substr($query, 0, -2);

        $query .= "WHERE id = ?";
        $executeArray[] = $id;
        $req = $bdd->prepare($query);
        $req->execute($executeArray);
        $count = $req->rowCount();
        return $count > 0 ? true : false;
    }


    public static function delete($table,$id){
        $bdd = Database::connect();

        $query = "DELETE FROM " . $table . " WHERE id = ?";
        $req = $bdd->prepare($query);
        $req->execute([$id]);
        $count = $req->rowCount();
        return $count > 0 ? true : false;
    }

    public static function find($table,$condition = []){
      $bdd = Database::connect();
    //print_r($a->find(  'users',['WHERE' => ['id' => '1,2'] ,'ADD' => 'OR','ORDER BY' => 'id ASC','LIMIT' => '30']  ));
    $query = "SELECT * FROM $table ";
    if(count($condition) > 0 )
    {
        $executeArray = [];
        if(array_key_exists('WHERE',$condition)){
            $query .= ' WHERE ';
           foreach($condition['WHERE'] as $key => $value)
           {
               $whereVal = explode(',',$value);
               for($i = 0 ;$i < count($whereVal); $i++ )
                {
                    $query .= $key.' = ?';
                    $executeArray[] = $whereVal[$i];
                    key_exists('ADD',$condition) ? $query .= ' '.$condition['ADD'].' ': null;  
                }                       
           }
           key_exists('ADD',$condition) ? $query = substr($query,0,-4) : null;
        }
        if(array_key_exists('ORDER BY',$condition)){
            $query .= ' ORDER BY '.$condition['ORDER BY'];
        }
        if(array_key_exists('LIMIT',$condition)){
            $query .= ' LIMIT '.$condition['LIMIT'];
        }
    }
    $req = $bdd->prepare($query);
    !empty($executeArray) ? $req->execute($executeArray) : $req->execute();
    $res = $req->fetchAll(\PDO::FETCH_ASSOC);
    return $res;
    }
}
