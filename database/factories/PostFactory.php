<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(5),
            'description' => $this->faker->paragraph(3),
            // 'image' => $this->faker->image('public/storage/images', 400, 300, null, false),
            'image' => $this->faker->uuid().'-'.date('YmdHis').'.jpg',
            'user_id' => $this->faker->randomElement([1, 2, 3]),
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
}
