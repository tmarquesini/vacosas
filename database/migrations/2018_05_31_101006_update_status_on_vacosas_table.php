<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateStatusOnVacosasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach (\App\Vacosa::all() as $vacosa) {
            if ($vacosa->valor == $vacosa->totalArrecadado) {
                $vacosa->status = 'fechada';
                $vacosa->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach (\App\Vacosa::all() as $vacosa) {
            $vacosa->status = 'aberta';
            $vacosa->save();
        }
    }
}
