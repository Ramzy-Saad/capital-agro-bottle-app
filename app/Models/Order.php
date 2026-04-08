<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    public function bottle()
    {
        return $this->belongsTo(Bottle::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'order_ingredients')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }
}
