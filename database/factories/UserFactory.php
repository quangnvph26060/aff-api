<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),// Mật khẩu mặc định có thể là '12346578'
            'address' => $this->faker->address,
            'referral_code' => null,
            'referrer_id' => null,
            'phone' => $this->faker->phoneNumber,
            'commission_id' => $this->faker->randomElement(['1', '2', '3', '4', '5', '6']),
            'status' =>'active',
            'role_id' => 2, // Giả sử role_id mặc định là 1
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
