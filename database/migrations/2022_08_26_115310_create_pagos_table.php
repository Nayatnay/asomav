<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('slug');
            $table->string('operacion');
            $table->string('num_operacion');
            $table->string('fecha');
            $table->decimal('monto', 8, 2);
            $table->decimal('montonc', 8, 2);
            $table->string('ci_pagador');
            $table->string('telf_pagador');
            $table->integer('restriccion');
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
        Schema::dropIfExists('pagos');
    }
}
