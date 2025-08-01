<?php

use public\utils\class\ConnectDB;
use public\utils\class\GerarHash;
use public\utils\class\Notificacoes;


$connectDB = new ConnectDB;
$notificacao = new Notificacoes;
$gerarHash = new GerarHash;
$dataForm = $_POST;

$query = "select id, usuario, nome, senha, tipo from usuarios where usuario = :usuario";


try {
    // $tableUser = $connectDB->getDataDB($query)->fetch(PDO::FETCH_ASSOC);
    $stmt = $connectDB->getDataDB($query);
    $stmt->execute([':usuario' => $_SESSION['user']]);
    $tableUser  = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $usuario = $tableUser['usuario'];
    $nome = mb_convert_case($_POST['nome'] ?? $tableUser['nome'], MB_CASE_TITLE, 'UTF-8');
    $tipo = $tableUser['tipo'];
    $senha = $tableUser['senha'];
    
} catch(\PDOException $error) {
   echo $notificacao->msg_erro($error->getMessage());

   exit();
}
?>

<form form acction="/" method="POST" class="d-flex row col-12 col-lg-auto mb-3 mb-lg-0" role="search"
    class="form-login">
    <div class="d-flex justify-content-center align-items-center">
        <img class="mb-4" src="./assets/images/icons/logo_mobile.png" alt="logo"
            style="width: 100px; height: 80px; object-fit: contain;">
    </div>
    <h1 class="h3 mb-3 fw-normal text-center">Editando Usuário</h1>

    <div class="form-floating">
        <input autofocus type="text" class="form-control" name="usuario" size="10" maxlength="10" placeholder="usuário"
            value="<?=$usuario?>" readonly>
        <label for="floatingInput">Usuário</label>
    </div>

    <div class="form-floating my-2">
        <input type="text" class="form-control" name="nome" size="30" maxlength="30" placeholder="usuário"
            value="<?=$nome?>">
        <label for="floatingInput">Nome</label>
    </div>

    <div class="mb-2">
        <label for="disabledSelect" class="form-label">Tipo de Usuário</label>

        <select class="form-select form-select-lg" name="tipo" aria-label="Large select example" role="button" disabled>
            <option disabled>Selecione o Tipo</option>
            <option value="<?= $tableUser['tipo'] ?>">
                <?= $tipo === 'admin' ? 'Administrador do Sistema' : 'Editor Autorizado' ?>
            </option>
        </select>
    </div>


    <div class="form-floating mb-2">
        <input type="password" class="form-control " name="senha" size="10" maxlength="10" placeholder="senha">

        <label for="floatingPassword">Senha</label>
    </div>

    <div class="form-floating my-2">
        <input type="password" class="form-control " name="confirme_senha" size="10" maxlength="10 "
            placeholder="confirme senha">

        <label for="floatingPassword">Confirme Senha</label>
    </div>

    <div class="form-floating my-2">
        <?php
            if($dataForm['senha'] !== $dataForm['confirme_senha']) {
                echo $notificacao->msg_erro('A senhas não conferem!');
            } elseif (
                $_SERVER['REQUEST_METHOD'] === 'POST' && (
                    empty($usuario) ||
                    empty($nome) ||
                    empty($tipo)
                    // ||
                    // empty($senha) ||
                    // empty($confirmeSenha)
                )
            ) {    
                echo $notificacao->msg_erro('Todos os campos devem ser preenchidos!');
            } elseif($connectDB->userExists($usuario) && $_SERVER['REQUEST_METHOD'] === 'POST') {
                    $senhaPost = $_POST['senha'] ?? null;
                    $senhaPostConfirmeSenha = $_POST['confirme_senha'] ?? null;                

                    $queryUpdate = "update usuarios set nome = :nome, tipo = :tipo, senha = :senha where usuario = :usuario";

                    if(empty($senhaPost) || is_null($senhaPostConfirmeSenha)) {
                      echo  $notificacao->msg_aviso('Dados alterados com sucesso e a senha antiga foi mantida');
                    } elseif($senhaPost === $senhaPostConfirmeSenha) {
                        $senha = $gerarHash->gerarHashDefault($senhaPost);

                        $queryUpdate = "update usuarios set nome = :nome, tipo = :tipo, senha = :senha where usuario = :usuario";

                        echo $notificacao->msg_sucesso('Usuário atualizado com suceso!');
                    }
                    
                    try {
                        $_SESSION['nome'] = $nome;
                        $stmt = $connectDB->updateData($queryUpdate, [
                            ':nome' => mb_convert_case($_POST['nome'], MB_CASE_TITLE, 'UTF-8'), 
                            ':tipo' => $tipo,
                            ':senha' => $senha,
                            ':usuario' => $usuario
                        ]);
    
                        $resultUpdate = $stmt->rowCount();
                    } catch(\PDOException $erro) {
                        $notificacao->msg_erro($erro->getMessage());
                    }
                    
                   

            }
        ?>
    </div>

    <div class="form-floating mb-2">
        <button class="w-100 btn btn-lg bg-primary text-white" type="submit">Atualizar Usuário</button>
    </div>



    <div class="py-3 text-center fs-4">
        <a class="link-offset-2link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
            href='/'>
            Voltar
        </a>
    </div>
</form>

<script defer>
// const originalString = "  This  string has   many  gaps.  ";
// const cleanedString = originalString.replace(/\s+/g, ''); 
// console.log(cleanedString); // Output: Thisstringhasmanygaps.

const input = document.querySelector('[name="usuario"]');

input.addEventListener('focusout', ({
    target
}) => {
    // console.log(target.value.replace(/\s+/g, ''));
    input.value = target.value.replace(/\s+/g, '');
})
</script>