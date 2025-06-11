<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VariantFactory extends Factory
{
    protected $sizes = ['Small', 'Medium', 'Large', 'X-Large'];
    protected $flavors = [
        'Chicken', 'Beef', 'Fish', 'Turkey',
        'Vegetable', 'Liver', 'Salmon', 'Duck'
    ];

    public function definition()
    {
        return [
            'name' => $this->faker->randomElement($this->sizes) . ' - ' . 
                     $this->faker->randomElement($this->flavors),
            'price' => $this->faker->randomFloat(2, 5, 50),
            'stock' => $this->faker->numberBetween(0, 100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}