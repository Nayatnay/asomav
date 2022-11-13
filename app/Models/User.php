<?php

namespace App\Models;

use Dotenv\Parser\Value;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable

{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ci',
        'name',
        'email',
        'password',
        'telf',
        'casa',
        'calle',
        'alicuota',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',

    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $guarded = [];


    //Relacion uno a muchos

    public function gnocs()
    {
        return $this->hasMany('App\Models\Gnoc');
    }

    public function ctascs()
    {
        return $this->hasMany('App\Models\Ctasc');
    }

    public function pagos()
    {
        return $this->hasMany('App\Models\Pago');
    }

    public function saldos()
    {
        return $this->hasMany('App\Models\Saldo');
    }

    public function tempsaldos()
    {
        return $this->hasMany('App\Models\TempSaldo');
    }

    // para obtener una url amigable

    public function getRouteKeyname()
    {
        return 'slug';
    }

    public function name(): Attribute

    {
        return new Attribute(
            $get = fn ($value) => ucwords($value),
            $set = fn ($value) => strtolower($value)
        );
    }

    public function email(): Attribute

    {
        return new Attribute(
            $set = fn ($value) => strtolower($value)
        );
    }
}
