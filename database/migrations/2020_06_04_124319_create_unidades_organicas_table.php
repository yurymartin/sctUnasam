<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidadesOrganicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidades_organicas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('organo_id')->unsigned();
            $table->foreign('organo_id')->references('id')->on('organos');
            $table->string('unidad')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('activo')->default(1);
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
        Schema::dropIfExists('unidades_organicas');
    }
}
