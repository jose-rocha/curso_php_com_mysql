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

    public function validaHash(string $senha, string $hash): bool
    {
        /* 
            Tenta primeiro com a senha original (usuários antigos).
            Tive que usar essa por que quando eu crio usuarios pelo formulário
            não funcionava o login por isso usei $senhaOkAntigo
        */
        $senhaOkAntigo = password_verify($senha, $hash);
        
        if ($senhaOkAntigo) {
            return true;
        }
        
        // Se não funcionou, tenta com criptoSenha (usuários novos)
        $senhaComCripto = $this->criptoSenha($senha);
        $senhaOkNovo = password_verify($senhaComCripto, $hash);
        
        return $senhaOkNovo;
    }


}