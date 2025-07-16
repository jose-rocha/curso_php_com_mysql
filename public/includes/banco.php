<?php
$db_host = 'localhost';
$db_name = 'bd_games';
$db_username = 'postgres';
$db_password = '5402';

try {
    $db = new PDO("pgsql:host=$db_host;dbname=$db_name", $db_username, $db_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // $db->query("select * from customer")->fetchAll(PDO::FETCH_ASSOC);



    //$arr = [];
    //    $arr = [
    //      'error' => '',
    //      'result' => []
    //    ];

    // $resultado = var_dump($db->query("select * from jogos limit 1")->fetchAll(PDO::FETCH_ASSOC));
    $resultado =  $db->query("select * from jogos")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Conexão falhou: " . $e->getMessage();
    die();
}
