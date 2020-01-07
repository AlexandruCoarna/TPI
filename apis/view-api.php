<?php

use Core\Container;
use Core\Response\ViewResponse;
use Core\Router;

Router::get("/", function () {
    /** @var PDO $connection */

    $connection = Container::get("database")->getConnection();
    $statement = $connection->prepare("SELECT * from test");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    return new ViewResponse("main", compact('result'));
});
