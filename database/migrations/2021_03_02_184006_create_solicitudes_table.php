<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->integer("usuario_id");
            $table->string("acta")->nullable();
            $table->string("ine");
            $table->string("curp")->nullable();
            $table->string("tipodocumento");
            $table->date("fechasolicitud");
            $table->date("fechaentrega")->nullable();
            $table->string("urldocumento")->nullable();
            $table->integer("estatus")->default(1);
            $table->integer("entregado");
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
        Schema::dropIfExists('solicitudes');
    }
}
