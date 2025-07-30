<?php
    require_once __DIR__ . '/../vendor/autoload.php';
    require_once './components/headLinks.php';

    use public\utils\class\Notificacoes;
    use public\utils\class\GerarHash; 
    use public\utils\class\ConnectDB;
    use public\utils\class\VerifyAuth;

   

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
        $_SESSION['message_usuario_inativo'] = false;
    }

    $verifyAuth = new VerifyAuth;
    $notificacoes = new Notificacoes;
    $gerarHash = new GerarHash;
    $connDB = new ConnectDB;
    $db = $connDB->getConnectDB();


    if($verifyAuth->isLoged()) {
        header('Location: /');
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
            require './components/formLogin.php';

            return;
        }
        
        try {
            $query = "select usuario, nome, senha, tipo, status from usuarios where usuario = '$usuario' limit  1;";
            $usuarioExiste = $db->query($query)->rowCount();

            if(!$usuarioExiste) {
                $_SESSION['message_erro'] = true;
                require './components/formLogin.php';

                return;          
            } 
            
            $dataUser = $db->query($query)->fetch(PDO::FETCH_ASSOC);
            // echo $usuarioExiste ? 'Usuário existe' : 'Usuário não existe';
            // echo($senha . '<br>' . $dataUser['senha'] . '<br><br>');

            
            if($gerarHash->validaHash($senha, $dataUser['senha'])) {
                if($dataUser['status'] === 0) {
                    $_SESSION['message_usuario_inativo'] = true;
                    
                    require './components/formLogin.php';
                    return;
                }

                echo  "Logado com sucesso!  {$dataUser['usuario']}";

                $_SESSION['user'] = $dataUser['usuario'];
                $_SESSION['nome'] = $dataUser['nome'];
                $_SESSION['tipo'] =  $dataUser['tipo'];
                $_SESSION['message_erro'] = false;
                $_SESSION['message_usuario_inativo'] = false;
                $_SESSION['message_usuario_inativo'] = false;

                header("Location: /");

                return;
            }

            $_SESSION['message_erro'] = true;
            
            require './components/formLogin.php';        
            // echo $notificacoes->msg_erro('Usuário ou senha inválida!');            
            

            die();
        } catch(\PDOException $error) {
            // Debug: Verificar se as variáveis existem
            $debugInfo = [
                'notificacoes_exists' => isset($notificacoes),
                'error_message' => $error->getMessage(),
                'method_exists' => method_exists($notificacoes ?? null, 'msg_erro')
            ];
            
            // Tentar usar a classe Notificacoes com tratamento de erro
            try {
                if (isset($notificacoes) && method_exists($notificacoes, 'msg_erro')) {
                    $mensagemFormatada = $notificacoes->msg_erro("Erro de banco de dados: " . $error->getMessage());
                    echo $mensagemFormatada;
                } else {
                    throw new Exception("Classe Notificacoes não disponível");
                }
            } catch (Exception $notifError) {
                // Fallback: HTML direto sem usar a classe
                echo "<div class='alert alert-danger rounded' role='alert'>";
                echo "<i class='bi bi-x-circle-fill'></i> Erro de banco de dados: " . htmlspecialchars($error->getMessage());
                echo "</div>";
                
                // Debug opcional (comentar em produção)
                echo "<!-- Debug: " . json_encode($debugInfo) . " -->";
                echo "<!-- Erro da classe: " . $notifError->getMessage() . " -->";
            }
            
            die();
        }
    ?>
</body>

</html>