 <?php
    // O arquivo banco.php já carrega o autoload e as variáveis de ambiente
    require_once './utils/connectDB.php';
    require './utils/ShowThumb.php';

    // echo $thumb->render('assets/images/capas_jogos/mario.png'); 

    // As variáveis de ambiente já estão disponíveis através do banco.php
    // var_dump($resultado); 
    // var_dump($_ENV);
?>

 <!DOCTYPE html>
 <html lang="pt-BR">
 <?php require_once './components/headLinks.php' ?>


 <body>
     <?php require_once './components/header.php' ?>

     <div id="corpo">
         <h1>Escolha Seu Jogo</h1>

         <form class="d-flex row col-12 col-lg-auto mb-3 mb-lg-0" role="search">
             <div class="d-flex align-items-center col-12 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                 <span>Ordenar por: Nome | Produtora | Nota Alta | Nota Baixa | Buscar </span>
             </div>


             <div class="d-flex align-items-center col-12 col-lg-4 col-md-4 col-sm-12 col-xs-12 gap-1 p-1">
                 <div class="input-group">
                     <input type="search" class="form-control" name="busca">

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
                    
                    echo "
                        <tr>
                            <td>{$capa}</td>
                            <td>
                                <a href='/detalhes.php?cod={$value['cod']}'>{$value['nome']}</a> <br>
                                <i class='bi bi-joystick'></i> {$value['ge_genero']} <br>
                                <i class='bi bi-building'></i> {$value['pr_produtora']}
                            </td>
                            <td>Adm</td>
                        </tr>
                    ";
                }
             ?>
         </table>
     </div>

     <?php 
        require_once './components/footer.php';

        closeConnectionDB($db, $resultado);
        // var_dump($resultado);
     ?>
 </body>

 </html>