<?php
require_once $_SESSION['path']."/config/Database.php";
class MoviesModel extends Model {

    //Lists all movies
    public function getAll()
    {
        return $this->fetchAll("movies");
    }

    //Get the movie according to ID
    public function getMovie($id)
    {
        return  $this->fetchColumn("movies",["id"],[$id]);
    }
    
    //Dynamically adds movies with incoming parameters
    public function addMovie($params)
    {
        echo  $this->addRow("movies",$params);    
    }
}