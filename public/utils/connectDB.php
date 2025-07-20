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

$ordenacao = $_GET['ordenacao'];
// var_dump($_ENV);


try {
    $db = new PDO("pgsql:host=$db_host;dbname=$db_name", $db_username, $db_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // echo "Conexão com o banco realizada com sucesso!<br>";
    
    // Teste de consulta
/*    $resultado = $db->query(
     "select j.cod, j.nome, j.capa, j.produtora,
                     g.cod as cod_genero, g.genero as ge_genero,
                     p.cod as cod_produtora, p.produtora as pr_produtora
                 from jogos j
                 join generos g on j.genero = g.cod
                 join produtoras p on j.produtora = p.cod 
             "
         );
    Tive que adicionar a variável $query para poder concatenar string com a string do orde by no switch,
    se eu tentasse concatenar no switch a $resultado ou $db geraria erro 
    pq eu eu estaria tentando concatenar objeto com string, eu estaria fazendo isso

    $db->query("SELECT..."); // Retorna um PDOStatement object
    $db = "order by j.cod asc"; // Agora $db é uma string!

    estaria sobrescrevendo a conexão do banco ($db) com uma string, perdendo a conexão!

    Isso geraria um SQL inválido:
    $db->query("SELECT ... FROM jogos") + "order by j.cod asc"
    Resultado: PDOStatement object + string = ERRO!

*/

    $query = "select j.cod, j.nome, j.capa, j.produtora, j.nota,
                        g.cod as cod_genero, g.genero as ge_genero,
                        p.cod as cod_produtora, p.produtora as pr_produtora
                    from jogos j
                    join generos g on j.genero = g.cod
                    join produtoras p on j.produtora = p.cod";


    switch($ordenacao) {
        case "cod":
            $query .= " order by j.cod asc";
            break; 
        case "produtora":
            $query .= " order by pr_produtora asc";
            break;
        case "nota-alta":
            $query .= " order by j.nota desc";
            break;
        case "nota-baixa":
            $query .= " order by j.nota asc";
            break;
        default:
            $query .= " order by j.nome asc";
    }
    

    $resultado = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
     // echo "Número de jogos encontrados: " . count($resultado);
    //  var_dump($ordenacao);
    
} catch (PDOException $e) {
    echo "Conexão falhou: " . $e->getMessage();
    // die();
}


// Função para limpar dados e conexão e evitar vazamento de memória
function closeConnectionDB(&$conexao, &$dados) {
    $conexao = null;  // Fecha conexão
    $dados = null;    // Remove dados da memória
}