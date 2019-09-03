<?php

namespace App\Http\Controllers;

use App\Services\ItemService;

class ChartController extends Controller
{
    public function index($id = null)
    {
        $items = ItemService::getItemNames();
        $itemName = ItemService::getName($id, $items);
        if (is_null($itemName)) {
            abort(404);
        }
        $jsonData = ItemService::toJson($itemName);

        return view('index', compact('items', 'itemName', 'jsonData'));
    }
}
