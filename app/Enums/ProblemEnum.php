<?php

namespace App\Enums;

class ProblemEnum
{
    const SEND = 1;
    const PROCESS = 3;
    const REJECT = 2;
    const DONE = 4;


    public static function getStatusArrays(): array
    {
        return [
            static::SEND => 'TERKIRIM',
            static::PROCESS => 'PROSES',
            static::REJECT => 'DITOLAK',
            static::DONE => 'SELESAI',
        ];
    }

    public static function getStatus($status): string
    {
         $statusArrays = self::getStatusArrays();
         return $statusArrays[$status] ?? '-';
    }
}
