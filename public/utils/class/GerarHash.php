<?php

namespace public\utils\class;

class GerarHash
{
    private function criptoSenha(string $senha): string
    {
        $c = '';

        for($pos = 0; $pos < strlen($senha); $pos++) {
            $letra = ord($senha[$pos]) + 1; // a fn ord() mostra qual é o código da cada letra digitada

            $c .= chr($letra); // a fn chr() mostra qual é o a letra de cada código
        }

        return $c;
    }
    
    public function gerarHashDefault(string $senha):string
    {
        $textoDigitadoCriptografado = $this->criptoSenha($senha);
        // $verificaSenha = password_hash($senha, PASSWORD_DEFAULT);
        $verificaSenha = password_hash($textoDigitadoCriptografado, PASSWORD_DEFAULT);
        
        return $verificaSenha;
    }

    public function validaHash(string $senha, string $hash): string
    {
        $senhaOk = password_verify($senha, $hash);

        return $senhaOk;
    }

}