<?php

namespace App\Http\Controllers;

use App\Services\ItemService;

class ChartController extends Controller
{
    public function index($id = null)
    {
        $items = ItemService::getAllItem();
        $itemName = ItemService::getName($id, $items);
        if (is_null($itemName)) {
            abort(404);
        }
        $jsonData = ItemService::toJson($itemName);

        return view('chart', compact('items', 'itemName', 'jsonData'));
    }
}
