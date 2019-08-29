<?php

namespace App\Http\Controllers;

use App\Repositories\ItemRepository;

class ChartController extends Controller
{
    public function index(ItemRepository $itemsRepo, $id = 1)
    {
        $items = $itemsRepo->getAllItems();
        $itemName = $items->find($id);
        if(!isset($itemName)){
            abort(404);
        }
        $itemName = $itemName->name;
        $jsonData = $itemsRepo->toJson($itemName);

        return view('index', compact('items', 'itemName', 'jsonData'));
    }
}
