<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            "user_id" => User::factory(),
            "category_id" => Category::factory(),
            "title" => $this->faker->sentence,
            "slug" => $this->faker->slug,
            "excerpt" => $this->faker->sentence,
            "body" => $this->faker->paragraph,
        ];
    }
}
