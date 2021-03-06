<?php /** @noinspection PhpIncludeInspection */

namespace Core;

use Core\database_drivers\Mysql;
use PDO;

class Database
{
    private array $drivers = [
        "mysql" => Mysql::class
    ];

    private ?PDO $connection = null;

    public function __construct()
    {
        $this->makeConnection();
    }

    private function makeConnection()
    {
        $driver = '';
        $connections = [];

        require_once ROOT . "/config/database.php";

        $this->connection = $this->drivers[$driver]::connect($connections[$driver]);
    }

    public function getConnection()
    {
        if (!$this->connection) {
            $this->makeConnection();
            return $this->connection;
        }

        return $this->connection;
    }

    public function closeConnection()
    {
        $this->connection = null;
    }
}
