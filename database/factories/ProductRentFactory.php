<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductRent;
use App\Models\Rent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductRent>
 */
class ProductRentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = Product::get()->random();
        return [
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $product->quantity,
            'category_id' => $product->category_id,
            'product_id' => $product->id,
        ];
    }

    public function forRent(Rent $rent)
    {
        return $this->state(function (array $attributes) use($rent){
            return [
                'rent_id'    => $rent->id,
            ];
        });
    }
}
