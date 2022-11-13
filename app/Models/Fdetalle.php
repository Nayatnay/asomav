<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fdetalle extends Model
{
    use HasFactory;

    //Relacion uno a muchos (inversa)

    public function factura(){
        return $this->belongsTo('App\Models\Factura');
    }

    public function gasto(){
        return $this->belongsTo('App\Models\Gasto');
    }
}
