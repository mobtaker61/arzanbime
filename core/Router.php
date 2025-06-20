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
        error_log("Router::dispatch - Processing URL: " . $urlPath);
        error_log("Router::dispatch - Request method: " . $_SERVER['REQUEST_METHOD']);
        
        foreach ($this->routes as $route) {
            $pattern = "#^" . preg_replace('/\{[^\}]+\}/', '([^/]+)', $route['route']) . "$#";
            if (preg_match($pattern, $urlPath, $matches) && $_SERVER['REQUEST_METHOD'] === $route['method']) {
                error_log("Router::dispatch - Found matching route: " . $route['route']);
                
                array_shift($matches);
                list($controller, $action) = explode('@', $route['controllerAction']);
                error_log("Router::dispatch - Controller: $controller, Action: $action");

                if ($route['middleware']) {
                    error_log("Router::dispatch - Executing middleware: " . $route['middleware']);
                    call_user_func($route['middleware']);
                }

                if (class_exists($controller)) {
                    $controllerInstance = new $controller();
                    if (method_exists($controllerInstance, $action)) {
                        error_log("Router::dispatch - Calling controller action");
                        call_user_func_array([$controllerInstance, $action], $matches);
                        return;
                    } else {
                        error_log("Router::dispatch - Action $action does not exist on controller $controller");
                    }
                } else {
                    error_log("Router::dispatch - Controller $controller does not exist");
                }
            }
        }
        error_log("Router::dispatch - No matching route found");
        http_response_code(404);
        echo "Page not found";
    }
}
