<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {


            $table->id();
            $table->string('nombre_empresa');
            $table->date('fecha_registro');
            $table->decimal('precio_dolar', 10, 2);
            $table->decimal('porcentaje_iva', 5, 2);
            $table->decimal('porcentaje_mercadolibre', 5, 2);
            $table->decimal('porcentaje_ganacia_tienda', 5, 2);
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
        Schema::dropIfExists('empresas');
    }
}
