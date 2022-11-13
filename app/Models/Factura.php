<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Factura extends Model
{
    use HasFactory;

    //Relacion uno a muchos

    public function fdetalles()
    {
        return $this->hasMany('App\Models\Fdetalle');
    }

    public function gnocs()
    {
        return $this->hasMany('App\Models\Gnoc');
    }

    public function ctascs()
    {
        return $this->hasMany('App\Models\Ctasc');
    }

    // para obtener una url amigable

    public function getRouteKeyname()
    {
        return 'slug';
    }
}
