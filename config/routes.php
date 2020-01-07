<?php
/** @var Router $router */

use Core\Response\{ViewResponse, Response, JsonResponse};
use Core\Router;

$router->get("/", function () {
    return new Response("This is Homepage");
});

$router->get("/test", function () {
    return new ViewResponse("test");
});

$router->get("/something", function () {
    return new JsonResponse(["message" => "this is json"]);
});

