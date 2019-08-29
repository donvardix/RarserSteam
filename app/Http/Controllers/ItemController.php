<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Repositories\ItemRepository;
use Illuminate\Http\Request;
use App\Services\Parser;

class ItemController extends Controller
{
    public function index(ItemRepository $itemsRepo)
    {
        $items = $itemsRepo->getAllItems();
        return view('dashboard.index', compact('items'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request, Parser $parser)
    {
        $itemHashName = $parser->nameToHash($request->name); // TODO Сделать хелпер
        $issetItemSteam = $parser->issetItemSteam($request->gameId, $itemHashName); // Проверка на существование придмета в ТП Steam
        $issetItemDB = $parser->issetItemDB($request->name); // Проверка на существование придмета в БД
        if ($issetItemSteam && !$issetItemDB) {
            Item::create([ // TODO Вынести в отдельный файл метод добавления item в БД
                'name' => $request->name,
                'hash_name' => $itemHashName,
                'game_id' => $request->gameId
            ]);
            return response()->json(['success' => 1]);
        }
        return response()->json(['success' => 0], 500); // TODO Подумать на статусом ответа
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
