<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

final class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->author()
            ->count(5)
            ->has(
                Post::factory([
                    'category_id' => fn () => Category::inRandomOrder()->first()->id,
                ])
                    ->count(50)
            )
            ->create();

        User::factory()
            ->admin()
            ->has(
                Post::factory([
                    'category_id' => fn () => Category::inRandomOrder()->first()->id,
                ])
                    ->count(10)
            )
            ->create();

        User::factory()
            ->count(20)
            ->create();

        User::factory()->create([
            'email' => 'test@gmail.com',
            'password' => 'test',
        ]);
    }
}
