<?php

namespace App\Services;

use App\Models\DateParser;
use App\Models\Item;
use App\Models\Parser;
use App\Services\HelperService as Helper;
use App\Services\ResponseService as Response;

class ParserService
{
    /**
     * Формирует ссылку из входящих данных.
     * Для чего нужна:
     * 1. Проверка на существоваие предмета по названию;
     * 2. Парсинг данных: lowest_price, volume, median_price.
     *
     * https://steamcommunity.com/market/priceoverview/?&currency=1&appid=570&market_hash_name=Sullen%20Rampart
     *
     * @param int $appId
     * @param string $itemHashName
     *
     * @return string
     */
    public static function getUrlSteamSales($appId, $itemHashName)
    {
        return 'https://steamcommunity.com/market/priceoverview/?&currency=1&appid=' . $appId . '&market_hash_name=' . $itemHashName;
    }

    /**
     * Формирует ссылку из входящих данных.
     * Для чего нужна:
     * 1. Парсинг данных: total_count (присутсвуют ещё данные).
     *
     * https://steamcommunity.com/market/listings/570/Sullen%20Rampart/render?count=1&currency=1
     *
     * @param int $appId
     * @param string $itemHashName
     *
     * @return string
     */
    public static function getUrlSteamMarket($appId, $itemHashName)
    {
        return 'https://steamcommunity.com/market/listings/' . $appId . '/' . $itemHashName . '/render?count=1&currency=1';
    }

    /**
     * Парсит данные из ссылки в json формат.
     * Для чего нужна:
     * 1. Парсинг
     * 2. Возращяет null, если предмета с таким название не существует
     *
     * @param string $url
     *
     * @return mixed json
     */
    public static function getJsonFromUrl($url)
    {
        $init = curl_init($url);
        curl_setopt($init, CURLOPT_FAILONERROR, true);
        curl_setopt($init, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($init);
        curl_close($init);
        return json_decode($data);
    }

    /**
     * Проверка на существование придмета в БД.
     *
     * @param string $itemName
     *
     * @return bool
     */
    public static function issetItemDB($itemName)
    {
        if (Item::where('name', $itemName)->first()) {
            return true;
        }
        return false;
    }

    public static function startParser()
    {
        $parserData = [];
        $items = Item::select('id', 'hash_name', 'app_id')->get();

        $date = DateParser::create(['unix' => Helper::nowUnix()]);
        foreach ($items as $item) {
            $url = self::getUrlSteamMarket($item->app_id, $item->hash_name);
            $json = self::getJsonFromUrl($url);
            $parserData[] = [
                'total_count' => $json->total_count,
                'item_id' => $item->id,
                'date_id' => $date->id
            ];
        }
        Parser::insert($parserData);
        return Response::ok();
    }
}
