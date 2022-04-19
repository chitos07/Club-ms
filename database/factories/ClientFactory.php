<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'FirstName' => 'test',
            'LastName' => 'test',
            'PhoneNumber' => 6546546465,
            'EmergencyNumber' => 5456565465,
            'Country' => 'test',
            'City' => 'test',
            'AdressLine' => 'test',
            'AdressLine2' => 'test',
            'CanSwim' => 1,
            'Email' => 'test@test.com',
            'Password' => Hash::make('password'),
        ];
    }
}
