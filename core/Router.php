<?php

namespace Core;

class Router
{
    private array $routes = [
        "GET" => [],
        "POST" => []
    ];

    /** @noinspection PhpIncludeInspection */
    public static function init() {
        $router = new self;

        require_once "{$_SERVER['DOCUMENT_ROOT']}/config/routes.php";

        return $router;
    }

    public function handle($request) {
        if (!key_exists($request->url, $this->routes[$request->method])) {
            header("Location: http://localhost:8000");
        }

        $this->routes[$request->method][$request->url]($request);
    }

    public function get($url, $method) {
        $this->routes["GET"][$url] = $method;
    }

    public function post($url, $method) {
        $this->routes["POST"][$url] = $method;
    }
}
