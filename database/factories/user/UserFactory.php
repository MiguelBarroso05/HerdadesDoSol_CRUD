<?php

namespace Database\Factories\user;


use App\Models\user\Address;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\user\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => $this->faker->userName,
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'),
            //'address' => $this->faker->address,
            //'city' => $this->faker->city,
            //'country' => $this->faker->country,
            //'postal' => $this->faker->postcode,
            'img' => null,

            /*Alterações feitas */
            'nif' => $this->faker->unique()->numerify('#########'),
            'phone' => $this->faker->unique()->numerify('#########'),
            'birthdate' => $this->faker->date( 'Y-m-d','before:18 years ago'),
            'balance' => $this->faker->numberBetween(0, 100),
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
