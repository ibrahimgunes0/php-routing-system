# Routing System With PHP MVC (Kolay Randevu Assessment)

This is a custom PHP routing component inspired by Laravel's routing system. It allows you to define routes, handle parameterized routes, support various HTTP methods, implement middleware, and manage route grouping.

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