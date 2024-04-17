<?php

class Database
{

    protected $db;

    public function __construct()
    {
        //connection database
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=phproutes', 'root', '');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}