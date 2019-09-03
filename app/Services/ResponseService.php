<?php


namespace App\Services;


class ResponseService
{
    public function api($status)
    {
        $this->ok();
    }

    private function ok()
    {
        return ['success' => 1];
    }

    private function resp($body)
    {
        return response()->json($body);;
    }
}
