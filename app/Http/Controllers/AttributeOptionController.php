<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\AttributeOption;
use Illuminate\Http\Request;


class AttributeOptionController extends Controller
{
    public function create()
    {
        $attributes = Attribute::all();
        return view('dashboard.attribute-options.create', compact('attributes'));
    }

    public function store(Request $request)
    {
        AttributeOption::create([
            'attribute_id' => $request->attribute_id,
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return back();
    }
}