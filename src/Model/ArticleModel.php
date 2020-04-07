<?php

namespace Model;

/*
Quand je cree un modele je dois ajouter comme proprieter les valeurs du tableau qui sont en relation 


*/
class ArticleModel extends \Core\Entity{
    public $relation = [
        'has_many' => ['table' => 'user' , 'key' => 'user_id']
         ];


}