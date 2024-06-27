<?php

namespace Core;

class Router {
    private $routes = [];

    public function add($route, $controllerAction, $method = 'GET', $middleware = null) {
        $this->routes[] = [
            'route' => $route,
            'controllerAction' => $controllerAction,
            'method' => $method,
            'middleware' => $middleware
        ];
    }

    public function dispatch($url) {
        $urlPath = parse_url($url, PHP_URL_PATH);
        foreach ($this->routes as $route) {
            $pattern = "#^" . preg_replace('/\{[^\}]+\}/', '([^/]+)', $route['route']) . "$#";
            if (preg_match($pattern, $urlPath, $matches) && $_SERVER['REQUEST_METHOD'] === $route['method']) {
                array_shift($matches);
                list($controller, $action) = explode('@', $route['controllerAction']);

                if ($route['middleware']) {
                    call_user_func([$route['middleware'], 'admin']); // Change 'admin' to the appropriate method if necessary
                }

                if (class_exists($controller)) {
                    $controllerInstance = new $controller();
                    if (method_exists($controllerInstance, $action)) {
                        call_user_func_array([$controllerInstance, $action], $matches);
                        return;
                    } else {
                        error_log("Action $action does not exist on controller $controller");
                    }
                } else {
                    error_log("Controller $controller does not exist");
                }
            }
        }
        http_response_code(404);
        echo "Page not found";
    }
}
