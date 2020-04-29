<?php

namespace Core;

use Core\response\JsonResponse;
use Error;
use Exception;

class Kernel
{
    private string $debug;

    public function __construct(bool $debug)
    {
        $this->debug = $debug;
        $this->run();
    }

    private function run()
    {
        try {
            Container::register("database", new Database());
            Container::init();
            Router::init()->handle(new Request());
            return 0;
        } catch (Exception | Error $exception) {
            if ($this->debug) {
                return new JsonResponse([
                    "message" => $exception->getMessage(),
                    "stack" => $exception->getTrace()
                ], 400);
            } else {
                return new JsonResponse([
                    "message" => $exception->getMessage(),
                ], 400);
            }

        }
    }
}
