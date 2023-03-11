<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = Str::title($this->faker->word()) . " " . Str::title($this->faker->word());
        $slug = Str::slug($name, '-');
        return [
            'category_id'  => $this->faker->randomElement(Category::pluck('id')->toArray()),
            'name'         => $name,
            'slug'         => $slug,
            'code'          => "Code " . $this->faker->randomNumber(4),
            'price'        => $this->faker->numberBetween(1, 100) * 10,
            'description'  => $this->faker->paragraph,
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Product $product) {
            //
        })->afterCreating(function (Product $product) {
            $product->addMediaFromUrl(asset('images/foods/' . $this->faker->numberBetween(1, 12) . '.png'))->toMediaCollection('product-photo');
        });
    }
}
