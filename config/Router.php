<?php

class Router
{

    public static  $middleware = [];

    public static function parse_url()
    {
        //php file running
        $basename = basename($_SERVER['SCRIPT_NAME']);

        //remove SCRIPT_NAME
        return str_replace($basename, null, $_SERVER['REQUEST_URI']);
    }

    public static function addMiddleware($middleware) {
        self::$middleware[] = $middleware;
    }

    
    public static function addRoute($url, $callback, $method = 'get')
    {
        $method = explode('|', strtoupper($method));

        foreach (self::$middleware as $middleware) {
            // Execute middleware
            $middleware();
        }

        if (in_array($_SERVER['REQUEST_METHOD'], $method, true)) {

            $patterns = [
                '{url}' => '([0-9a-zA-Z]+)',
                '{id}' => '([0-9]+)'
            ];

            $url = str_replace(array_keys($patterns), array_values($patterns), $url);

            $requestUri = self::parse_url();
            if (preg_match('@^' . $url . '$@', $requestUri, $parameters)) {
                unset($parameters[0]);

                if (is_callable($callback)) {
                    call_user_func_array($callback, $parameters);
                } else {

                    $controller = explode('@', $callback);
                    $className = explode('/', $controller[0]);
                    $className = end($className);
                    $controllerFile = __DIR__ . '/../controller/' . $controller[0] . '.php';
                    if (file_exists($controllerFile)) {
                        require $controllerFile;
                        call_user_func_array([new $className, $controller[1]], $parameters);
                    }
                    
                }

            }

        }

    }

}
