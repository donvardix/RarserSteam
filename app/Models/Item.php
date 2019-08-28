<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name',
        'hash_name',
        'game_id'
    ];

    public function parsers()
    {
        return $this->hasMany(Parser::class);
    }
}
