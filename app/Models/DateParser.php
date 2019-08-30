<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DateParser extends Model
{
    protected $fillable = [
        'unix'
    ];

    public function parsers()
    {
        return $this->hasMany(Parser::class);
    }
}
