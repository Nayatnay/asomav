<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGnocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    
        Schema::create('gnocs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('factura_id');
            $table->unsignedBigInteger('user_id');
            $table->string('descripcion');
            $table->decimal('monto', 8, 2);                 
            $table->timestamps();

            // Llave foranea
            $table->foreign('factura_id')->references('id')->on('facturas')->onDelete('cascade');
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
        Schema::dropIfExists('gnocs');
    }
}
