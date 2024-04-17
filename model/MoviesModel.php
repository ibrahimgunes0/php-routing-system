<?php
require_once $_SESSION['path']."/config/Database.php";
class MoviesModel extends Model {

    public function getAll()
    {
        return $this->fetchAll("movies");
    }
    public function getMovie($id)
    {
        return  $this->fetchColumn("movies",["id"],[$id]);
    }

}