<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $petFoodTypes = [
        'Dry Food', 'Wet Food', 'Treats', 'Chewables', 
        'Dental Care', 'Supplements', 'Kibble', 'Raw Food'
    ];

    protected $dogProducts = [
        'Dog Bone', 'Puppy Chow', 'Dog Biscuits', 'Royal Canin',
        'Dental Sticks', 'Joint Care Chews'
    ];

    protected $catProducts = [
        'Cat Crunchies', 'Tuna Bites', 'Catnip Treats',
        'Hairball Control', 'Senior Cat Formula'
    ];

    public function definition()
    {
        $productType = $this->faker->randomElement(['Dog', 'Cat']);
        $name = $productType === 'Dog' 
            ? $this->faker->randomElement($this->dogProducts)
            : $this->faker->randomElement($this->catProducts);

        return [
            'name' => $name,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

?>