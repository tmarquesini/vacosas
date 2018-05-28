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
        $vacosas = \Illuminate\Support\Facades\DB::table('vacosas')
            ->where('uuid', '0')
            ->get();
        foreach ($vacosas as $vacosa) {
                \Illuminate\Support\Facades\DB::table('vacosas')
                    ->where('id', $vacosa->id)
                    ->update([
                        'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString()
                    ]);
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
