<?php
    require_once './utils/connectDB.php';
    require_once './utils/class/ShowThumb.php';
    require_once './components/headLinks.php';
    
    $cod_jogo = $_GET['cod'] ?? null;
    $isEditando = $_POST['editando'] ?? null;
    $data = null;

    // echo $isEditando;

    // echo !!$data === null;

    // http://localhost:8001/detalhes.php?cod=11

    
    if(!$cod_jogo && !$isEditando) {
        // var_dump($cod_jogo);
        echo "
            <link rel='stylesheet' href='./assets//css/styles.css'>
            
            <div id='corpo'>
                <h1>Código do jogo forcecido é inválido!</h1>
            </div>
        ";
    
        return;
    } elseif($cod_jogo) {
        // $data = $db->query("select * from jogos where cod = $cod_jogo")->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $db->prepare("select * from jogos where cod = ?");
        $stmt->execute([$cod_jogo]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        // var_dump($data);
    } else {
        // $data = $db->query("select * from jogos where cod = $cod_jogo")->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $db->prepare("select * from jogos where cod = ?");
        $stmt->execute([$isEditando]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        // var_dump($data);
    }

    $idJogo = $_POST['editando'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<title><?= htmlspecialchars(titlePage('Detalhes do Jogo')) ?></title>

<body>
    <?php require_once './components/header.php' ?>


    <div id="corpo">
        <div>
            <a href="/" style="text-decoration: none; max-width: 100px;" class="d-flex align-items-center gap-2 mb-3">
                <i class="bi bi-arrow-left-circle" style="font-size: 2rem;"></i>
                Voltar
            </a>
        </div>

        <h1>
            <i class="bi bi-bookmark-check-fill"></i>
            Detalhes do Jogo
        </h1>
        <!-- <h1><?php echo $data[0]['nome']; ?></h1>
        <p><strong>Descrição:</strong> <?php echo $data[0]['descricao']; ?></p>
        <p><strong>Gênero:</strong> <?php echo $data[0]['genero']; ?></p> -->
        <!-- <p><strong>Plataforma:</strong> <?php echo $data[0]['plataforma']; ?></p>
        <p><strong>Data de Lançamento:</strong> <?php echo $data[0]['data_lancamento']; ?></p>
        <p><strong>Preço:</strong> R$ <?php echo number_format($data[0]['preco'], 2, ',', '.'); ?></p>
        <p><strong>Disponibilidade:</strong> <?php echo $data[0]['disponibilidade'] ? 'Disponível' : 'Indisponível'; ?>
        </p> -->

        <table class="detalhe_jogo">
            <?php
                // $capa = $thumb->renderImg("assets/images/capas_jogos/{$data[0]['capa']}", 'img_full');
                // $nota = number_format($data[0]['nota'], 1);
                $capa = $thumb->renderImg("assets/images/capas_jogos/{$data['capa']}", 'img_full');
                $nota = number_format($data['nota'], 1);
                // var_dump($data);
                $editGame = isset($_POST['editando'])
                    ? '
                        <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                    '
                    : null;

                echo "
                    <tr>
                        <td rowspan='3'>$capa</td>
                        <td>
                            <h2>{$data['nome']}</h2>
                            <b>Nota:</b> {$nota}/10.0
                            {$editGame}                             
                        </td>
                    </tr>

                    <tr>
                        <td>{$data['descricao']}</td>
                    </tr>
                    
                    <tr>
                        <td>Adm</td>
                    </tr>
                ";
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