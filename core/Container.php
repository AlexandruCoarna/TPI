<?php /** @noinspection PhpIncludeInspection */

namespace Core;

class Container
{
    private static ?Container $instance = null;

    private static array $container = [];

    private array $container_ = [];

    private function __construct($container) {
        $this->container_ = $container;
    }

    public static function init() {
        require "{$_SERVER['DOCUMENT_ROOT']}/config/services.php";
        return !self::$instance ? self::$instance = new self(self::$container) : self::$instance;
    }

    public static function register(string $name, $item) {
        self::$container[$name] = $item;
    }

    public static function get(string $name) {
        return self::$instance->getItem($name);
    }

    public function getItem(string $name) {
        return $this->container_[$name];
    }
}
