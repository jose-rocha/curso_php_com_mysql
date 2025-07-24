<?php

namespace public\utils\class;

use Dotenv\Dotenv;
use PDO;

class ConnectDB
{
    private $dotenv;
    private $db_host;
    private $db_name;
    private $db_username;
    private $db_password;

    public function getConnectDB()
    {     
            $this->dotenv = Dotenv::createImmutable(__DIR__ . '/../../..');
            $this->dotenv->load();
            $this->db_host = isset($_ENV['DB_HOST']) ? $_ENV['DB_HOST'] : null;
            
            $this->db_name = isset($_ENV['DB_NAME']) ? $_ENV['DB_NAME'] : null;
            $this->db_username = isset($_ENV['DB_USERNAME']) ? $_ENV['DB_USERNAME'] : null;
            $this->db_password = isset($_ENV['DB_PASSWORD']) ? $_ENV['DB_PASSWORD'] : null;
            
            $db = new PDO("pgsql:host=$this->db_host;dbname=$this->db_name", $this->db_username, $this->db_password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // return [$this->db_host, $db_name, $db_username, $db_password];
            return $db;
    }
}