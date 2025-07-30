<?php

namespace public\utils\class;

use DateTime;

class FormatDateToBrazil
{
     public function format(string | null $dateString, string $mask): string
    {
        // Recebe a data nesse formato = '2025-07-30 19:58:00';
        // exemplo de mask format('d-m-Y H:i:s')
        $dateTime = new DateTime($dateString);
        
        // echo  $pgFormattedDate;
        return $dateTime->format($mask);
    }
}