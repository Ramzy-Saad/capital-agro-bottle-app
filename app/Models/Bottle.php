<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bottle extends Model
{
    protected $guarded = [];
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }
}
