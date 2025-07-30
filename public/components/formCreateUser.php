<?php

use public\utils\class\ConnectDB;
use public\utils\class\GerarHash;
use public\utils\class\Notificacoes;

$notificacoes = new Notificacoes;

$dataForm = $_POST;
$gerarHash = new GerarHash;
$connectDB = new ConnectDB;

$usuario = $_POST["usuario"] ?? null;
$nome = $_POST["nome"] ?? null;
$tipo = $_POST["tipo"] ?? null;
$senha = $_POST["senha"] ?? null;
$confirmeSenha = $_POST["confirme_senha"] ?? null;


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
        <input type="password" class="form-control " name="confirme_senha" size="10" maxlength="10 "
            placeholder="confirme senha">

        <label for="floatingPassword">Confirme Senha</label>
    </div>

    <div class="form-floating my-2">
        <?php 
            if($dataForm['senha'] !== $dataForm['confirme_senha']) {
                echo $notificacoes->msg_erro('A senhas não conferem!');
            } elseif (
                $_SERVER['REQUEST_METHOD'] === 'POST' && (
                    empty($usuario) ||
                    empty($nome) ||
                    empty($tipo) ||
                    empty($senha) ||
                    empty($confirmeSenha)
                )
            ) {    
                echo $notificacoes->msg_erro('Todos os campos devem ser preenchidos!');
            } elseif (
                !empty($usuario) &&
                !empty($nome) &&
                !empty($tipo) &&
                !empty($senha) &&
                !empty($confirmeSenha)
            ) {    
                $senhaFinalCriptografada = $gerarHash->gerarHashDefault($senha);
                $usuario = strtolower($usuario);
                $nome = ucwords($nome);

                try {
                    $senhaFinalCriptografada = $gerarHash->gerarHashDefault($senha);
                    $usuario = strtolower($usuario);
                    $nome = ucwords($nome);
                    
                    // Validação de tipos permitidos de usuários permitidos
                    $tiposPermitidos = ['admin', 'editor'];
                    if (!in_array($tipo, $tiposPermitidos)) {
                        throw new Exception("
                          Tipo inválido fornecido: '$tipo'. Tipos permitidos: " 
                          . implode(', ', $tiposPermitidos)
                        );
                    }
                    
                    // Verificar se o usuário já existe
                    if ($connectDB->userExists($usuario)) {
                        throw new Exception("
                          Não foi possível criar o usuário '$usuario' talvez o login já está sendo usado. 
                          Escolha outro nome de usuário.
                        ");
                    }
                    
                    // Query com prepared statement
                    $query = "INSERT INTO usuarios(usuario, nome, senha, tipo) VALUES(:usuario, :nome, :senha, :tipo)";
                    
                    // Executar com bind de parâmetros
                    $connectDB->insertInDBPrepared($query, [
                        ':usuario' => $usuario,
                        ':nome' => $nome,
                        ':senha' => $senhaFinalCriptografada,
                        ':tipo' => $tipo
                    ]);

                    echo $notificacoes->msg_sucesso("Usuário '$usuario' criado com sucesso!");                    
                } catch(Exception $erro) {
                    echo $notificacoes->msg_erro($erro->getMessage());
                } catch(PDOException $erro) {
                    echo $notificacoes->msg_erro("Erro no banco de dados: " . $erro->getMessage());
                }
            
            }
        
        ?>

    </div>

    <div class="form-floating mb-2">
        <button class="w-100 btn btn-lg bg-primary text-white" type="submit">Cadastrar Usuário</button>
    </div>



    <div class="py-3 text-center fs-4">
        <a class="link-offset-2link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
            href='/'>
            Voltar
        </a>
    </div>
</form>

<!-- <script>
document.addEventListener('DOMContentLoaded', function() {
    const inputs = {
        'usuario': 'Por favor, digite um nome de usuário (máximo 10 caracteres)',
        'nome': 'Por favor, digite seu nome completo (máximo 30 caracteres)',
        'senha': 'A senha é obrigatória (6 a 10 caracteres)',
        'confirme_senha': 'Por favor, confirme sua senha',
        'tipo': 'Selecione um tipo de usuário'
    };

    Object.keys(inputs).forEach(name => {
        const input = document.querySelector(`[name="${name}"]`);
        if (input) {
            input.addEventListener('invalid', function(e) {
                e.target.setCustomValidity('');
                if (!e.target.validity.valid) {
                    e.target.setCustomValidity(inputs[name]);
                }
            });

            input.addEventListener('input', function(e) {
                e.target.setCustomValidity('');
            });
        }
    });
});
</script> -->