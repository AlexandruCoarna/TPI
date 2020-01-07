<?php

use Core\Router;
use Core\Response\{ViewResponse, Response, JsonResponse};

Router::get("/", function () {
    return new Response("This is Homepage");
});

Router::get("/test", function () {
    return new ViewResponse("test");
});

Router::get("/something", function () {
    return new JsonResponse(["message" => "this is json"]);
});

