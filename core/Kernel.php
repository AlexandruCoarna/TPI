<?php

namespace Core;

class Kernel
{
    public function __construct() {
        $this->run();
    }

    private function run() {
        Container::register("database", new Database());
        Container::init();
        Router::init()->handle(new Request());
    }
}
