<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Comunicado;



class ComunicadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fecha = date('Y-m-d');
        $id = $this->faker->randomNumber(2);
        return [
            'fecha' => $fecha,
            'slug' => $id . "-" . $fecha,
            'encabezado' => $this->faker->name(),
            'cuerpo' => $this->faker->sentence(),        
        ];
    }
}
