<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContribuicoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contribuicoes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('vacosa_id');
            $table->unsignedInteger('participante_id');
            $table->double('valor');
            $table->timestamps();

            $table->foreign('vacosa_id')
                ->references('id')->on('vacosas')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('participante_id')
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
        Schema::dropIfExists('contribuicoes');
    }
}
