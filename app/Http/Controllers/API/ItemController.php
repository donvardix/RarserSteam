<?php

namespace App\Http\Controllers\API;

use App\Models\Item;
use App\Services\ItemService;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    public function index()
    {
        $items = ItemService::getAllItem(['id', 'name']);
        return response()->json($items);
    }

    public function store(Request $request)
    {
        $success = ItemService::storeItem($request->only(['nameItem', 'appId']));
        return response()->json($success);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return ResponseService::ok();
    }
}
