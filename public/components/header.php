<?php
  $route = $_SERVER['REQUEST_URI'];
  
  // Verificar se sessão já foi iniciada (se não, não inicia aqui)
  session_start();
?>

<div class="px-3 mb-4 bg-black">
    <header class="
      d-flex flex-wrap 
      justify-content-md-between
    ">
        <nav class="navbar navbar-expand-lg w-100">
            <div class="container-fluid">
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"
                    style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <img src="../assets/images/icons/logo_hibrid.png" style="width: 100%; height: 50px;" />
                </a>

                <!-- <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button> -->


                <!-- <div class="collapse navbar-collapse " id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 col-11 justify-content-center">
                        <?php
                          if($route !== '/') echo '<li class="nav-item"><a href="/" class="nav-link px-2 link-primary text-white">Home</a></li>';
                        ?>
                    </ul>

                    <div class="navbar-text" style="padding-left: 10px">
                        <?php
                            echo "<span class='text-light'>" . $_SESSION['user'] . "</span>";
                            if(empty($_SESSION['user'])) {
                                echo '
                                    <a class="nav-link link-primary text-light" aria-current="page" href="../login.php">
                                        <i class="bi bi-box-arrow-right me-1"></i>Login
                                    </a>
                                ';
                            } else {
                                echo '<a class="nav-link link-primary text-light" aria-current="page" href="../logout.php">Sair</a>';
                            }

                        ?>

                    </div>
                </div> -->

                <?php
                    if(empty($_SESSION['user'])) {
                        echo '
                            <a class="nav-link link-primary text-light" aria-current="page" href="../login.php">
                               <span class="mx-2"> Login </span>
                               <i class="bi bi-box-arrow-right me-1"></i>
                            </a>
                        ';
                    } else {
                        // Dropdown inspirado no Quasar
                       require_once 'dropdowHeader.php';
                    }

                ?>

            </div>
        </nav>
    </header>

    <?php require_once 'drawer.php' ?>
</div>