<?php

namespace Model;

/*
Quand je cree un modele je dois ajouter comme proprieter les valeurs du tableau qui sont en relation 


*/
class ArticleModel extends \Core\Entity{
    public $relation = [
        'has_many' => [ ['table' => 'article' , 'key' => 'user_id'] ],
        'has_one' => [ ['table' => 'voiture' , 'key' => 'voiture_id'] ],
        'many_to_many' => [ ['table1' => 'user' , 'table2' => 'item'] ],
         ];



}