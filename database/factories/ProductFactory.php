<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'cost' => random_int(1000, 1000000),
            'price' => random_int(100, 1000000),
            'quantity' => random_int(1, 100),
            'brand_id' =>  random_int(1, 30),
            'category_id' =>  random_int(1, 20),
        ];
    }
}
