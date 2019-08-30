<?php

namespace App\Http\Controllers;


use App\Services\ItemService;

class TestController extends Controller
{
    public function test()
    {
        $json = ItemService::toJson('Reaper\'s Wreath');
        //$jsonNew = ItemService::toJsonNew('Reaper\'s Wreath');
        //return response()->json($json);
        return $json;
    }

    //Парсинг кол-во продаж за сутки, средняя стоимость предмета и стоимость последней продажи
    /*if ($request->salies == 1) {
        $steamApiItemInfo = 'https://steamcommunity.com/market/priceoverview/?&currency=1&appid=' . $item->game_id . '&market_hash_name=' . $item->hash_name;
        $marketInfo = json_decode(file_get_contents($steamApiItemInfo));
        $sales = str_replace(',', '.', $marketInfo->volume);
        $median_price = $marketInfo->median_price;
        $lowest_price = $marketInfo->lowest_price;
        $res = [
            'sales' => $sales ,
            'median_price' => $median_price,
            'lowest_price' => $lowest_price
        ];
    }*/
}
