<?php

namespace App\Http\Controllers;


use App\Services\ResponseService as Response;
use App\Services\HelperService as Helper;
use Illuminate\Support\Arr;

class TestController extends Controller
{
    public function test()
    {
        //return Response::error(['notExist', 'notExist2']);
        return Response::ok();
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
