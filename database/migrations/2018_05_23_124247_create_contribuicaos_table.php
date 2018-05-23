<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContribuicaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contribuicaos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('vacosa');
            $table->unsignedInteger('participante');
            $table->double('valor');
            $table->timestamps();

            $table->foreign('vacosa')
                ->references('id')->on('vacosas')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('participante')
                ->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contribuicaos');
    }
}
