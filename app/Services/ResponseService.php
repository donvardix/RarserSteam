<?php

namespace App\Services;

use Illuminate\Support\Arr;

class ResponseService
{
    public static function ok($messageText = null)
    {
        $response = [
            'success' => 1
        ];
        if(!is_null($messageText)){
            $response = Arr::add($response, 'message', $messageText);
        }
        return $response;
    }

    public static function error($errors = [])
    {
        $errorText = [];
        foreach ($errors as $error) {
            if (method_exists(self::class, $error)) {
                $errorText [] = self::$error();
            }
        }
        $response = [
            'success' => 0,
            'errors' => $errorText
        ];
        return $response;
    }

    private static function response($body)
    {
        return response()->json($body);
    }

    private static function notExist()
    {
        return 'Предмета не существует';
    }

    private static function existToDB()
    {
        return 'Предмет уже есть в нашей базе данных';
    }
}
