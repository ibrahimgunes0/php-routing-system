# Routing System With PHP MVC

This custom PHP Router class is designed to manage routes for an application with a specific MVC (Model-View-Controller) structure. The class supports HTTP methods (GET, POST, PUT, DELETE) and allows for middleware usage.

## Features

- Define routes with GET, POST, PUT, DELETE HTTP methods.
- Support parameterized routes.
- Handle route callbacks or controller actions.
- Implement route grouping and middleware support.


## Installation

1. Clone or download this repository to your local machine.
2. Include the necessary files in your PHP project:
    - `config/Database.php`: Database configuration file.
    - `config/Model.php`: Base model class.
    - `config/Controller.php`: Base controller class.
    - `config/Router.php`: Custom router class.
    - `config/Middleware.php`: Middleware class.
3. Configure your database connection in `Database.php`.
4. Import your database `movies.sql`.

## Usage
### Basic Route Definition
```php
<?php

require 'Router.php';

$router::addRoute('/hello', function () {
    echo 'Hello, world!';
});

$router::addRoute('/hello/{name}', function ($params) {
    echo 'Hello, ' . $params['name'] . '!';
});

?>
```
### Middleware
Create an instance of the Middleware class. This can be done as follows:
```php
<?php
// Create an instance of the Middleware class
$middleware = new Middleware();

// Automatically checks the browser's language
// If the language is not supported, it outputs an error message and terminates the script
?>
```

#### Automatic Invocation
```php
<?php

 public function __invoke() {
    if ($_SERVER['HTTP_ACCEPT_LANGUAGE']){
        $this->checkBrowserLanguage();
    }
}
?>
```
The __invoke() magic method is utilized in this class, allowing the middleware to automatically run when the object is defined. Therefore, once the Middleware instance is created, it will automatically check the browser's language.

If you want to add another controller, you can control it by calling it in the __invoke method after adding the function to the Middleware class.

### Security
#### Authentication
Authentication function in Middleware:
```php
<?php

 public function authenticate()
    {
        // Check if the request method is POST
        if ($_SERVER['REQUEST_METHOD'] === "POST"){
            // Check if PHP authentication credentials are provided and if they match the expected values
            if ($_SERVER['PHP_AUTH_USER'] !== "admin" || $_SERVER['PHP_AUTH_PW'] !== "admin") {
                echo "Authentication failed. Incorrect username or password.";
                die();
            }
        }
    }
?>
```
Here, it verifies the requests received via post with 'Basic Auth'.

### SQL injection

I chose to use PDO for SQL injection. Because using PDO in PHP is very important to prevent SQL injection attacks. PDO provides prepared statements and parameterized queries that separate SQL code from user input. This prevents SQL injection.

### Define Routes

- **GET Routes**:
    - `/`: Home page.
    - `/movies`: List all movies.
    - `/movies/{id}`: Show details of a specific movie.
    - `/add_movie_form`: Display form to add a new movie.
    
- **POST Routes**:
    - `/movies`: List all movies JSON format.

- **PUT Routes**:
    - `/movie_process`: Add a new movie (using form data).

- **DELETE Routes**:
    - `/movie_process/{id}`: Delete a movie with the specified ID.

### Middleware

- The provided Middleware class is added to all routes using `Router::addMiddleware(new Middleware())`. You can customize the middleware logic in the Middleware class file.
  
## Troubleshooting


- If you get a white screen and cannot see an error message, you should put error_reporting(0) in the comment line in Router.php.
- If your browser language is not English. Change your browser language to English and try again. (For middleware test)

## Maintainers

- Ibrahim GUNES - [send mail](mailto:gunesibrahim.x@gmail.com)
