<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\Variant;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //Create categories
        $categories = Category::factory()->count(6)->create();

        //Create products
        $products = Product::factory()->count(20)->create();

        //Assign products to categories
        $products->each(function ($product) use ($categories) {
            // Find matching category - ensure case matches
            $category = $categories->first(function ($cat) use ($product) {
                return strtolower($cat->name) === strtolower($product->product_type);
        });

        // Only attach if category was found
        if ($category) {
            $product->categories()->attach($category->id);
            
            // For Products in multiple categories
            if (rand(1, 10) <= 3) {
                $extraCategory = $categories
                    ->where('id', '!=', $category->id)
                    ->random();
                    
                if ($extraCategory) {
                    $product->categories()->attach($extraCategory->id);
                }
            }
        }
    });

        //Variants for each product
        $products->each(function ($product) {
            Variant::factory()->count(rand(2, 5))->create([
                'product_id' => $product->id,
            ]);
        });

        //Seed Category-Product pivot table
        $categories->each(function ($category) use ($products) {
            $category->products()->attach(
                $products->random(rand(1, 5))->pluck('id')->toArray()
            );
        });
        

    }
}
