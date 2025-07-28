<?php

require_once './utils/connectDB.php';
require_once './components/headLinks.php';

use public\utils\class\VerifyAuth;

session_start();

$verifyAuth = new VerifyAuth;

if (!$verifyAuth->isLoged()) {
    header('Location: /login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <title><?= htmlspecialchars(titlePage('Home')) ?></title>
</head>

<body>
    <?php require_once './components/header.php' ?>

    <main>
        <div id="corpo">
            <?php require_once './components/formUserEdit.php' ?>
        </div>
    </main>


    <?php 
        require_once './components/footer.php';

        closeConnectionDB($db, $resultado);
        // var_dump($resultado);
     ?>
</body>

</html>