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
    
    //Dynamically adds movie with incoming parameters
    public function addMovie($params)
    {
        $id =  $this->addRow("movies",$params); 
        echo $id;
        return $id;   
    }

     //Dynamically remove movie with incoming parameters
     public function deleteMovie($params)
     {
         echo  $this->deleteRow("movies",$params);    
     }
}