<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorarioMedicoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horario_medico', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha')->default('2001-01-01');
            $table->time('hora_inicio')->default('12:00:00');
            $table->time('hora_fin')->default('12:00:00');
            $table->integer('medico_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->foreign('medico_id')->references('id')->on('users');
            $table->foreign('status_id')->references('id')->on('status_horario');
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
        Schema::dropIfExists('horario_medico');
    }
}
