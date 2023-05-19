<?php

namespace Database\Factories;

use App\Models\TaskCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->word,
            'category_id' => TaskCategory::get()->random()->id,
            'description' => fake()->text(200),
            'option' => fake()->text(200),
            'place' => fake()->text(40),
            'price' => rand(0, 10000),
            'date_start' => fake()->date,
            'date_end' => fake()->date,
            'image' => 'public/assets/taskImages/Du2yR6gdeID5H8uAvSZJ4LXOybv2aTa2zsvVE4Xb.jpg',
            'author_id' => User::get()->random()->id,
            'status' =>'new'
        ];
    }
}
