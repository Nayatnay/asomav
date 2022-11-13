<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gasto;

class GastoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gasto::create([
            'descripcion' => 'fondo de reserva',
            'slug' => 'fondo-de-reserva'            
        ]);
       
        Gasto::create([
            'descripcion' => 'vigilancia segun tasa BCV',
            'slug' => 'servicios-de-vigilancia'            
        ]);

        Gasto::create([
            'descripcion' => 'desechos vegetales',
            'slug' => 'desechos-vegetales'            
        ]);

        Gasto::create([
            'descripcion' => 'mantenimiento de areas verdes',
            'slug' => 'mantenimiento-de-areas-verdes'            
        ]);
            
    }
}
