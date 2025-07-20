 <?php
    // O arquivo banco.php já carrega o autoload e as variáveis de ambiente
    require_once './utils/connectDB.php';
    require './utils/ShowThumb.php';

    // echo $thumb->render('assets/images/capas_jogos/mario.png'); 

    // As variáveis de ambiente já estão disponíveis através do banco.php
    // var_dump($resultado); 
    // var_dump($_ENV);

    // echo $ordenacao;
    $busca = $_GET['busca'];
    // echo empty($busca) ? 'vazio' : 'algo';
?>

 <!DOCTYPE html>
 <html lang="pt-BR">
 <?php require_once './components/headLinks.php' ?>

 <body>
     <?php require_once './components/header.php' ?>

     <main>
         <div id="corpo">
             <h1>Escolha Seu Jogo</h1>

             <form acction="/" method="GET" class="d-flex row col-12 col-lg-auto mb-3 mb-lg-0" role="search">
                 <div class="d-flex align-items-center col-12 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                     <span> Ordenar por:
                         <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
                             href='<?php echo !empty($busca) ? "/?ordenacao=nome&busca={$busca}" : "/?ordenacao=nome" ?>'>
                             <!-- Adiconado o &busca=<?php echo  $busca;?> 
                                  para quando pesquisar por algo na busca e de pois clicar em um dos links
                                  de ordenação ele fazer a ordenação certa do item pesquisado
                            -->
                             Nome
                         </a> |
                         <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
                             href='<?php echo !empty($busca) ? "/?ordenacao=produtora&busca={$busca}" : "/?ordenacao=produtora" ?>
                         '>
                             Produtora
                         </a> | <a
                             class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
                             href='<?php echo !empty($busca) ? "/?ordenacao=nota-alta&busca=$busca" : "/?ordenacao=nota-alta" ?>'>
                             Nota Alta
                         </a> |
                         <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
                             href='<?php echo !empty($busca) ? "/?ordenacao=nota-baixa&busca=$busca" : "/?ordenacao=nota-baixa"?>'>
                             Nota Baixa
                         </a> |
                         <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
                             href="/">
                             Mostrar Todos
                         </a>
                     </span>
                 </div>


                 <div class="d-flex align-items-center col-12 col-lg-4 col-md-4 col-sm-12 col-xs-12 gap-1 p-1">
                     <div class="input-group">
                         <input autofocus type="search" class="form-control" name="busca" placeholder="Buscar">

                         <!-- <div class="input-group-text p-0" id="btnGroupAddon"> -->
                         <button type="submit" class="btn bg-primary text-white ">
                             <i class='bi bi-search'></i>
                         </button>

                         <!-- </div> -->

                     </div>
                 </div>
             </form>


             <table class="listagem">
                 <?php 
                    echo "Quantidade de jogos encontrados: " . count($resultado);
    
                    foreach($resultado as $key => $value) {
                        // echo $value['capa'];
                        $capa = $thumb->renderImg("assets/images/capas_jogos/{$value['capa']}", 'capa');
                        $nota = number_format($value['nota'], 1);
                        
                        echo "
                            <tr>
                                <td>{$capa}</td>
                                <td>
                                    <a href='/detalhes.php?cod={$value['cod']}'>{$value['nome']}</a> <br>
                                    <i class='bi bi-joystick'></i> {$value['ge_genero']} <br>
                                    <i class='bi bi-building'></i> {$value['pr_produtora']}
                                    <span style='float: inline-end; margin-right: 5px;'>
                                    <i class='bi bi-star-fill' ></i> Nota: $nota/10
                                    </span> 
                                </td>
                                <td>Adm</td>
                            </tr>
                        ";
                    }
                 ?>
             </table>
         </div>
     </main>

     <?php 
        require_once './components/footer.php';

        closeConnectionDB($db, $resultado);
        // var_dump($resultado);
     ?>
 </body>

 </html>