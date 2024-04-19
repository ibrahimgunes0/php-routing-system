<?php
class MoviesController extends Controller
{

    // Show all movies
    public function movieList($new_id = null){

        $movies = $this->getAllMovies();
        $this->view('movies', [
            'movies' => $movies
        ]);
    }

    //Exports movies in json format
    public function exportMoviesJson(){
        $movies = $this->getAllMovies();
        echo json_encode($movies);
    }

    // Get all movies from database
    public function getAllMovies(){
        $movieModel = $this->model('MoviesModel');
        return $movieModel->getAll();
    }
    // Goes to the detail page of a specific movie
    public function showMovie($id)
    {
        $movieModel = $this->model('MoviesModel');
        $movie = $movieModel->getMovie($id);

        $this->view('movie', [
            'movie' => $movie
        ]);
    }

    //Shows the movie adding form
    public function addMovieForm()
    {
        $this->view('add_movie_form');
    }

    //Adds the movie to the database with the data from the form
    public function addMovie($name, $image, $explanation)
    {
        $movieModel = $this->model('MoviesModel');
        $response = $movieModel->addMovie(array("name" => $name, "image" => $image, "explanation" => $explanation));
    }

    //Deletes the movie according to the received ID
    public function deleteMovie($id)
    {
        $movieModel = $this->model('MoviesModel');
        $response = $movieModel->deleteMovie(array("id" => $id));
    }
}