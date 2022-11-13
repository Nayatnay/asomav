<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class UserFactory extends Factory
{
    protected $model = User::class;
    
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
       
        $name = $this->faker->name();
        return [
            'name' => $name,
            'slug' => Str::slug($name, '-'),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('00000000', ['$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi']),
            'remember_token' => Str::random(10),
            'ci'=>$this->faker->randomNumber(),         
            'telf'=>$this->faker->phoneNumber(1),
            'calle'=>$this->faker->randomNumber(2),
            'casa'=>$this->faker->randomNumber(4),
            'alicuota'=>$this->faker->randomFloat(2, 0, 99),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
