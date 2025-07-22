<?php

class ShowThumb {
    public static function renderImg($capa, $class = null) {
        $capaIndisponivel =  '/assets/images/capas_jogos/indisponivel.png';

        return file_exists($capa)
                ? "<img src='{$capa}' alt='Capa do jogo' class='$class'>"
                : "<img src='{$capaIndisponivel}' alt='Capa do jogo' class='$class'";
    }
}

$thumb = new ShowThumb();