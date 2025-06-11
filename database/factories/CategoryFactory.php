<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition()
    {
        $petTypes = ['Dog Dry Food', 'Cat Dry Food', 'Cat Wet Food', 'Cat Treats', 'Dog Treats', 'Dog Chewables', 'Cat Chewables', 'Dog Supplements'];
        
        return [
            'name' => $this->faker->unique()->randomElement($petTypes),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

?>