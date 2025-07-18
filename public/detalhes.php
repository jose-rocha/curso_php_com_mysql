<?php
    require_once './includes/banco.php';
    require_once './utils/ShowThumb.php';
    
    $cod_jogo = $_GET['cod'] ?? null;
    $data = null;

    // echo !!$data === null;

    if(!$cod_jogo ) {
        // var_dump($cod_jogo);
        echo "
            <link rel='stylesheet' href='./assets//css/styles.css'>
            
            <div id='corpo'>
                <h1>Código do jogo forcecido é inválido!</h1>
            </div>"
        ;

        return;
    } else {
        $data = $db->query("select * from jogos where cod = $cod_jogo")->fetchAll(PDO::FETCH_ASSOC);

    }

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets//css/styles.css">
    <title>Detalhes do Jogo</title>
</head>

<body>
    <div id="corpo">
        <div >
            <a href="/" style="text-decoration: none;" class="d-flex align-items-center gap-2">
                <i 
                    class="bi bi-arrow-left-circle"
                    style="font-size: 2rem;"
                ></i>
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
                    $capa = $thumb->renderImg("assets/images/capas_jogos/{$data[0]['capa']}", 'img_full');
                    $nota = number_format($data[0]['nota'], 1);
                    // var_dump($data);


                    echo "
                    <tr>
                        <td rowspan='3'>$capa</td>
                        <td>
                            <h2>{$data[0]['nome']}</h2>
                            <b>Nota:</b> {$nota}/10.0
                        </td>
                    </tr>

                    <tr>
                        <td>{$data[0]['descricao']}</td>
                    </tr>
                    
                    <tr>
                        <td>Adm</td>
                    </tr>
                ";
                ?>
        </table>

</body>

</html>