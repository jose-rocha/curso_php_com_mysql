<?php

use public\utils\class\VerifyAuth;

session_start();
$verifyAuth = new VerifyAuth;

?>



<div class="btn-group dropstart">
    <button type="button" class="btn btn-primary text-white d-flex align-items-center gap-2" data-bs-toggle="dropdown"
        aria-expanded="false">
        <i class="bi bi-person-circle fs-5"></i>
        <span><?php echo $_SESSION['user']; ?></span>
        <i class="bi bi-chevron-down"></i>
    </button>

    <div class="dropdown-menu dropdown-menu-end p-0" style="min-width: 300px;">
        <div class="row g-0">
            <!-- Coluna de Configurações -->
            <div class="col-7 p-3 border-end d-flex flex-column justify-content-center align-items-center">
                <h6 class="text-muted mb-3">
                    <i class="bi bi-gear me-2"></i>Configurações
                </h6>

                <!-- <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="mobileData" checked>
                    <label class="form-check-label" for="mobileData">
                        <i class="bi bi-phone me-1"></i>Use Mobile Data
                    </label>
                </div>

                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="bluetooth">
                    <label class="form-check-label" for="bluetooth">
                        <i class="bi bi-bluetooth me-1"></i>Bluetooth
                    </label>
                </div>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="notifications" checked>
                    <label class="form-check-label" for="notifications">
                        <i class="bi bi-bell me-1"></i>Notifications
                    </label>
                </div> -->

                <ul class="list-group p-0">
                    <li class="list-group-item d-flex justify-content-center">
                        <a href="#" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-person-gear me-1"></i>Editar Perfil
                        </a>
                    </li>

                    <?= $verifyAuth->verifyTypeUser($_SESSION['tipo']) ?>
                </ul>
            </div>

            <!-- Coluna do Perfil -->
            <div class="col-5 p-3 text-center bg-light">
                <div class="d-flex flex-column align-items-center">
                    <div class="position-relative mb-3">
                        <img src="https://cdn.quasar.dev/img/boy-avatar.png" class="rounded-circle"
                            style="width: 72px; height: 72px; object-fit: cover;">
                        <span class="position-absolute bottom-0 end-0 bg-success rounded-circle"
                            style="width: 20px; height: 20px; border: 2px solid white;"></span>
                    </div>

                    <h6 class="mb-1"><?php echo $_SESSION['nome']; ?></h6>
                    <small class="text-muted mb-3"><?php echo $_SESSION['tipo'] ?? 'User'; ?></small>

                    <div class="d-grid gap-2 w-100">
                        <!-- <a href="#" class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-person-gear me-1"></i>Profile
                                        </a> -->
                        <a href="../logout.php" class="btn btn-danger btn-sm">
                            <i class="bi bi-box-arrow-in-left mx-2"></i>
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>