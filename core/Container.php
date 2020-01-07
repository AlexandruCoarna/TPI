<?php

namespace Core;

class Container
{
    private static Container $instance;

    private function __construct() {
    }

    public static function init() {
        return !self::$instance ? self::$instance = new self() : self::$instance;
    }
}
