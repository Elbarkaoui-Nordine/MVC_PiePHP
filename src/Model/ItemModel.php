<?php

namespace Model;

class ItemModel extends \Core\Entity{

    public $relation = [
        'has_many' => [ ['table' => 'voiture' , 'key' => 'voiture_id'] ],
        'has_one' => [ ['table' => 'article' , 'key' => 'user_id'] ],
        'many_to_many' => [ ['table1' => 'user' , 'table2' => 'item'] ],
         ];

}