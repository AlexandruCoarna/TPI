<?php /** @noinspection PhpIncludeInspection */

namespace Core;

use Error;

class Router
{
    private array $routes_;

    private static array $routes = [
        "GET" => [],
        "POST" => []
    ];

    private static ?Router $instance = null;

    private function __construct($routes) {
        $this->routes_ = $routes;
    }

    public static function init(): Router {
        $path = ROOT . "/config/routes.php";

        if (!file_exists($path)) {
            throw new Error("routes.php file must be in config directory, make sure you declare all your routes in there!");
        }

        require_once $path;

        return !self::$instance ? self::$instance = new self(self::$routes) : self::$instance;
    }

    public function handle($request): Router {
        if (!key_exists($request->method, $this->routes_)) {
            throw new Error("'{$request->method}' is not supported");
        }

        if (!key_exists($request->url, $this->routes_[$request->method])) {
            header("Location: http://localhost:8000");
        }

        $this->routes_[$request->method][$request->url]($request);

        return $this;
    }

    private static function checkRouteExists($url, $requestMethod) {
        if (key_exists($url, self::$routes[$requestMethod])) {
            throw new Error("This route '{$url}' is already defined");
        }
    }

    public static function get($url, $method): void {
        self::checkRouteExists($url, "GET");
        self::$routes["GET"][$url] = $method;
    }

    public static function post($url, $method): void {
        self::checkRouteExists($url, "POST");
        self::$routes["POST"][$url] = $method;
    }
}
