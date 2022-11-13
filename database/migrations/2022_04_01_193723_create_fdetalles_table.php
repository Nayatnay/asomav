<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFdetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fdetalles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('factura_id');
            $table->unsignedBigInteger('gasto_id')->nullable();
            $table->decimal('monto', 8, 2);       
            $table->timestamps();

            // Llave foranea
            $table->foreign('factura_id')->references('id')->on('facturas')->onDelete('cascade');
            $table->foreign('gasto_id')->references('id')->on('gastos')->onDelete('set null');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fdetalles');  
    }
}
