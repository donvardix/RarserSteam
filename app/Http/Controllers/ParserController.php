<?php

namespace App\Http\Controllers;

use App\Models\DateParser;
use App\Models\Item;
use App\Models\Parser;
use Illuminate\Http\Request;

class ParserController extends Controller
{
    public function parser(Request $request)
    {
        $parserData = [];
        $items = Item::all();
        $date = DateParser::create();
        foreach ($items as $item) {
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
            $steamApiMarketInfo = 'https://steamcommunity.com/market/listings/' . $item->game_id . '/' . $item->hash_name . '/render?count=1&currency=1';
            $marketInfo = json_decode(file_get_contents($steamApiMarketInfo));
            $parserData[] = [
                'total_count' => $marketInfo->total_count,
                'item_id' => $item->id,
                'date_id' => $date->id
            ];
        }
        Parser::insert($parserData);
        return response()->json([
            'success' => true,
        ]);
    }
}
