<?php

Core\Router::connect( '/' , [ 'controller' => 'app' , 'action' => 'index']);
Core\Router::connect( '/register' , [ 'controller' => 'user' , 'action' => 'add']);
COre\Router::connect( '/user/{id}' , [ 'controller' => 'user' , 'action' => 'show']);
