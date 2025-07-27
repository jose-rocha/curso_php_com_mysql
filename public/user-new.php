<?php
// O arquivo banco.php já carrega o autoload e as variáveis de ambiente
require_once './utils/connectDB.php';
require_once './components/headLinks.php';

use public\utils\class\VerifyAuth;

session_start();

$verifyAuth = new VerifyAuth;

if (!$verifyAuth->isAdmin()) {
    header('Location: /');
    exit();
}

// $usuario = $_POST['usuario'] ?? null;
// $nome = $_POST['nome'] ?? null;
// $tipo = $_POST['tipo'] ?? null;
// $senha = $_POST['senha'] ?? null;
// $confirmeSenha['confirme_senha'] ?? null;
// ?>

<!DOCTYPE html>
<html lang="pt-BR">
<title><?= htmlspecialchars(titlePage('Novo Usuário')) ?></title>

<body>
    <?php require_once './components/header.php' ?>

    <main>
        <div id="corpo">
            <?php              
                require_once './components/formCreateUser.php';  
                
                // if (
                //     !empty($usuario) &&
                //     !empty($nome) &&
                //     !empty($tipo) &&
                //     !empty($senha) &&
                //     !empty($confirme_senha)
                // ) {    
                //     echo $notificacoes->msg_erro('Preencha todos os campos!');
                //     return;
                // }

                                
            ?>
        </div>
    </main>

    <?php        
        require_once './components/footer.php';

        // closeConnectionDB($db, $resultado);
        // var_dump($resultado);
    ?>
</body>

</html>