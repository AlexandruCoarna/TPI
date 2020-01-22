<?php /** @noinspection PhpIncludeInspection */

namespace Core\Response;

use Error;

class ViewResponse {
    public function __construct($path, array $args = [], int $http_response_code = 200) {
        $fullPath = ROOT . "/public/views/{$path}.view.php";

        if (!file_exists($fullPath)) {
            throw new Error("The '{$path}' view doesn't exist");
        }

        extract($args);

        http_response_code($http_response_code);
        header("Content-Type: text/html");

        return require_once $fullPath;
    }
}
