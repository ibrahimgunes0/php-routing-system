<?php

// Define routes with various HTTP methods (GET, POST, PUT, DELETE).

//Show all error messages (If it messes something up, you can check it in the comment below.)
// error_reporting(E_ALL);
// error_reporting(0);


require __DIR__ . '/config/Database.php';
require __DIR__ . '/config/Model.php';
require __DIR__ . '/config/Controller.php';
require __DIR__ . '/config/Router.php';
require __DIR__ . '/config/Middleware.php';

$_SESSION['path'] = __DIR__;

Router::addMiddleware(new Middleware());

//Define Routes
//Routes called with GET method
Router::addRoute('/', function () {require __DIR__ . '/view/index.php';});
Router::addRoute('/movies', 'MoviesController@movieList');
Router::addRoute('/movies{url}', 'MoviesController@movieList');
Router::addRoute('/movies/{id}', 'MoviesController@showMovie');
Router::addRoute('/add_movie_form', 'MoviesController@addMovieForm');

//Routes called with POST method
Router::addRoute('/movies', 'MoviesController@movieList', 'POST');

//Routes called with PUT method
Router::addRoute('/movie_process', 'MoviesController@addMovie','put');

//Routes called with DELETE method
Router::addRoute('/movie_process/{id}', 'MoviesController@deleteMovie','delete');

