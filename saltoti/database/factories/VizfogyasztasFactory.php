<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vizfogyasztas>
 */
class VizfogyasztasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        static $counter = 0;

        $subject_category = [
            "női_budi",
            "férfi_budi",
            "párásító",
            "locsolás",
            "fürdő"
        ];
//6  szenzor
        return [
            'name' => $subject_category[$counter],
            'SensorID' => ($counter++)+1
        ];
    }
}
