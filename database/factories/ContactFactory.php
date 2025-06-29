<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;
use App\Models\Property;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => null,
            'property_id' => Property::inRandomOrder()->value('id'),
            'name'        => $this->faker->name(),
            'email'       => $this->faker->safeEmail(),
            'phone'       => $this->faker->phoneNumber(),
            'message'     => $this->faker->paragraph(),
        ];
    }
}
