<?php

use public\utils\class\ConnectDB;
use public\utils\class\FormatDateToBrazil;

$formatDateToBrazil = new FormatDateToBrazil;
$connectDB = new ConnectDB;
$query = "select id, usuario, nome, tipo, status, criado_em, atualizado_em from usuarios";

try {
    $stmt = $connectDB->getDataDB($query);
    $stmt->execute();
    $tableUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // var_dump($tableUsers);
    
    $qtdUsers =  $stmt->rowCount();
} catch(\PDOException $error) {
    echo $error->getMessage();
}
?>

<!-- Caso queira deixar o modal fixo pra debug, basta adicionar a classe swhow e o  style="display: block;" -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class=" modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Usuários do Sistema</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="table-responsive" style="max-height: 320px; width: 100% !important">
                    <table class="table caption-top table-striped table-hover" role='button'>
                        <caption>
                            Lista de usuários - Quantidade de usuarios:
                            <?= $qtdUsers; ?>
                        </caption>

                        <thead style="position: sticky; top: 0; z-index: 1;">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Usuário</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Status</th>
                                <th scope="col">Criado em</th>
                                <th scope="col">Atualizado em</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                    
                                foreach($tableUsers as $user) {
                                    $status = $user['status'] === 1 ? 'Ativo' : 'Inativo';
                                    $colorStatus = $user['status'] === 1 ? 'green' : 'red';
                                    $criado_em = $formatDateToBrazil->format($user['criado_em'], 'd-m-y H:i');
                                    $atualizado_em = $user['atualizado_em'] 
                                        ? $formatDateToBrazil->format($user['atualizado_em'], 'd-m-y H:i') 
                                        : null;

                                    echo "
                                        <tr>
                                            <td>{$user['id']}</td>
                                            <td>{$user['usuario']}</td>
                                            <td>{$user['nome']}</td>
                                            <td>{$user['tipo']}</td>
                                            <td style='color: {$colorStatus}; font-weight: bold;' >{$status}</td>
                                            <td>{$criado_em}</td>
                                            <td>{$atualizado_em}</td>
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