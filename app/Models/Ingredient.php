<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $guarded = [];

    const UNITS = [
        'kg' => 'Kilogram',
        'g' => 'Gram',
        'l' => 'Liter',
        'ml' => 'Milliliter',
        'pcs' => 'Pieces'
    ];
}
