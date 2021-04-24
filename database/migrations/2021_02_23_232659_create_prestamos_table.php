<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->integer('usuario_id');
            $table->integer('libro_id');
            $table->date('devolucion');
            $table->date('creacion');
            $table->string('dia')->nullable();
            $table->string('mes')->nullable();
            $table->string('anio')->nullable();
            $table->integer('estatus')->default(1);
            $table->string('tipoprestamo')->nullable();
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
        Schema::dropIfExists('prestamos');
    }
}
