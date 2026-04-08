<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use Illuminate\Http\Request;


class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::with('options')->get();
        return view('dashboard.attributes.index', compact('attributes'));
    }

    public function create()
    {
        return view('dashboard.attributes.create');
    }

    public function store(Request $request)
    {
        $attribute = Attribute::create([
            'name' => $request->name
        ]);

        return redirect()->route('attributes.index');
    }
}