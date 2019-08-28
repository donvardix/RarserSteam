<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parser extends Model
{
    protected $fillable = [
        'total_count',
        'sales',
        'median_price',
        'lowest_price'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function date()
    {
        return $this->belongsTo(DateParser::class);
    }
}
