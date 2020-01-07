<?php /** @noinspection PhpIncludeInspection */

namespace Core;

use Core\DatabaseDrivers\Mysql;
use PDO;

class Database
{
    private array $drivers = [
        "mysql" => Mysql::class
    ];
    private ?PDO $connection = null;

    public function __construct() {
        $this->makeConnection();
    }

    private function makeConnection() {
        $driver = '';
        $connections = [];

        require "{$_SERVER['DOCUMENT_ROOT']}/config/database.php";

        $this->connection = $this->drivers[$driver]::connect($connections[$driver]);
    }

    public function getConnection() {
        if (!$this->connection) {
            $this->makeConnection();
            return $this->connection;
        }

        return $this->connection;
    }

    public function removeConnection() {
        $this->connection = null;
    }
}
