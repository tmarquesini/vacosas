<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUuidToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->uuid("uuid")->default('0');
        });

        // Adiciona UUID aos registros já cadastrados
        $users = \Illuminate\Support\Facades\DB::table('users')
            ->where('uuid', '0')
            ->get();
        foreach ($users as $user) {
                \Illuminate\Support\Facades\DB::table('users')
                    ->where('id', $user->id)
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn("uuid");
        });
    }
}
