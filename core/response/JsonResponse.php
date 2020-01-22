<?php

namespace Core\Response;

class JsonResponse {
    public function __construct(array $arr, int $http_response_code = 200) {
        http_response_code($http_response_code);
        header("Content-Type: application/json");
        echo json_encode($arr);
    }
}
