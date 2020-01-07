<?php

use Core\{Router};
use Core\Response\ViewResponse;

Router::get("/", function () {
    return new ViewResponse("main");
});
