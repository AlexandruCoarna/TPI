<?php

namespace Core;

class Router
{
    private array $routes_;

    private static array $routes = [
        "GET" => [],
        "POST" => []
    ];

    private static Router $instance;

    private function __construct($routes) {

    }

    /** @noinspection PhpIncludeInspection */
    public static function init() {
        require_once "{$_SERVER['DOCUMENT_ROOT']}/config/routes.php";

        if (!self::$instance) {
            self::$instance = new self(self::$routes);
            return self::$instance;
        }

        self::$instance->alterRoutes(self::$routes);

        return self::$instance;
    }

    public function handle($request) {
        if (!key_exists($request->url, $this->routes_[$request->method])) {
            header("Location: http://localhost:8000");
        }

        $this->routes_[$request->method][$request->url]($request);
    }

    private function alterRoutes($routes) {
        $this->routes_ = $routes;
    }

    public static function get($url, $method) {
        self::$routes["GET"][$url] = $method;
    }

    public static function post($url, $method) {
        self::$routes["POST"][$url] = $method;
    }
}
