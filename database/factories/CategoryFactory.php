<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\Category;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     *
     */


    protected $model=Category::class;

    public function definition(): array
    {

        return [
            'name'=>fake()->name,
            "description"=>fake()->address(),
            "type"=>fake()->randomElement(['old','new']),
            "status"=>fake()->randomElement([1,0]),
           // "image"=>fake()->text(),
            //
        ];
    }
}
