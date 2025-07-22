<?php

namespace public\utils\class;

class GerarHash
{
    public function gerarHashDefault(string $senha):string
    {
        $verificaSenha = password_hash($senha, PASSWORD_DEFAULT);
        
        return $verificaSenha;
    }

    public function validaHash(string $senha, string $hash): string
    {
        $senhaOk = password_verify($senha, $hash);

        return $senhaOk;
    }
}