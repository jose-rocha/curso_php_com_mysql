 <?php
    // O arquivo banco.php já carrega o autoload e as variáveis de ambiente
    require './includes/banco.php';
    require './utils/ShowThumb.php';

    // echo $thumb->render('assets/images/capas_jogos/mario.png'); 

    // As variáveis de ambiente já estão disponíveis através do banco.php
    // var_dump($resultado); 
    // var_dump($_ENV);
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
                echo "Quantidade de jogos encontrados: " . count($resultado);

                foreach($resultado as $key => $value) {
                    // echo $value['capa'];
                    $capa = $thumb->renderImg("assets/images/capas_jogos/{$value['capa']}", 'capa');
                    
                    echo "
                        <tr>
                            <td>{$capa}</td>
                            <td><a href='/detalhes.php?cod={$value['cod']}'>{$value['nome']}</a></td>
                            <td>Adm</td>
                        </tr>
                    ";
                }
             ?>
         </table>
     </div>
     <?php 
        closeConnectionDB($db, $resultado);
        // var_dump($resultado);
     ?>
 </body>

 </html>