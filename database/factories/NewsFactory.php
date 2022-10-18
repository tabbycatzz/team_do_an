<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => random_int(1, 10),
            'title' => $this->faker->realText($maxNbChars = 50),
            'description' => $this->faker->realText($maxNbChars = 100),
            'content' => $this->faker->realText($maxNbChars = 300),
            'image' => 'posts/minions.jpg',
            'status' => random_int(0,1),
            'viewed' => $this->faker->randomNumber,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
