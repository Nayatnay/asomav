<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCtascsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ctascs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('factura_id');
            $table->unsignedBigInteger('user_id');
            $table->string('slug');
            $table->decimal('cuotap', 8, 2);
            $table->decimal('nocomunes', 8, 2);
            $table->decimal('alicuota', 8, 2);  
            $table->integer('restriccion');
            $table->string('estatus')->nullable();  
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
        Schema::dropIfExists('ctascs');
    }
}
