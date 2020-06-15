<?php

namespace App\Models\Utils;

abstract class CustomString
{
    public static function prepareStringForURL(string $string, $sep = '-')
    {
        $string = self::stripAccents($string);
        $string = strtolower($string);
        $string = preg_replace('/[^[:alnum:]]/', '', $string);
        $string = preg_replace('/[[:space:]]+/', $sep, $string);
        return $string;
    }

    private static function stripAccents($stripAccents){
        return strtr($stripAccents,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ','aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
    }
}
