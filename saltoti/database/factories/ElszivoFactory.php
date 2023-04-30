<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Elszivo>
 */
class ElszivoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $counter = 0;
        static $counter2 = 7;

    //26 szenzor
        return [
            'name' => "Elszivo".$counter++,
            'kwhSzenzor' => $counter2++
        ];
    }
}
