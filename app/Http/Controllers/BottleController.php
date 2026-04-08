<?php

namespace App\Http\Controllers;

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
        return view('dashboard.bottles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'base_price' => 'required|numeric'
        ]);

        Bottle::create($request->all());

        return redirect()->route('bottles.index');
    }

    public function edit($id)
    {
        $bottle = Bottle::findOrFail($id);
        return view('dashboard.bottles.edit', compact('bottle'));
    }

    public function update(Request $request, $id)
    {
        $bottle = Bottle::findOrFail($id);

        $bottle->update($request->all());

        return redirect()->route('bottles.index');
    }

    public function destroy($id)
    {
        Bottle::findOrFail($id)->delete();

        return back();
    }
}
