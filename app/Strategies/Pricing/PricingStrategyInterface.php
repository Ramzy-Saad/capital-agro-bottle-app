<?php

namespace App\Strategies\Pricing;

use App\Models\Bottle;

interface PricingStrategyInterface
{
    public function calculate(Bottle $bottle, array $ingredients): float;
}