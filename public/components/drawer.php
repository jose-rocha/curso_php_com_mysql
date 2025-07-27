<?php

use public\utils\class\ConnectDB;

$connectDB = new ConnectDB;
$query = "select id, usuario, nome, tipo from usuarios";

$tableUsers = $connectDB->getDataDB($query)->fetchAll(PDO::FETCH_ASSOC);
$qtdUsers =  $connectDB->getDataDB($query)->rowCount();
?>

<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions"
    aria-labelledby="offcanvasWithBothOptionsLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Backdroped with scrolling</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <p>Try scrolling the rest of the page to see this option in action.</p>
    </div>
</div>

<!-- Caso queira deixar o modal fixo pra debug, basta adicionar a classe swhow e o  style="display: block;" -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Usuários do Sistema</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="table-responsive" style="max-height: 320px">
                    <table class="table caption-top table-striped table-hover" role='button'>
                        <caption>
                            Lista de usuários - Quantidade de usuarios:
                            <?= $qtdUsers; ?>
                        </caption>

                        <thead style="position: sticky; top: 0; z-index: 1;">
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Usuário</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Tipo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($tableUsers as $user) {
                                    echo "
                                        <tr>
                                            <td>{$user['id']}</td>
                                            <td>{$user['usuario']}</td>
                                            <td>{$user['nome']}</td>
                                            <td>{$user['tipo']}</td>
                                        </tr>
                                    ";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div>
    </div>
</div>