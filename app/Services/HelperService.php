<?php

namespace App\Services;

use Carbon\Carbon;

class HelperService
{
    private $columns;
    public $columns2;

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

    public function x2($a)
    {
        $this->columns = $a * 2;

        return $this;
    }

    public function x3()
    {
        $this->columns2 = $this->columns * 2;

        return $this;
    }
}
