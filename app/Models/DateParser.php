<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DateParser extends Model
{
    public function parsers()
    {
        return $this->hasMany(Parser::class);
    }
}
