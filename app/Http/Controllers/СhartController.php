<?php

namespace App\Http\Controllers;

use App\Services\ItemService;

class ChartController extends Controller
{
    public function index($id = null) // TODO Подумть над этим методом, 3 проверки
    {
        $items = ItemService::getItemNames();
        if (!($items->count()) > 0) { // Проверка что таблица не пуста
            exit('Пустая таблица'); // TODO Error
        }

        if (!isset($id)) { // Проверка параметра на null
            $id = $items->first()->id;
        }

        $itemName = $items->find($id)->name ?? null;
        if (!isset($itemName)) {
            abort(404);
        }
        $jsonData = ItemService::toJson($itemName);

        return view('index', compact('items', 'itemName', 'jsonData'));
    }
}
