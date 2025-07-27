<?php
require '../vendor/autoload.php';
require_once './components/headLinks.php';

use public\utils\class\Notificacoes;
use public\utils\class\VerifyAuth;


session_start();

$verifyAuth = new VerifyAuth;
$notificacoes = new Notificacoes;

if (!$verifyAuth->isAdmin()) {
    header('Location: /');
    exit();
}

?>


<!DOCTYPE html>
<html lang="pt-BR">

<title><?= htmlspecialchars(titlePage('Novo Usuário')) ?></title>

<body>
    <?php require_once './components/header.php' ?>

    <main>
        <div id="corpo">
            <?php 
                echo $notificacoes->msg_sucesso("Usuário Criado com sucesso!");
            ?>
        </div>
    </main>

    <?php        
        require_once './components/footer.php';

        // closeConnectionDB($db, $resultado);
        // var_dump($resultado);
    ?>

    <script>
    setTimeout(() => document.location.href = '/', 3000);
    </script>
</body>

</html>