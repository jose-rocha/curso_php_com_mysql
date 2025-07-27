<?php

namespace public\utils\class;

class VerifyAuth
{
    public function isLoged()
    {
        return empty($_SESSION['user']) ? false : true;
    }

    public function isAdmin(): bool
    {
        return $this->isLoged() && ($_SESSION['tipo'] ?? null) === 'admin';
    }

    public function isEditor(): bool
    {
        return $this->isLoged() && ($_SESSION['tipo'] ?? null) === 'editor';
    }

    public function verifyTypeUser(?string $typeUser): bool | string | null
    {
        // Verifica se o usuário está logado primeiro
        if (!$this->isLoged() || is_null($typeUser)) {
            return false;
        }

        switch ($typeUser) {
            case 'admin':
                return '
                  <li class="list-group-item px-0 d-flex justify-content-center">
                    <a href="/user-new.php" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-person-gear me-1"></i>Novo Usuário
                    </a>
                  </li>

                  <li class="list-group-item px-0 d-flex justify-content-center">               
                    <button
                        type="button"
                        class="btn btn-outline-primary p-1"
                        data-bs-toggle="modal"
                        data-bs-target="#exampleModal"
                        style="font-size: 14px"
                    >
                        <i class="bi bi-list-check me-1"></i> Listar Usuários
                    </button>
                  </li>
                ';
            case 'editor':
                return null;
            default:
                return false;
        }
    }

    public function getActionIcons(?string $userType = null, $idJogo): string
    {
        // echo $idJogo;
        
        if (!$this->isLoged() || is_null($userType)) {
            return "";
        }

        switch ($userType) {
            case 'admin':
                return "
                    <td >
                        <div class='d-flex justify-content-center gap-1'>
                            <button class='btn btn-sm btn-link p-0' title='Adicionar novo jogo'>
                                <i class='bi bi-plus-circle-fill'></i>
                            </button>
                            <form action='/detalhes.php' method='POST' class='d-inline'>
                                <input type='hidden' name='editando' value='{$idJogo}'>
                                <button 
                                    type='submit'
                                    class='btn btn-sm btn-link p-0'
                                    data-bs-toggle='modal'
                                    data-bs-target='#staticBackdrop'
                                    data-game-id='{$idJogo}'
                                    title='Editar jogo'
                                >
                                    <i class='bi bi-pencil-square'></i>
                                </button>     
                            </form>

                            <button
                                class='btn btn-sm btn-link p-0 text-danger'
                                title='Deletar jogo'
                                onclick='confirmarDelete({$idJogo})'
                            >
                                <i class='bi bi-trash3'></i>
                            </button>
                        </div>
                    </td>
                ";
            case 'editor':
                return "
                    <td >
                        <div class='d-flex justify-content-center gap-1'>
                            <form action='/detalhes.php' method='POST'>
                                <input type='hidden' name='editando' value='{$idJogo}'>
                                <button
                                    type='submit'
                                    class='btn btn-sm btn-link p-0'
                                    data-bs-toggle='modal'
                                    data-bs-target='#staticBackdrop'
                                    data-game-id='{$idJogo}'
                                >
                                    <i class='bi bi-pencil-square'></i>
                                </button>     
                            </form>
                        </div>
                    </td>
                ";
            default:
                return "";
        }
    }
}