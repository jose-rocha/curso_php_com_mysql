<?php
// Carrega o autoloader do Composer
require_once __DIR__ . '/../../vendor/autoload.php';
// var_dump(__DIR__ . '/../../vendor/autoload.php');

// Carrega as variáveis de ambiente do arquivo .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../..');
$dotenv->load();

$db_host = $_ENV['DB_HOST'];
$db_name = $_ENV['DB_NAME'];
$db_username = $_ENV['DB_USERNAME'];
$db_password = $_ENV['DB_PASSWORD'];


// var_dump($_ENV);

try {
    $db = new PDO("pgsql:host=$db_host;dbname=$db_name", $db_username, $db_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // echo "Conexão com o banco realizada com sucesso!<br>";
    
    // Teste de consulta
    $resultado = $db->query("select * from jogos")->fetchAll(PDO::FETCH_ASSOC);
    // echo "Número de jogos encontrados: " . count($resultado);
    
} catch (PDOException $e) {
    echo "Conexão falhou: " . $e->getMessage();
    die();
}