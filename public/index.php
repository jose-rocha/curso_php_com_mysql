 <?php
    // O arquivo banco.php já carrega o autoload e as variáveis de ambiente
    require_once './utils/connectDB.php';
    require './utils/class/ShowThumb.php';
    require_once './components/headLinks.php';

    use public\utils\class\GetPagination;
    use public\utils\class\Notificacoes;
    use public\utils\class\VerifyAuth;

    // echo $thumb->render('assets/images/capas_jogos/mario.png'); 

    // As variáveis de ambiente já estão disponíveis através do banco.php
    // var_dump($resultado); 
    // var_dump($_ENV);

    // echo $ordenacao;
    $busca = $_GET['busca'];
    // echo empty($busca) ? 'vazio' : 'algo';
    $notificacoes = new Notificacoes;
    // echo $notificacoes->msg_erro();
    // session_start();
    $verifyAuth = new VerifyAuth;

    // Verifica se o usuário está logado antes de verificar o tipo
    // if ($verifyAuth->isLoged()) {
        // echo $verifyAuth->verifyTypeUser($_SESSION['tipo']);
    // } else {
    //     echo "Usuário não logado";
    // }
    $getPagination = new GetPagination;

    $busca = $_GET['busca'];
    $ordenacao = $_GET['ordenacao'] ?? 'nome';

    $pagina = $_GET['pagina'] ?? 1;
    // Validar página para garantir que seja um número positivo
    $pagina = max(1, intval($pagina)); // Garante que seja no mínimo 1
    
    $porPagina = 4;
    $inicio = ($pagina - 1) * $porPagina;

    $stmt = $getPagination->paginationDataTable($busca, $ordenacao, $inicio, $porPagina)['resultado'];
    $stmt->execute();
    $tableGames = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // print_r($tableGames);
    // print("Quantidade de jogos encontrados: " . count($tableGames));
    $count = $getPagination->paginationDataTable($busca, $ordenacao, $inicio, $porPagina)['count'];
    $qtdPage = ceil($count / $porPagina);

    $linkActive = fn(string $param) => $ordenacao === $param ? 'text-danger fw-bold': null;
?>

 <!DOCTYPE html>
 <html lang="pt-BR">
 <title><?= htmlspecialchars(titlePage('Home')) ?></title>

 <body>
     <?php require_once './components/header.php' ?>

     <main>
         <div id="corpo">
             <h1>Escolha Seu Jogo</h1>

             <form acction="/" method="GET" class="d-flex row col-12 col-lg-auto mb-3 mb-lg-0" role="search">
                 <div class="d-flex align-items-center col-12 col-lg-8 col-md-8 col-sm-12 col-xs-12">

                     <span> Ordenar por:
                         <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover <?= $linkActive('nome');?>"
                             href='<?php echo !empty($busca) ? "/?ordenacao=nome&busca={$busca}" : "/?ordenacao=nome" ?>'>
                             <!-- Adiconado o &busca=<?php echo  $busca;?> 
                                  para quando pesquisar por algo na busca e de pois clicar em um dos links
                                  de ordenação ele fazer a ordenação certa do item pesquisado
                            -->
                             Nome
                         </a> |
                         <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover <?= $linkActive('produtora');?>"
                             href='<?php echo !empty($busca) ? "/?ordenacao=produtora&busca={$busca}" : "/?ordenacao=produtora" ?>
                         '>
                             Produtora
                         </a> | <a
                             class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover  <?= $linkActive('nota-alta');?>"
                             href='<?php echo !empty($busca) ? "/?ordenacao=nota-alta&busca=$busca" : "/?ordenacao=nota-alta" ?>'>
                             Nota Alta
                         </a> |
                         <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover <?= $linkActive('nota-baixa');?>"
                             href='<?php echo !empty($busca) ? "/?ordenacao=nota-baixa&busca=$busca" : "/?ordenacao=nota-baixa"?>'>
                             Nota Baixa
                         </a>
                         <!-- |
                         <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
                             href="/">
                             Mostrar Todos
                         </a> -->
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
                 <!-- <?php 
                    echo "Quantidade de jogos encontrados: " . count($tableGames);
    
                    foreach($tableGames as $key => $value) {
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
                                {$verifyAuth->getActionIcons($_SESSION['tipo'], $value['cod'])}                                    
                            </tr>
                        ";
                 }
                 ?> -->

                 <?= "Quantidade de jogos encontrados: " . count($tableGames);?>
                 <?php foreach($tableGames as $key => $value): ?>
                 <?php
                    $capa = $thumb->renderImg("assets/images/capas_jogos/{$value['capa']}", 'capa');
                    $nota = number_format($value['nota'], 1);
                 ?>
                 <tr>
                     <td><?=$capa?></td>
                     <td>
                         <a href="/detalhes.php?cod=<?=$value['cod']?>"><?=$value['nome']?></a> <br>
                         <i class='bi bi-joystick'></i> <?=$value['ge_genero']?> <br>
                         <i class='bi bi-building'></i> <?=$value['pr_produtora']?>
                         <span style='float: inline-end; margin-right: 5px;'>
                             <i class='bi bi-star-fill'></i> Nota: <?=$nota?>/10
                         </span>
                     </td>
                     <?= $verifyAuth->getActionIcons($_SESSION['tipo'], $value['cod']) ?>
                 </tr>
                 <?php endforeach; ?>
             </table>

             <div class="pt-2 d-flex justify-content-end">
                 <form action="/" method="GET"></form>
                 <nav aria-label="Page navigation example">
                     <ul class="pagination">
                         <li class="page-item">
                             <a class="page-link <?= $pagina === 1 ? 'disabled' : null;?>"
                                 href="/?pagina=<?=$pagina === 1 ? 1 : $pagina - 1?>">
                                 Anterior
                             </a>
                         </li>
                         <li class="page-item"><a class="page-link"
                                 href="/"><?=$pagina . "/" .  $qtdPage . " de " . $count;?></a>
                         </li>
                         <li class="page-item">
                             <a class="page-link <?= intval($pagina) === intval($qtdPage) ? 'disabled' : null;?>"
                                 href="/?pagina=<?=intval($pagina) === intval($qtdPage) ? $qtdPage : $pagina + 1?>">
                                 Próxima
                             </a>
                         </li>

                     </ul>
                 </nav>

             </div>
         </div>
     </main>

     <?php 
        require_once './components/footer.php';

        closeConnectionDB($db, $resultado);
        // var_dump($resultado);
     ?>
 </body>

 </html>