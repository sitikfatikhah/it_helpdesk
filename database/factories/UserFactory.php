<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name' => $this->faker->company(),
            'nip' => $this->faker->unique()->numberBetween(100, 999), // NIK as numeric with leading zeros handled
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'level_user' => $this->faker->randomElement(['admin', 'operator', 'superadmin']), // Random user levels
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('123456789'),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
