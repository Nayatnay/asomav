<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaldosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saldos', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('user_id');
             $table->string('fecha');
             $table->decimal('cargo', 8, 2);
             $table->decimal('abono', 8, 2);
             $table->string('descripcion');
             $table->string('estatus')->nullable();  
             $table->timestamps();
           
            
            // Llave foranea
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('saldos');
    }
}
