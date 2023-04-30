<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SensorData>
 */
class SensorDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

    //26 szenzor
        return [
            'sensorID' => rand(1, 100),
            'mertertek' =>  rand(0, 5000) / 10,
            'mertido' =>$this->faker->dateTimeBetween('-1 week', '+1 week')
        ];
    }
}
