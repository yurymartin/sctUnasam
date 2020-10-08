<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion')->nullable();
            $table->integer('paciente_id')->unsigned();
            $table->integer('horario_medico_id')->unsigned();
            $table->integer('ficha_sintomatica_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->foreign('paciente_id')->references('id')->on('users');
            $table->foreign('horario_medico_id')->references('id')->on('horario_medico');
            $table->foreign('ficha_sintomatica_id')->references('id')->on('fichas_sintomaticas');
            $table->foreign('status_id')->references('id')->on('status_cita');
            $table->boolean('activo')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('reservas');
    }
}
