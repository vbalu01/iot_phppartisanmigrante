<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sensor>
 */
class SensorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $counter = 0;

        $mertekegysegek = [
            "kwh",
            "m3",
            "m2",
            "m",
            "db",
            "lmn",
            "rezges"
        ];

        return [
            'name' => "sensor".$counter++,
            'mertekegyseg' => Arr::random($mertekegysegek)
        ];
    }
}
