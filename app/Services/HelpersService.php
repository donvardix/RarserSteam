<?php


namespace App\Services;


use Carbon\Carbon;

class HelpersService
{
    /**
     * Преобразует Name в Hash Name (Sullen Rampart -> Sullen%20Rampart)
     *
     * @param $string
     *
     * @return string
     */
    public static function nameToHash($string)
    {
        return str_replace("'", '%27', str_replace(' ', '%20', $string));
    }

    public static function nowUnix()
    {
        return (Carbon::now()->timestamp + 10800) * 1000;
    }
}
