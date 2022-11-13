<?php

namespace Database\Seeders;
use App\Models\Comunicado;
use Illuminate\Database\Seeder;

class ComunicadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comunicado::factory(3)->create();
    }
}
