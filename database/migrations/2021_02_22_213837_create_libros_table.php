<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->string("titulo",100);
            $table->string("descripcion",3000);
            $table->string("autor",100);
            $table->integer("estatus")->default(1);
            $table->integer("disponible");
            $table->integer("ejemplares");
            $table->string("estante");
            $table->integer("fila");
            $table->string("digital")->nullable();
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
        Schema::dropIfExists('libros');
    }
}
