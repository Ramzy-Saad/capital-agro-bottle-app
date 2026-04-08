<?php

namespace App\Builders;

use App\Models\AttributeOption;
use App\Models\Bottle;

class OrderBuilder
{
    protected $total = 0;

    public function addItem($item)
    {
        $bottle = Bottle::find($item['bottle_id']);

        $itemTotal = $bottle->base_price;

        foreach ($item['options'] ?? [] as $optionId) {
            $option = AttributeOption::find($optionId);
            $itemTotal += $option->price;
        }

        $this->total += $itemTotal;

        return $this;
    }

    public function getTotal()
    {
        return $this->total;
    }
}