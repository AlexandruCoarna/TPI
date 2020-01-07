<?php

namespace Core;

class Request
{
    public string $url;
    public string $method;
    public array $body;
    public array $queryParams;

    public function __construct() {
        $this->url = explode('?', $_SERVER['REQUEST_URI'])[0];
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->queryParams = $_GET;

        $phpFileContent = json_decode(file_get_contents("php://input"), true);

        if ($phpFileContent && count($phpFileContent)) {
            $this->body = $phpFileContent;
        } else {
            $this->body = $_POST;
        }
    }
}
