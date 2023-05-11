<?php

namespace Database\Factories;
use App\Models\Category;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Category::class;

    public function definition()
    {
            return [
                'name'          =>  $this->faker->name,
                'description'   =>  $this->faker->realText(100),
                'parent_id'     =>  1,
                'menu'          =>  1,
            ];

    }
}
