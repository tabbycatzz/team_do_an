<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Category;
use Carbon\Carbon;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'category_id' => $this->faker->numberBetween(1, 20),
            // 'category_id' => Category::all()->random()->id,
            'title' => $this->faker->text(50),
            'description' => $this->faker->text(100),
            'content' => $this->faker->text(200),
            'viewed' => $this->faker->randomNumber,
            'status' => $this->faker->numberBetween(0, 1),
            'image' => 'posts/minions.jpg',
            'deleted_at' => null,
            'published_at' => Carbon::yesterday(),
            'created_at' => Carbon::yesterday(),
            'updated_at' => Carbon::today(),
        ];
    }
}
