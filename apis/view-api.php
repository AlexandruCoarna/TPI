<?php

use Core\{Router};
use Core\Response\ViewResponse;

Router::get("/", function () {
    $title = "Student List";
    return new ViewResponse("student-list", compact("title"));
});

Router::get("/add-student", function () {
    $title = "Add Student";
    return new ViewResponse("add-student", compact("title"));
});
