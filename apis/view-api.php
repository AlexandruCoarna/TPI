<?php

use Core\{Router};
use Core\Response\ViewResponse;

Router::get("/", function () {
    return new ViewResponse("student-list");
});

Router::get("/add-student", function () {
    return new ViewResponse("add-student");
});
