<?php
use public\utils\class\Notificacoes;

$notificacoes = new Notificacoes;

$dataForm = $_POST;
?>

<form form acction="/" method="POST" class="d-flex row col-12 col-lg-auto mb-3 mb-lg-0" role="search"
    class="form-login">
    <div class="d-flex justify-content-center align-items-center">
        <img class="mb-4" src="./assets/images/icons/logo_mobile.png" alt="logo"
            style="width: 100px; height: 80px; object-fit: contain;">
    </div>
    <h1 class="h3 mb-3 fw-normal text-center">Novo Usuário</h1>

    <div class="form-floating">
        <input autofocus type="text" class="form-control" name="usuario" size="10" maxlength="10" placeholder="usuário">
        <label for="floatingInput">Usuário</label>
    </div>

    <div class="form-floating my-2">
        <input type="text" class="form-control" name="nome" size="30" maxlength="30" placeholder="usuário">
        <label for="floatingInput">Nome</label>
    </div>

    <div class="mb-2">
        <label for="disabledSelect" class="form-label">Tipo de Usuário</label>

        <select class="form-select form-select-lg" name="tipo" aria-label="Large select example" role="button">
            <option disabled>Selecione o Tipo</option>
            <option value="admin">Administrador do Sistema</option>
            <option value="editor" selected>Editor Autorizado</option>
        </select>
    </div>


    <div class="form-floating mb-2">
        <input type="password" class="form-control " name="senha" size="10" maxlength="10" placeholder="senha">

        <label for="floatingPassword">Senha</label>
    </div>


    <div class="form-floating my-2">
        <input type="password" class="form-control " name="confirme_senha" size="10" maxlength="10"
            placeholder="confirme senha">

        <label for="floatingPassword">Confirme Senha</label>
    </div>

    <div class="form-floating my-2">
        <?php 
            echo $dataForm['senha'] !== $dataForm['confirme_senha']
                ? $notificacoes->msg_erro('A senhas não conferem!')
                : null;
        ?>

    </div>

    <div class="form-floating mb-2">
        <button class="w-100 btn btn-lg bg-primary text-white" type="submit">Entrar</button>
    </div>



    <div class="py-3 text-center fs-4">
        <a class="link-offset-2link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
            href='/'>
            Voltar
        </a>
    </div>
</form>