<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'slug' => 'admin-admin',
            'email' => 'admin@asomavilla.com',
            'email_verified_at' => now(),
            'password' => bcrypt('00000000'), // password
            'remember_token' => Str::random(10),
            'ci' => '00000000',         
            'telf' => '0400-0000000',
            'calle' => '0',
            'casa' => '0',
            'alicuota' => '1'
        ])->assignRole('admin');
 
        User::factory(9)->create();
    }
}
