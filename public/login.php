<?php
    require_once __DIR__ . '/../vendor/autoload.php';
    require_once './components/headLinks.php';

    use public\utils\class\GerarHash; 

    // var_dump($_POST);
    $generateHash = new GerarHash;
    // echo $generateHash->gerarHashDefault('Jose2008') . "<br><br><br><br><br><br><br>";
    // echo $generateHash->validaHash('teste', '$2y$12$AUbZ5VG/dbEB4IbCARy1wOW/FTcSOfBfhsN/t0qQak1k9/a6zMWHG');
?>

<!DOCTYPE html>
<html lang="pt-br">

<title><?= htmlspecialchars(titlePage('Login')) ?></title>

<body style="height: 100dvh;" class="d-flex justify-content-center align-items-center">
    <form class="form-login" action="/login.php" method="POST">
        <div class="d-flex justify-content-center align-items-center">
            <img class="mb-4" src="./assets/images/icons/logo_mobile.png" alt="logo"
                style="width: 100px; height: 80px; object-fit: contain;">
        </div>
        <h1 class="h3 mb-3 fw-normal text-center">Faça seu login</h1>

        <div class="form-floating">
            <input type="text" class="form-control" name="usuario" placeholder="usuário">
            <label for="floatingInput">Usuário</label>
        </div>

        <div class="form-floating my-2">
            <input type="password" class="form-control " name="senha" placeholder="senha">

            <label for="floatingPassword">Senha</label>
        </div>

        <button class="w-100 btn btn-lg bg-primary text-white" type="submit">Entrar</button>

        <div class="py-3 text-center fs-4">
            <a class="link-offset-2link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
                href='/'>
                Voltar
            </a>
        </div>

    </form>
</body>

</html>