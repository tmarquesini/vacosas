<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacosasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacosas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('organizador_id');
            $table->string('nome');
            $table->text('descricao')->nullable();
            $table->double('valor');
            $table->string('url');
            $table->enum('status', ['aberta', 'fechada'])->default('aberta');
            $table->timestamps();

            $table->foreign('organizador_id')
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
        Schema::dropIfExists('vacosas');
    }
}
