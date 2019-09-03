<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Services\ItemService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $items = ItemService::getItemNames();
        return view('dashboard.index', compact('items'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $success = ItemService::storeItem($request->only(['name', 'appId']));
        return response()->json($success);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Item $item)
    {
        $item->delete(); // TODO Пофиксить. В представлении отправлять delete, а не get
        return redirect()->route('items.index');
    }
}
