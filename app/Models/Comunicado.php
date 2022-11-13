<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Comunicado extends Model
{
    use HasFactory;

    public function getRouteKeyname()
    {
        return 'slug';
    }

    public function encabezado(): Attribute
    
    {       
        return new Attribute(
            $get= fn($value) => strtoupper($value),
            $set= fn($value) => strtolower($value)
        );
    }

}

