<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password = null;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'role' => 'user',
            'provider' => 'mail',
            'phone' => fake()->unique()->numerify('89#########'),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'created_at' => now()->subDays(rand(0, 730))->toDateTimeString(),
        ];
    }

    /**
     * Define an admin user state.
     */
    public function adminUser(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Admin',
                'email' => 'admin@google.com',
                'password' => Hash::make('123123123'),
                'role' => 'admin',
                'provider' => 'mail',
                'phone' => '89999999999',
                'remember_token' => Str::random(10),
            ];
        });
    }
}