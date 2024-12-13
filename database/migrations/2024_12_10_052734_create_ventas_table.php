<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            // Relación con la tabla de usuarios 
            $table->string('metodo_pago');
            $table->decimal('total', 10, 2);
            $table->decimal('total_proveedor', 10, 2);
            $table->decimal('ganancia', 10, 2);
            $table->timestamps();

            // Nuevos campos para diferentes métodos de pago
            $table->decimal('pagomovil', 10, 2)->nullable();
            $table->decimal('punto_de_venta', 10, 2)->nullable();
            $table->decimal('transferencias', 10, 2)->nullable();
            $table->decimal('efectivousd', 10, 2)->nullable();
            $table->decimal('efectivobs', 10, 2)->nullable();
            $table->decimal('paypal', 10, 2)->nullable();
            $table->decimal('zelle', 10, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
}
