<?php


namespace App\Services;


use App\Models\Item;

class Parser
{
    public function nameToHash($string)
    {
        return str_replace("'", '%27', str_replace(' ', '%20', $string));
    }

    public function issetItemSteam($appId, $itemHashName)
    {
        $info_api = 'https://steamcommunity.com/market/priceoverview/?&currency=1&appid=' . $appId . '&market_hash_name=' . $itemHashName;
        $init = curl_init($info_api);
        curl_setopt($init, CURLOPT_FAILONERROR, true);
        curl_setopt($init, CURLOPT_RETURNTRANSFER, true);
        $html = curl_exec($init);
        curl_close($init);
        return $html;
    }

    public function issetItemDB($itemName)
    {
        if (Item::where('name', $itemName)->first()) {
            return true;
        }
        return false;
    }
}
