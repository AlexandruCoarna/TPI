<?php

use Core\{Response\JsonResponse, Router};

Router::get("/api/test", function () {
    return new JsonResponse(["message" => "It works"]);
});
