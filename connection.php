<?php

class Database
{
    public const HOST = "localhost";
    public const USERNAME = "root";
    public const PASSWORD = "";
    public const NAME = "quickfix";
}

abstract class ObjectPool
{
    private int $expirationTime;
    private array $locked, $unlocked;
    private array $objects;
    
    public function __construct()
    {
        $this->expirationTime = 30000; // 30 seconds
        $this->locked = array();
        $this->unlocked = array();
        $this->objects = array();
    }

    abstract protected function create(): Object;

    abstract public function validate(Object $o): bool;

    abstract public function expire(Object $o): void;

    public function checkOut(): Object
    {
        $now = time();
        if (count($this->unlocked) > 0) {
            foreach ($this->unlocked as $objId => $time) {
                $o = $this->objects[$objId];
                if (($now - $time) > $this->expirationTime) {
                    unset($this->unlocked[$objId]);
                    unset($this->objects[$objId]);
                    $this->expire($o);
                    $o = null;
                }
                else {
                    if ($this->validate($o)) {
                        unset($this->unlocked[$objId]);
                        $this->locked[$objId] = time();
                        return $o;
                    }
                    else {
                        unset($this->unlocked[$objId]);
                        unset($this->objects[$objId]);
                        $this->expire($o);
                        $o = null;
                    }   
                }
            }
        }
        $o = $this->create();
        $id = spl_object_hash($o);
        $this->objects[$id] = $o;
        $this->locked[$id] = time();
        return $o;
    }

    public function checkIn(Object $o): void
    {
        $id = array_search($o, $this->objects);
        unset($this->locked[$id]);
        $this->unlocked[$id] = time();
    }
}


class Connection{
    private mysqli $connection;

    public function __construct(String $host, String $dbusername, String $dbpassword, String $dbname)
    {
        $this->connection = new mysqli($host, $dbusername, $dbpassword, $dbname);

        if ($this->connection->connect_errno) {
            echo "Failed to connect to MySQL: " . $this->connection -> connect_error;
            exit();
        }
    }

    public function close(): void
    {
        $this->connection->close();
    }

    public function is_valid(): bool
    {
        if ($this->connection->connect_errno) {
            return false;
        }
        return true;
    }

    public function query(String $query): mysqli_result|bool
    {
        return $this->connection->query($query);
    }

    public function real_escape_string($string){
        return $this->connection->real_escape_string($string);
    }

    public function insert_id(){
        return $this->connection->insert_id;
    }
}

class ConnectionPool extends ObjectPool
{
    private String $host;
    private String $dbusername;
    private String $dbpassword;
    private String $dbname;
    private static ConnectionPool $connectionPool;

    private function __construct(String $host, String $dbusername, String $dbpassword, String $dbname)
    {
        parent::__construct();
        $this->host = $host;
        $this->dbusername = $dbusername;
        $this->dbpassword = $dbpassword;
        $this->dbname = $dbname;
    }

    public static function getInstance(): ConnectionPool
    {
        if (!isset(self::$connectionPool) || is_null(self::$connectionPool)) {
            self::$connectionPool = new ConnectionPool(Database::HOST, Database::USERNAME, Database::PASSWORD, Database::NAME);
        }
        return self::$connectionPool;
    }

    protected function create(): Connection
    {
        return new Connection($this->host, $this->dbusername, $this->dbpassword, $this->dbname);
    }

    public function validate(Object $conn): bool
    {
        return $conn->is_valid();
    }

    public function expire(Object $conn): void
    {
        $conn->close();
    }

    public function getConnection(): Connection
    {
        return parent::checkOut();
    }

    public function releaseConnection(Connection $conn): void
    {
        parent::checkIn($conn);
    }

}

class QueryHandler{
    public static $insert_id;
    public static function query(String $query): mysqli_result|bool
    {
        $connectionPool = ConnectionPool::getInstance();
        $connection = $connectionPool->getConnection();
        $result = $connection->query($query);
        QueryHandler::$insert_id = $connection->insert_id();
        $connectionPool->releaseConnection($connection);
        return $result;
    }

    public static function real_escape_string($string)
    {
        $connectionPool = ConnectionPool::getInstance();
        $connection = $connectionPool->getConnection();
        $string = $connection->real_escape_string($string);
        $connectionPool->releaseConnection($connection);
        return $string;
    }


}

?>