<?php


namespace App\Repositories;


use App\Models\Item;
use App\Models\Parser;

class ItemRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = app(Item::class);
    }

    public function getAllItems()
    {
        return $this->model->all();
    }

    public function toJson($itemName)
    {
        $json = [];
        $parsers = Parser::with('item', 'date')
            ->whereHas('item', function ($query) use ($itemName) {
                $query->where('name', $itemName);
            })
            ->get();
        foreach ($parsers as $data) {
            $json [] = [($data->date->created_at->timestamp + 10800) * 1000, $data->total_count];
        }
        return json_encode($json);
    }
}
