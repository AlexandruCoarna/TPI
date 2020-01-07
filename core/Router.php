<?php /** @noinspection PhpIncludeInspection */

namespace Core;

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
        require_once "{$_SERVER['DOCUMENT_ROOT']}/config/routes.php";

        if (!self::$instance) {
            return self::$instance = new self(self::$routes);
        }

        self::$instance->alterRoutes(self::$routes);

        return self::$instance;
    }

    public function handle($request): Router {
        if (!key_exists($request->url, $this->routes_[$request->method])) {
            header("Location: http://localhost:8000");
        }

        $this->routes_[$request->method][$request->url]($request);

        return $this;
    }

    private function alterRoutes($routes): void {
        $this->routes_ = $routes;
    }

    public static function get($url, $method): void {
        self::$routes["GET"][$url] = $method;
    }

    public static function post($url, $method): void {
        self::$routes["POST"][$url] = $method;
    }
}
