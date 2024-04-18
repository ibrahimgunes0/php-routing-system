<?php
class MoviesController extends Controller{

    // Show all movies
    public function movieList($new_id = null){
        $movieModel = $this->model('MoviesModel');
        $movies = $movieModel->getAll();

        $this->view('movies', [
            'movies' => $movies
        ]);
    }

    // Goes to the detail page of a specific movie
    public function showMovie($id){
        $movieModel = $this->model('MoviesModel');
        $movie = $movieModel->getMovie($id);
        
        $this->view('movie', [
            'movie' => $movie
        ]);
    }

    public function addMovieForm(){
        $this->view('add_movie_form');
    }

    public function movieProcess($name, $image, $explanation){
        $movieModel = $this->model('MoviesModel');
        $response = $movieModel->addMovie(array("name" => $name, "image" => $image, "explanation" => $explanation));
    }
}