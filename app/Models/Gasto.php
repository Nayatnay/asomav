<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Gasto extends Model
{
    use HasFactory;

     //Relacion uno a muchos
    
     public function fdetalles(){
        return $this->hasMany('App\Models\Fdetalle');
    }

    public function getRouteKeyname()
    {
        return 'slug';
    }
    
    public function descripcion(): Attribute
    
    {       
        return new Attribute(
            $get= fn($value) => ucwords($value),
            $set= fn($value) => strtolower($value)
        );
    }




}
