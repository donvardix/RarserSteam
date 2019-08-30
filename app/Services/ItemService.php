<?php


namespace App\Services;

use App\Models\Item;
use App\Models\Parser;
use App\Services\HelpersService as Helper;

class ItemService
{
    public static function getItemNames($columns = ['id', 'name'])
    {
        $items = Item::select($columns)->get();
        return $items;
    }

    public static function storeItem($request)
    {
        $itemHashName = Helper::nameToHash($request->name);
        $url = ParserService::getUrlSteamSales($request->gameId, $itemHashName);
        $issetItemSteam = ParserService::getJsonFromUrl($url);
        if($issetItemSteam){ // TODO Подумать над проверкой
            $issetItemDB = ParserService::issetItemDB($request->name);
            if ($issetItemSteam && !$issetItemDB) {
                Item::create([ // TODO Вынести в отдельный файл метод добавления item в БД
                    'name' => $request->name,
                    'hash_name' => $itemHashName,
                    'app_id' => $request->gameId
                ]);
                return response()->json(['success' => 1]);
            }
        }
        return response()->json(['success' => 0], 500); // TODO Подумать на статусом ответа
    }

    public static function toJson($itemName)
    {
        $json = [];
        $parsers = Parser::with('date:id,unix')
            ->select(['total_count', 'date_id'])
            ->whereHas('item', function ($query) use ($itemName) {
                $query->where('name', $itemName);
            })
            ->get();
        foreach ($parsers as $data) {
            $json [] = [$data->date->unix, $data->total_count];
        }
        return json_encode($json);
    }
}
