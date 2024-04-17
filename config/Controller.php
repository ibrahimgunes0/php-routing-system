<?php

// Main controller system. This class acts as an intermediary when going to database and view.

class Controller
{

    public function view($name, $data = [])
    {
        // Import variables from an array
        extract($data);

        // It includes the view page and the extracted values can be used in the included page.
        require __DIR__ . '/../view/' . strtolower($name) . '.php';
    }

    public function model($name)
    {
        require __DIR__ . '/../model/' . strtolower($name) . '.php';
        return new $name();
    }

}