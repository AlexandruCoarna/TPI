<?php /** @noinspection PhpIncludeInspection */

namespace Core\Response;

use Error;

class ViewResponse {
    public function __construct($path, array $args = []) {
        $fullPath = ROOT . "/public/views/{$path}.view.php";

        if (!file_exists($fullPath)) {
            throw new Error("The '{$path}' view doesn't exist");
        }

        extract($args);

        header("Content-Type: text/html");
        return require_once $fullPath;
    }
}
