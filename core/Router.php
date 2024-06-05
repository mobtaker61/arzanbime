<?php
class Router {
    private $routes = [];

    public function add($route, $controller, $method = 'GET') {
        $this->routes[$method][$route] = $controller;
    }

    public function dispatch($url) {
        $method = $_SERVER['REQUEST_METHOD'];
        $url = parse_url($url, PHP_URL_PATH);

        if (isset($this->routes[$method][$url])) {
            list($controller, $action) = explode('@', $this->routes[$method][$url]);
            $controllerObj = new $controller();
            $controllerObj->$action();
        } else {
            echo "404 Not Found";
        }
    }
}
