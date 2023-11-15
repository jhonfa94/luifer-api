<?php

namespace Database\Factories\Http\Modules\Products\Models;

use App\Http\Modules\Marks\Models\Mark;
use App\Http\Modules\Products\Models\Product;
use App\Http\Modules\Categories\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = Category::pluck("id")->toArray();
        $marks = Mark::pluck("id")->toArray();

        return [
            'name' => fake()->text(10),
            'price' => fake()->randomFloat(2, 100, 400),
            'category_id' => fake()->randomElement($categories),
            'mark_id' => fake()->randomElement($marks),
        ];
    }
}
