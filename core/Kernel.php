<?php

namespace Core;

class Kernel
{
    public function __construct() {

    }

    private function run() {

    }

    private function makeConnection() {

    }

    private function setContainer() {
        Container::init();
    }

    private function route() {
        Router::init()->handle(new Request());
    }
}
