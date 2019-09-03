<?php

namespace App\Http\Controllers;

use App\Services\ParserService;

class ParserController extends Controller
{
    public function parser()
    {
        $success = ParserService::startParser() ? ['success' => 1] : ['success' => 0];
        // $response = Response::api($success);
        response()->json($success);
    }
}
