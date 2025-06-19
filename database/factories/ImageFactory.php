<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
final class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'path' => fake()->imageUrl(),
            'owner_type' => 'user',
            'owner_id' => User::factory(),
        ];
    }

    public function post(): static
    {
        return $this->state(fn (array $attributes): array => [
            'owner_type' => 'post',
            'owner_id' => Post::factory()
        ]);
    }
}
