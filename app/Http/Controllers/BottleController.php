<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Bottle;
use Illuminate\Http\Request;

class BottleController extends Controller
{
    public function index()
    {
        $bottles = Bottle::latest()->get();
        return view('dashboard.bottles.index', compact('bottles'));
    }

    public function create()
    {
        $attributes = Attribute::with('options')->get();

        return view('dashboard.bottles.create', compact('attributes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'base_price' => 'required|numeric|min:0',
            'attributes' => 'nullable|array',
            'attributes.*' => 'exists:attributes,id',
        ]);
        $bottle = Bottle::create([
            'name' => $request->name,
            'base_price' => $request->base_price,
        ]);

        $bottle->attributes()->sync($request->attributes);

        return redirect()->route('bottles.index');
    }

    public function edit($id)
    {
        $bottle = Bottle::findOrFail($id);
        $attributes = Attribute::with('options')->get();
        return view('dashboard.bottles.edit', compact('bottle','attributes'));
    }

    public function update(Request $request, $id)
    {
        $bottle = Bottle::findOrFail($id);

        $bottle->update($request->only('name', 'base_price'));
        $bottle->attributes()->sync($request->attributes ?? []);
        return redirect()->route('bottles.index');
    }

    public function destroy($id)
    {
        Bottle::findOrFail($id)->delete();

        return back();
    }
}
