<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class GastoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $descripcion = $this->faker->name();
        
        return [
            'descripcion' => $descripcion,
            'slug' => Str::slug($descripcion, '-') 
        ];

        
    }
}
