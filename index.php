<?php

//Show all error messages (If it messes something up, you can check it in the comment below.)
// error_reporting(E_ALL);


require __DIR__ . '/config/Database.php';
require __DIR__ . '/config/Model.php';
require __DIR__ . '/config/Controller.php';
require __DIR__ . '/config/Router.php';
require __DIR__ . '/config/Middleware.php';

$_SESSION['path'] = __DIR__;

Router::addMiddleware(new Middleware());

//Define Routes
Router::addRoute('/', function () {
    require __DIR__ . '/view/index.php';
});
Router::addRoute('/movies', 'MoviesController@movieList');
Router::addRoute('/movies/{id}', 'MoviesController@showMovie');
