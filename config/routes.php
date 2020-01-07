<?php

use Core\{Container, Router};
use Core\Response\{JsonResponse, ViewResponse};

Router::get("/", function () {
    /** @var PDO $connection */
    $connection = Container::get("database")->getConnection();
    $statement = $connection->prepare("SELECT * from test");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return new JsonResponse($result);
});

Router::get("/test", function () {
    return new ViewResponse("test");
});

Router::get("/something", function () {
    return new JsonResponse(["message" => "this is json"]);
});

