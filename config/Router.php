<?php
// Set error reporting to only display fatal errors and parse errors
error_reporting(E_ERROR | E_PARSE);
class Router
{

    public static $middleware = [];

    /**
     * Parse URL
     *
     * Extracts the path from the request URI.
     *
     * @return string The parsed URL path
     */
    public static function parse_url()
    {
        //Get the base name of the PHP file running
        $basename = basename($_SERVER['SCRIPT_NAME']);

        // Remove the SCRIPT_NAME from the REQUEST_URI
        return str_replace($basename, null, $_SERVER['REQUEST_URI']);
    }

    /**
     * Add Middleware
     *
     * Adds middleware functions to the router.
     *
     * @param callable $middleware The middleware function to add
     */
    public static function addMiddleware($middleware)
    {
        self::$middleware[] = $middleware;
    }



    /**
     * Add Route
     *
     * Adds a route with specified URL, callback function, and HTTP method(s).
     *
     * @param string $url The URL pattern to match
     * @param mixed $callback The callback function or controller string
     * @param string $method The HTTP method(s) for the route (default: 'get')
     */
    public static function addRoute($url, $callback, $method = 'get')
    {
        $method = explode('|', strtoupper($method));

        foreach (self::$middleware as $middleware) {
            // Execute middleware
            $middleware();
        }


        if (in_array($_SERVER['REQUEST_METHOD'], $method, true)) {
            $patterns = [
                '{url}' => '([0-9a-zA-Z?=_]+)',
                '{id}' => '([0-9]+)'
            ];

            $url = str_replace(array_keys($patterns), array_values($patterns), $url);

            $requestUri = self::parse_url();
            //Checking whether the incoming path is on our root or not.
            if (preg_match('@^' . $url . '$@', $requestUri, $parameters)) {
                unset($parameters[0]);

                //if callback is a function calling callback function with parameters
                if (is_callable($callback)) {
                    call_user_func_array($callback, $parameters);
                } else {
                    
                    //We find the class and the function it will call and run it
                    $controller = explode('@', $callback);
                    $className = explode('/', $controller[0]);
                    $className = end($className);
                    $controllerFile = __DIR__ . '/../controller/' . $controller[0] . '.php';

                    if (end($method) === "PUT") {
                        //We parse the form-data received with the PUT method and define them into an array.
                        $data = array();
                        $parameters = self::parse_raw_http_request($data);
                    }
                    if (file_exists($controllerFile)) {
                        require $controllerFile;
                        call_user_func_array([new $className, $controller[1]], $parameters);
                    }

                }

            }

        }

    }

    /**
     * Parse Raw HTTP Request
     *
     * Parses raw HTTP request data to extract form fields.
     *
     * @param array $a_data An array to store form data
     *
     * @return array The parsed form data
     *
     * Resource: https://stackoverflow.com/questions/5483851/manually-parse-raw-multipart-form-data-data-with-php
     **/
    public static function parse_raw_http_request(array &$a_data)
    {
        // read incoming data
        $input = file_get_contents('php://input');

        // grab multipart boundary from content type header
        preg_match('/boundary=(.*)$/', $_SERVER['CONTENT_TYPE'], $matches);
        $boundary = $matches[1];

        // split content by boundary and get rid of last -- element
        $a_blocks = preg_split("/-+$boundary/", $input);
        array_pop($a_blocks);

        // loop data blocks
        foreach ($a_blocks as $id => $block) {
            if (empty($block))
                continue;

            // you'll have to var_dump $block to understand this and maybe replace \n or \r with a visibile char

            // parse uploaded files
            if (strpos($block, 'application/octet-stream') !== FALSE) {
                // match "name", then everything after "stream" (optional) except for prepending newlines 
                preg_match('/name=\"([^\"]*)\".*stream[\n|\r]+([^\n\r].*)?$/s', $block, $matches);
            }
            // parse all other fields
            else {
                // match "name" and optional value in between newline sequences
                preg_match('/name=\"([^\"]*)\"[\n|\r]+([^\n\r].*)?\r$/s', $block, $matches);
            }
            $a_data[$matches[1]] = $matches[2];
        }
        return $a_data;
    }

}
