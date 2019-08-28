<?php

namespace App\Http\Controllers;

use App\Repositories\ItemRepository;

class ChartController extends Controller
{
    public function index(ItemRepository $itemsRepo)
    {
        $items = $itemsRepo->all();
        $itemName = $itemsRepo->firstName();
        $jsonData = $itemsRepo->json($itemName);
        return view('index', compact('items', 'itemName', 'jsonData'));
    }

    public function show($id, ItemRepository $itemsRepo)
    {
        $itemName = $itemsRepo->find($id);
        if(!$itemName){
            abort(404);
        }
        $items = $itemsRepo->all();
        $jsonData = $itemsRepo->json($itemName);
        return view('index', compact('items', 'itemName', 'jsonData'));
    }
}
