<?php

namespace App\Services;

use App\Models\Item;
use App\Models\Parser;
use App\Services\HelperService as Helper;
use App\Services\ResponseService as Response;

class ItemService
{
    public static function getAllItem($columns = ['id', 'name', 'app_id', 'hash_name'])
    {
        $items = Item::select($columns)->get();
        return $items;
    }

    public static function getName($id, $items)
    {
        $items = $items->keyBy('id');
        if ($items->isEmpty()) {
            return null;
        }
        if (is_null($id)) {
            $id = $items->first()->id;
        }
        $itemName = $items->get($id)->name ?? null;
        return $itemName;
    }

    public static function storeItem($item)
    {
        $itemHashName = Helper::nameToHash($item['nameItem']);
        $url = ParserService::getUrlSteamSales($item['appId'], $itemHashName);
        $existItemSteam = ParserService::getJsonFromUrl($url);
        if (!$existItemSteam) { // Проверка на существование такого предмета на ТП Steam
            return Response::error(['notExist']);
        }
        $existItemDB = ParserService::issetItemDB($item['nameItem']);
        if ($existItemDB) { // Проверка на существование такого предмета в БД
            return Response::error(['existToDB']);
        }
        Item::create([
            'name' => $item['nameItem'],
            'hash_name' => $itemHashName,
            'app_id' => $item['appId']
        ]);
        return Response::ok();
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
