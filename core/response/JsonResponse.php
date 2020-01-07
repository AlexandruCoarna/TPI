<?php

namespace Core\Response;

class JsonResponse
{
    public function __construct(array $arr) {
        echo json_encode($arr);
    }
}
