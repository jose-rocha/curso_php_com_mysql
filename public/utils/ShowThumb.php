<?php

class ShowThumb {
    public static function renderImg($capa) {
        $capaIndisponivel =  '/assets/images/capas_jogos/indisponivel.png';

        return file_exists($capa)
                ? "<img src='{$capa}' alt='Capa do jogo' class='capa'>"
                : "<img src='{$capaIndisponivel}' alt='Capa do jogo' class='capa'>";
    }
}

$thumb = new ShowThumb();