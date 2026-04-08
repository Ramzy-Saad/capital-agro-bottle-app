<?php

namespace App\Http\Controllers;

use App\Models\Bottle;
use App\Models\Ingredient;
use App\Services\OrderService;
use App\Strategies\Pricing\DefaultPricing;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function create()
    {
        $bottles = Bottle::all();
        $ingredients = Ingredient::all();
        return view('orders.create', compact('bottles', 'ingredients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bottle_id' => 'required|exists:bottles,id',
            'ingredients.*.quantity' => 'nullable|numeric|min:0'
        ]);

        $bottle = Bottle::findOrFail($request->bottle_id);

        $service = new OrderService(new DefaultPricing());

        $order = $service->create($bottle, $request->ingredients ?? []);

        return redirect()->back()->with('success', 'Order Created! Total: $' . $order->total_price);
    }
}