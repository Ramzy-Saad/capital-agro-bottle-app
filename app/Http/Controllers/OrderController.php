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
        $bottles = Bottle::with('attributes.options')->get()->map(function($b){
            return [
                'id' => $b->id,
                'name' => $b->name,
                'base_price' => $b->base_price,
                'attributes' => $b->attributes->map(function($a){
                    return [
                        'id' => $a->id,
                        'name' => $a->name,
                        'options' => $a->options->map(function($o){
                            return [
                                'id' => $o->id,
                                'name' => $o->name,
                                'price' => $o->price
                            ];
                        })->toArray(), // مهم جداً
                    ];
                })->toArray(),
            ];
        });
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
