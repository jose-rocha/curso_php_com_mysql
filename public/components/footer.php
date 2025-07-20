<?php
  $route =  $_SERVER['REQUEST_URI'];
//   $userIP = $_SERVER['REMOTE_ADDR'];
  $userIP = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];
  
  $diaAtual = date('d/m/y');
  $anoAtual = date('Y');
//   var_dump($_SERVER['REMOTE_ADDR']);
//   if($route === '/') {
//     echo 'Aqui';
//   } else 'Não';
// var_dump($_SERVER);
?>

<footer class="py-3 mt-4 bg-black ">
    <ul class="nav justify-content-center pb-2 mb-3">
        <!-- <li class="nav-item">
            <a href="/" class="nav-link px-2 text-body-secondary">Home</a>
        </li> -->
    </ul>

    <p class="text-center text-white">
        <?php
           echo "Acessado pelo ip: <b>$userIP</b> em <b>$diaAtual</b> <br/>
           © $anoAtual Desenvolvido por <b>José Rocha</b>";
        ?>
    </p>
</footer>