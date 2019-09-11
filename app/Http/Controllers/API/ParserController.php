<?php

namespace App\Http\Controllers\API;

use App\Services\ParserService;
use App\Http\Controllers\Controller;

class ParserController extends Controller
{
    public function start()
    {
        $success = ParserService::startParser();
        return response()->json($success);
    }
}
