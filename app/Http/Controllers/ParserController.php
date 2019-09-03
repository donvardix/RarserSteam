<?php

namespace App\Http\Controllers;

use App\Services\ParserService;

class ParserController extends Controller
{
    public function parser()
    {
        $success = ParserService::startParser();
        return response()->json($success);
    }
}
