<?php

namespace Core;

use Core\Response\JsonResponse;
use Error;
use Exception;

class Kernel
{
    public function __construct() {
        $this->run();
    }

    private function run() {
        try {
            Container::register("database", new Database());
            Container::init();
            Router::init()->handle(new Request());
            return 0;
        } catch (Exception | Error $exception) {
            return new JsonResponse([
                "message" => $exception->getMessage(),
                "stack" => $exception->getTrace()
            ]);
        }
    }
}
