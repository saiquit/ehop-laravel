<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $title = $this->faker->word;
        return [
            'title' => $title,
            'slug' => $title,
            'description' => $this->faker->sentences(3, true),
            'price' => $this->faker->randomNumber(2),
            'rating' => $this->faker->numberBetween(1, 5),
            'stock' => $this->faker->randomNumber(2),
        ];
    }
}
