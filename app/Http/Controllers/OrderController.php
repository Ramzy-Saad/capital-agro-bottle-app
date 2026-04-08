<?php

namespace App\Http\Controllers;

use App\Builders\OrderBuilder;
use App\Models\AttributeOption;
use App\Models\Bottle;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create()
    {
        $bottles = Bottle::with('attributes.options')->get();
        return view('orders.create', compact('bottles'));
    }

    public function store(Request $request)
    {
        $builder = new OrderBuilder();

        foreach ($request->items as $item) {
            $builder->addItem($item);
        }

        Order::create([
            'total_price' => $builder->getTotal(),
        ]);

        return back()->with('success', 'Order Created');
    }
}
