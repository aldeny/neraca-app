<?php

namespace Database\Factories;

use App\Models\Sell;
use Illuminate\Database\Eloquent\Factories\Factory;

class SellFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sell::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_produk' => $this->faker->citySuffix(),
        ];
    }
}
