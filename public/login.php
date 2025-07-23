<?php

    
    require_once __DIR__ . '/../vendor/autoload.php';
    require_once './components/headLinks.php';

    use public\utils\class\GerarHash; 

    // var_dump($_POST);
    $generateHash = new GerarHash;
    // echo $generateHash->gerarHashDefault('Jose2008') . "<br><br><br><br><br><br><br>";
    // echo $generateHash->validaHash('teste', '$2y$12$AUbZ5VG/dbEB4IbCARy1wOW/FTcSOfBfhsN/t0qQak1k9/a6zMWHG');

        // $_SESSION['user'] = null;
        // $_SESSION['nome'] = null;
        // $_SESSION['tipo'] = null;

    session_start();

    if(!isset($_SESSION['user'])) {
        $_SESSION['user'] = null;
        $_SESSION['nome'] = null;
        $_SESSION['tipo'] = null;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<title><?= htmlspecialchars(titlePage('Login')) ?></title>

<body style="height: 100dvh;" class="d-flex justify-content-center align-items-center">
    <?php
            $usuario = $_POST['usuario'] ?? null;
            $senha = $_POST['senha'] ?? null;

            if(is_null($usuario) || is_null($senha)) {
                require './components/form_login.php';

                return;
            }

            echo "usuário logado.";

            // header("Location: /");

die();
        ?>
</body>

</html>