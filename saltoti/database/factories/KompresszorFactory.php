<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kompresszor>
 */
class KompresszorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $counter = 0;

    //26 szenzor
        return [
            'name' => "kompresszor".$counter,
            'UzemID' => rand(1,10),
            'levegoSzenzor' => 2*($counter)+70,
            'kwhSzenzor' => 2*($counter++)+71,
        ];
    }
}
