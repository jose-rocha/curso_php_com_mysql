<!-- <?php 
    session_start();
?> -->


<form class="form-login" action="/login.php" method="POST">
    <div class="d-flex justify-content-center align-items-center">
        <img class="mb-4" src="./assets/images/icons/logo_mobile.png" alt="logo"
            style="width: 100px; height: 80px; object-fit: contain;">
    </div>
    <h1 class="h3 mb-3 fw-normal text-center">Faça seu login</h1>

    <div class="form-floating">
        <input autofocus type="text" class="form-control" name="usuario" size="10" maxlength="10" placeholder="usuário">
        <label for="floatingInput">Usuário</label>
    </div>

    <div class="form-floating my-2">
        <input type="password" class="form-control " name="senha" size="8" maxlength="8" placeholder="senha">

        <label for="floatingPassword">Senha</label>
    </div>

    <?php 
        session_start();

        if ($_SESSION['message_erro']) {
            // Se há detalhes específicos do erro do banco
            if (isset($_SESSION['erro_detalhes'])) {
                echo $notificacoes->msg_erro('Erro de conexão: ' . $_SESSION['erro_detalhes']);
                // Limpar o erro específico após exibir
                unset($_SESSION['erro_detalhes']);
            } else {
                // Erro padrão de login
                echo $notificacoes->msg_erro('Usuário ou senha inválida!');
            }
        } elseif($_SESSION['message_usuario_inativo']) {
             echo $notificacoes->msg_aviso('Atenção entre em contato com a diretoria!');
        }
    ?>

    <button class="w-100 btn btn-lg bg-primary text-white" type="submit">Entrar</button>


    <div class="py-3 text-center fs-4">
        <a class="link-offset-2link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
            href='/'>
            Ir para Home
        </a>
    </div>
</form>