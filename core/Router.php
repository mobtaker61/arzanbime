<?php
namespace Core;

class Router {
    private $routes = [];

    public function add($route, $controllerAction, $method = 'GET') {
        $this->routes[] = [
            'route' => $route,
            'controllerAction' => $controllerAction,
            'method' => $method
        ];
    }

    public function dispatch($url) {
        $urlPath = parse_url($url, PHP_URL_PATH);
        foreach ($this->routes as $route) {
            $pattern = "#^" . preg_replace('/\{[^\}]+\}/', '([^/]+)', $route['route']) . "$#";
            if (preg_match($pattern, $urlPath, $matches) && $_SERVER['REQUEST_METHOD'] === $route['method']) {
                array_shift($matches);
                list($controller, $action) = explode('@', $route['controllerAction']);
                $controller = new $controller();
                call_user_func_array([$controller, $action], $matches);
                return;
            }
        }
        http_response_code(404);
        echo "Page not found";
    }
}
