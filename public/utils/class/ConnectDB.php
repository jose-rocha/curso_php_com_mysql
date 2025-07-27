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


    //  public function insertInDB($queryParams)
    // {
    //    $db = $this->getConnectDB();
       
    //    // Executa a query e levanta exceção em caso de erro
    //    $result = $db->exec($queryParams);
       
    // //    // Verifica se afetou alguma linha
    //    if ($result === false) {
    //        throw new \PDOException("Erro ao executar a query: " . implode(" ", $db->errorInfo()));
    //    }
       
    //    return $result;
    //     // return $db;
    // }
    public function insertInDBPrepared(string $query, array $params): int
    {
        $db = $this->getConnectDB();
        $stmt = $db->prepare($query);

        if (!$stmt->execute($params)) {
            throw new \PDOException("Erro ao executar a query: " . implode(" ", $stmt->errorInfo()));
        }

        return $stmt->rowCount();
    }

    public function userExists($usuario)
    {
        $db = $this->getConnectDB();
        
        $query = "SELECT COUNT(*) FROM usuarios WHERE usuario = ?";
        $stmt = $db->prepare($query);
        
        if (!$stmt) {
            throw new \PDOException("Erro ao preparar query de verificação: " . implode(" ", $db->errorInfo()));
        }
        
        $stmt->execute([$usuario]);
        $count = $stmt->fetchColumn();
        
        return $count > 0;
    }

    public function getDataDB(string $query)
    {
        $db = $this->getConnectDB();
        
        return $db->query($query);
    }

}