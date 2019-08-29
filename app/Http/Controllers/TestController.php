<?php

namespace App\Http\Controllers;

use DebugBar\StandardDebugBar;
use Illuminate\Http\Request;
use App\Repositories\ItemRepository;

class TestController extends Controller
{
    public function test(ItemRepository $itemsRepo)
    {
        $debugbar = new StandardDebugBar();
        $debugbar["messages"]->addMessage("hello world!");
        dd('asd');
    }
}
