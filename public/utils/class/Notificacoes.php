<?php

namespace public\utils\class;

class Notificacoes
{
    public function msg_sucesso($msg = 'Sucesso!'): string
    {
         $sucesso = "
            <div class='alert alert-success rounded' role='alert'>
                <i class='bi bi-check-circle'></i>  $msg
            </div>
        ";
        
        return $sucesso;
        
    }    

    public function msg_aviso($msg = 'Atenção'): string
    {
        $aviso = "
            <div class='alert alert-warning rounded' role='alert'>
                <i class='bi bi-exclamation-triangle'></i> $msg
            </div>
        ";
        
        return $aviso;
    }

    public function msg_erro($msg = 'Erro!'): string
    {
        $erro = "
            <div class='alert alert-danger rounded' role='alert'>
                <i class='bi bi-x-circle-fill'></i>  $msg
            </div>
        ";

        return $erro;        
    }
}