<?php

namespace App\Services;

use App\Models\Item;
use App\Models\Parser;
use App\Services\HelperService as Helper;

class ItemService
{
    public static function getItemNames($columns = ['id', 'name'])
    {
        $items = Item::select($columns)->get();
        return $items;
    }

    public static function getName($id, $items)
    {
        $items = $items->keyBy('id');
        if ($items->isEmpty()) { // Если таблица пуста выводить ошибку
            return false;
        }

        if (is_null($id)) { // Если $id равен null, то присваеваем $id имя первого элемента из колекции
            $id = $items->first()->id;
        }

        $itemName = $items->get($id)->name ?? null;
        if (is_null($itemName)) { // Если $itemName равен null, то выводить ошибку
            return false;
        }

        return $itemName;
    }

    public static function storeItem($request) // TODO Создать отдельный класс для ошибок
    {
        $itemHashName = Helper::nameToHash($request->name);
        $url = ParserService::getUrlSteamSales($request->gameId, $itemHashName);

        $existItemSteam = ParserService::getJsonFromUrl($url);
        if (!$existItemSteam) { // Если $existItemSteam равен false, то возвращяем ошибку
            return [
                'success' => 0,
                'errors' => [
                    'Предмета не существует'
                ]
            ];
        }

        $existItemDB = ParserService::issetItemDB($request->name);
        if ($existItemDB) { // Если $existItemDB равен false, то возвращяем ошибку
            return [
                'success' => 0,
                'errors' => [
                    'Предмет уже есть в нашей базе данных'
                ]
            ];
        }

        Item::create([
            'name' => $request->name,
            'hash_name' => $itemHashName,
            'app_id' => $request->gameId
        ]);
        return ['success' => 1];
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
