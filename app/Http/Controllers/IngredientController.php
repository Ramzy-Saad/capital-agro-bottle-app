<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index()
    {
        $ingredients = Ingredient::latest()->get();
        return view('dashboard.ingredients.index', compact('ingredients'));
    }

    public function create()
    {
        return view('dashboard.ingredients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'unit' => 'required'
        ]);

        Ingredient::create($request->all());

        return redirect()->route('ingredients.index');
    }

    public function edit($id)
    {
        $ingredient = Ingredient::findOrFail($id);
        return view('dashboard.ingredients.edit', compact('ingredient'));
    }

    public function update(Request $request, $id)
    {
        $ingredient = Ingredient::findOrFail($id);
        $ingredient->update($request->all());

        return redirect()->route('ingredients.index');
    }

    public function destroy($id)
    {
        Ingredient::findOrFail($id)->delete();
        return back();
    }
}
