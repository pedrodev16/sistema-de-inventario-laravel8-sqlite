<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuadreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuadre', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('estado')->default('no');
            $table->string('concepto_ingreso')->nullable();
            $table->decimal('total_ingreso', 10, 2)->nullable();
            $table->string('concepto_egreso')->nullable();
            $table->decimal('total_egreso', 10, 2)->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuadre');
    }
}
