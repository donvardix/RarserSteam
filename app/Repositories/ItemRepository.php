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

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        $item = $this->model->find($id);
        return $item ? $item->name : false;
    }

    public function firstName()
    {
        return $this->model->first()->name;
    }

    public function json($itemName)
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
