<?php

use Config\Core\Route;

$router = new Route;

$router->get('/posts', 'PostController', 'index');

$router->post('/posts/store','PostController', 'store');

$router->delete($_SERVER['REQUEST_URI'],'PostController', 'destroy');

$router->patch('/posts/patch','PostController', 'patch');

$router->start();

