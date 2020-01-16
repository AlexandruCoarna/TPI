<?php /** @noinspection PhpIncludeInspection */

namespace Core;

use Error;

class Container {
    private static ?Container $instance = null;

    private static array $container = [];

    private array $container_ = [];

    private function __construct($container) {
        $this->container_ = $container;
    }

    public static function init() {
        $path = ROOT . "/config/services.php";

        if (!file_exists($path)) {
            throw new Error("service.php must be in config directory, be sure you declare all your services in there!");
        }

        require_once $path;

        return !self::$instance ? self::$instance = new self(self::$container) : self::$instance;
    }

    public static function register(string $name, $item) {
        if (key_exists($name, self::$container)) {
            throw new Error("'{$name}' is already registered in the Container!");
        }

        self::$container[$name] = $item;
    }

    public static function get(string $name) {
        if (!self::$instance) {
            throw new Error("You can't retrieve items from container before initialisation!");
        }

        return self::$instance->getItem($name);
    }

    private function getItem(string $name) {
        if (!key_exists($name, $this->container_)) {
            throw new Error("The service '{$name}' you are looking for is not defined!");
        }

        return $this->container_[$name];
    }
}
