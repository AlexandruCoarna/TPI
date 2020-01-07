<?php

use Core\{Request, Router};

Router::get("/api/test", function (Request $request) {
    print_r($request);
});
