<?php

namespace App\Http\Utilities;

class Cities
{
    protected static $cities =
        [
            'Auce' => 'auce',
            'Bauska' => 'bauska',
            'Cēsis' => 'cesis',
            'Dobele' => 'dobele',
            'Engure' => 'engure',
            'Jelgava' => 'jelgava',
            'Mārupe' => 'marupe',
            'Olaine' => 'olaine',
            'Rīga' => 'riga',
            'Talsi' => 'talsi',
            'Valmiera' => 'valmiera'
        ];

    public static function all()
    {
        return array_keys(static::$cities);
    }
}
