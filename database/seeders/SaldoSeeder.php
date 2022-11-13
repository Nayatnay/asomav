<?php

namespace Database\Seeders;

use App\Models\Saldo;
use Illuminate\Database\Seeder;

class SaldoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Saldo::create([
            'user_id' => '1', 
            'fecha' => now()->format('Y-m-d'),                    
            'descripcion' => 'Deuda Anterior',
            'cargo' => '100',
            'abono' => '0' 
        ]);
        
    }
}
