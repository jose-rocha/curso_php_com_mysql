<?php
    require './includes/banco.php';

    // var_dump($resultado);   
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets//css/styles.css">
    <title>Home</title>
</head>
<body>
    <div id="corpo">
        <h1>Escolha Seu Jogo</h1>

        <table class="listagem">        
            <?php 
                foreach($resultado as $key => $value) {
                    // echo $value['capa'];
                    echo "
                        <tr>
                            <td>{$value['capa']}</td>
                            <td>{$value['nome']}</td>
                            <td>Adm</td>
                        </tr>
                    ";
                }
            ?>
        </table>
    </div>
</body>
</html>
