<?php

namespace Singletons;

use PDO;
use PDOException;

class Database {
    private $host = 'localhost';
    private $db_name = 'ecommerce';
    private $username = 'root';
    private $password = '';
    private $conn;
    private static $instance = null;

    public function __construct() {
        $this->connect();
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    private function connect() {
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }
    }


    public function execute($sql, $params = []) {
        try {
            $stmt = $this->conn->prepare($sql);
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo 'Query Error: ' . $e->getMessage();
            return false;
        }
    }

    public function fetchAll($sql, $params = []) {
        $stmt = $this->execute($sql, $params);
        return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : false;
    }

    public function fetch($sql, $params = []) {
        $stmt = $this->execute($sql, $params);
        return $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : false;
    }

    public function lastInsertId() {
        return $this->conn->lastInsertId();
    }

    // Prevent cloning and unserializing of the singleton instance
    private function __clone() {
    }
    private function __wakeup() {
    }
}
