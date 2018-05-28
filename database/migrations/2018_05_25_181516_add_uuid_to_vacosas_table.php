<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUuidToVacosasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vacosas', function (Blueprint $table) {
            $table->uuid("uuid")->default('0');
        });

        // Adiciona o UUID aos registros já cadastrados
        $vacosas = \App\Vacosa::all();
        foreach ($vacosas as $vacosa) {
            if ($vacosa->uuid == '0' ) {
                $vacosa->uuid = \Ramsey\Uuid\Uuid::uuid4()->toString();
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
        Schema::table('vacosas', function (Blueprint $table) {
            $table->dropColumn("uuid");
        });
    }
}
