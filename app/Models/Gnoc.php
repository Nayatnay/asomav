<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gnoc extends Model
{
    use HasFactory;

//Relacion uno a muchos (inversa)

public function factura(){
    return $this->belongsTo('App\Models\Factura');
}

public function user(){
    return $this->belongsTo('App\Models\User');
}



}
