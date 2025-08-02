<?php

namespace public\utils\class;

class GetPagination extends ConnectDB
{
    public function paginationDataTable($busca, $ordenacao, $inicio, $porPagina)
    {   
        $db = $this->getConnectDB();

        $query = "select j.cod, j.nome, j.capa, j.produtora, j.nota,
                        g.cod as cod_genero, g.genero as ge_genero,
                        p.cod as cod_produtora, p.produtora as pr_produtora
                    from jogos j
                    join generos g on j.genero = g.cod
                    join produtoras p on j.produtora = p.cod";
        
        if(!empty($busca)) {
            $query .= " where (j.nome ilike '%$busca%' or g.genero ilike '%$busca%' or p.produtora ilike '%$busca%')";
        }

        switch($ordenacao) {
            case "cod":
                $query .= " order by j.cod asc ";
                break; 
            case "produtora":
                $query .= " order by pr_produtora asc ";
                break;
            case "nota-alta":
                $query .= " order by j.nota desc ";
                break;
            case "nota-baixa":
                $query .= " order by j.nota asc ";
                break;
            default:
                $query .= " order by j.nome asc ";
        }

        $count = $db->query($query)->rowCount();
        
        $query .= " limit {$porPagina} offset {$inicio}";
        return ['resultado' => $db->prepare($query), 'count' => $count];
        // return [$busca, $query, $inicio, $pagina, $porPagina];
    }
}