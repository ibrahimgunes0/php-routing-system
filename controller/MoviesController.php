<?php
class MoviesController extends Controller{

    // Show all movies
    public function movieList(){
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
}