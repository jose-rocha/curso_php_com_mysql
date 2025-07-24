<?php
    require_once __DIR__ . '/../vendor/autoload.php';
    require_once './components/headLinks.php';

    use public\utils\class\Notificacoes;
    use public\utils\class\GerarHash; 
    use public\utils\class\ConnectDB;

    // var_dump($_POST);
    $generateHash = new GerarHash;
    // echo $generateHash->gerarHashDefault('Jose2008') . "<br><br><br><br><br><br><br>";
    // echo $generateHash->validaHash('teste', '$2y$12$AUbZ5VG/dbEB4IbCARy1wOW/FTcSOfBfhsN/t0qQak1k9/a6zMWHG');

        // $_SESSION['user'] = null;
        // $_SESSION['nome'] = null;
        // $_SESSION['tipo'] = null;
        // $_SESSION['message_erro'] = false;

    session_start();

    if(!isset($_SESSION['user'])) {
        $_SESSION['user'] = null;
        $_SESSION['nome'] = null;
        $_SESSION['tipo'] = null;
        $_SESSION['message_erro'] = false;
    }

    $notificacoes = new Notificacoes;
    $gerarHash = new GerarHash;
    $connDB = new ConnectDB;
    $db = $connDB->getConnectDB();
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

        $query = "select usuario, nome, senha, tipo from usuarios where usuario = '$usuario' limit  1;";
        $usuarioExiste = $db->query($query)->rowCount();

        if(!$usuarioExiste) {
            $_SESSION['message_erro'] = true;

            return;          
        } 
        
        $dataUser = $db->query($query)->fetch(PDO::FETCH_ASSOC);
        // echo $usuarioExiste;
        // var_dump($dataUser['senha']);
        if($gerarHash->validaHash($senha, $dataUser['senha'])) {
                echo  "Logado com sucesso!  {$dataUser['usuario']}";

            $_SESSION['user'] = $dataUser['usuario'];
            $_SESSION['nome'] = $dataUser['nome'];
            $_SESSION['tipo'] =  $dataUser['tipo'];
            $_SESSION['message_erro'] = false;

            header("Location: /");

            return;
        }

        $_SESSION['message_erro'] = true;
        
        require './components/form_login.php';        
        // echo $notificacoes->msg_erro('Usuário ou senha inválida!');            
        

        die();
    ?>
</body>

</html>