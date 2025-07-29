<?php

use public\utils\class\ConnectDB;
use public\utils\class\Notificacoes;



$connectDB = new ConnectDB;
$notificao = new Notificacoes;

$query = "select id, usuario, nome,  senha, tipo from usuarios where usuario = '{$_SESSION['user']}'";

try {
    $tableUser = $connectDB->getDataDB($query)->fetch(PDO::FETCH_ASSOC);
    $usuario = $tableUser['usuario'];
    $nome = $tableUser['nome'];
    $ripo = $tableUser['tipo'];
    $senha = $tableUser['senha'];
    
    // var_dump($tableUser);

    // var_dump($_SESSION);
} catch(\PDOException $error) {
   echo $notificao->msg_erro($error->getMessage());

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
        código php aqui
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