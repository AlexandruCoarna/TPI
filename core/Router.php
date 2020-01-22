<?php /** @noinspection PhpIncludeInspection */

namespace Core;

use Core\Response\ViewResponse;
use Error;

class Router {
    private static array $routes = [
        "GET" => [],
        "POST" => [],
        "DELETE" => []
    ];
    private static ?Router $instance = null;
    private array $routes_;

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

    public static function get($url, $method): void {
        self::checkRouteExists($url, "GET");
        self::$routes["GET"][$url] = $method;
    }

    private static function checkRouteExists($url, $requestMethod) {
        if (key_exists($url, self::$routes[$requestMethod])) {
            throw new Error("This route '{$url}' is already defined");
        }
    }

    public static function post($url, $method): void {
        self::checkRouteExists($url, "POST");
        self::$routes["POST"][$url] = $method;
    }

    public static function delete($url, $method): void {
        self::checkRouteExists($url, "DELETE");
        self::$routes["DELETE"][$url] = $method;
    }

    public function handle(Request $request): void {
        if (!key_exists($request->method, $this->routes_)) {
            throw new Error("'{$request->method}' method is not supported");
        }

        if (!key_exists($request->url, $this->routes_[$request->method])) {
            new ViewResponse("404");
            return;
        }

        $this->routes_[$request->method][$request->url]($request);

        $db = Container::get("database");
        $db->closeConnection();
    }
}
