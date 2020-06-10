<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleSintomasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_sintomas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ficha_sintoma_id')->unsigned();
            $table->foreign('ficha_sintoma_id')->references('id')->on('fichas_sintomaticas');
            $table->integer('sintoma_id')->unsigned();
            $table->foreign('sintoma_id')->references('id')->on('sintomas');
            $table->boolean('respuesta')->default(0);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_sintomas');
    }
}
