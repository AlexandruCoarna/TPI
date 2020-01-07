<?php

namespace Core\Response;

class ViewResponse
{
    public function __construct($path, array $args = []) {
        $root = $_SERVER["DOCUMENT_ROOT"];
        $fullPath = "{$root}/public/views/{$path}.view.php";

        if (!file_exists($fullPath)) {
            echo "View does not exists";
            return 1;
        }

        extract($args);

        return require_once $fullPath;
    }
}
