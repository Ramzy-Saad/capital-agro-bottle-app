<?php

namespace App\Strategies\Pricing;

use App\Models\Bottle;

class DefaultPricing implements PricingStrategyInterface
{
    public function calculate(Bottle $bottle, array $ingredients): float
    {
        $total = $bottle->base_price;

        foreach ($ingredients as $ingredient) {
            if (!empty($ingredient['quantity'])) {
                $total += $ingredient['quantity'] * $ingredient['price'];
            }
        }

        return $total;
    }
}