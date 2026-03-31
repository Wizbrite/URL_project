<?php

namespace core;

/**
 * Router class handles URL routing and dispatching to controllers.
 * 
 * It supports dynamic route parameters and different HTTP methods.
 */
class Router {
    /**
     * @var array Registered routes.
     */
    private $routes = [];

    /**
     * Adds a new route to the router.
     * 
     * @param string $method HTTP method (GET, POST, etc.).
     * @param string $path Route path pattern. Use {param} for dynamic parameters.
     * @param string $handler Controller and method name separated by '@' (e.g., 'HomeController@index').
     * @return void
     */
    public function add($method, $path, $handler) {
        // Convert route parameters {id} to named capture groups (?P<id>[a-zA-Z0-9_\-]+)
        $path = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[a-zA-Z0-9_\-]+)', $path);
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => '#^' . $path . '$#',
            'handler' => $handler
        ];
    }

    /**
     * Dispatches the current request to the appropriate controller method.
     * 
     * Matches the URI and HTTP method against registered routes.
     * Provides 404 response if no route matches.
     * 
     * @return mixed Response from the controller method.
     */
    public function dispatch() {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        // Remove subdirectory if any (e.g. /URL_project/)
        $basePath = dirname($_SERVER['SCRIPT_NAME']);
        if ($basePath !== '/' && strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && preg_match($route['path'], $uri, $matches)) {
                $handler = explode('@', $route['handler']);
                $controllerName = "app\\controllers\\" . $handler[0];
                $methodName = $handler[1];

                if (class_exists($controllerName)) {
                    $controller = new $controllerName();
                    
                    // Filter out numeric keys from regex matches to keep only named parameters
                    $params = array_filter($matches, function($key) {
                        return !is_int($key);
                    }, ARRAY_FILTER_USE_KEY);

                    return $controller->$methodName($params);
                }
            }
        }

        // Return 404 if no matching route is found
        header("HTTP/1.0 404 Not Found");
        echo "404 Not Found";
    }
}
