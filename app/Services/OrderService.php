<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Bottle;
use App\Strategies\Pricing\PricingStrategyInterface;

class OrderService
{
    protected PricingStrategyInterface $pricingStrategy;

    public function __construct(PricingStrategyInterface $pricingStrategy)
    {
        $this->pricingStrategy = $pricingStrategy;
    }

    public function create(Bottle $bottle, array $ingredients): Order
    {
        $totalPrice = $this->pricingStrategy->calculate($bottle, $ingredients);

        $order = Order::create([
            'bottle_id' => $bottle->id,
            'total_price' => $totalPrice
        ]);

        foreach ($ingredients as $ingredientData) {
            if (!empty($ingredientData['quantity'])) {
                $order->ingredients()->attach($ingredientData['id'], [
                    'quantity' => $ingredientData['quantity'],
                    'price' => $ingredientData['price']
                ]);
            }
        }

        return $order;
    }
}