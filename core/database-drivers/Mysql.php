<?php

namespace Core\DatabaseDrivers;

use PDO;

class Mysql implements DriverInterface
{
    public static function connect(array $config) {
        $dsn = "mysql:dbname={$config['database']};host={$config['host']}";
        return new PDO($dsn, $config['username'], $config['password']);
    }
}
