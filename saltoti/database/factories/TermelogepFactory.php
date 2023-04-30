<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Termelogep>
 */
class TermelogepFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {

        static $counter = 0;

    //26 szenzor
        return [
            'name' => "TermeloGep".$counter,
            'UzemID' => rand(1,10),
            'darabszenzor' => 2*($counter)+28,
            'kwhSzenzor' => 2*($counter++)+29,
            'ElszivoID' =>  rand(1, 20)
        ];
    }

}
