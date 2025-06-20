<?php

namespace Core;

class Database
{
    private static $instance = null;
    private $connection;

    private function __construct()
    {
        $host = $_ENV['DB_HOST'] ?? 'localhost';
        $dbname = $_ENV['DB_NAME'] ?? '';
        $username = $_ENV['DB_USER'] ?? '';
        $password = $_ENV['DB_PASS'] ?? '';

        try {
            echo "Connecting to MySQL: host=$host, user=$username, db=$dbname\n";
            
            $this->connection = new \mysqli($host, $username, $password, $dbname);
            
            if ($this->connection->connect_error) {
                throw new \Exception("Connection failed: " . $this->connection->connect_error);
            }
            
            echo "Connected successfully to MySQL\n";
            $this->connection->set_charset("utf8mb4");
            
        } catch (\Exception $e) {
            echo "Database connection error: " . $e->getMessage() . "\n";
            throw $e;
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function query($sql)
    {
        try {
            echo "Executing SQL: $sql\n";
            $result = $this->connection->query($sql);
            if ($result === false) {
                throw new \Exception("Query failed: " . $this->connection->error);
            }
            return $result;
        } catch (\Exception $e) {
            echo "Query error: " . $e->getMessage() . "\n";
            throw $e;
        }
    }

    public function prepare($sql)
    {
        return $this->connection->prepare($sql);
    }

    public function begin_transaction()
    {
        return $this->connection->begin_transaction();
    }

    public function commit()
    {
        return $this->connection->commit();
    }

    public function rollback()
    {
        return $this->connection->rollback();
    }

    public function error()
    {
        return $this->connection->error;
    }
} 