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
        $users = \App\User::all();
        foreach ($users as $user) {
            if ($user->uuid == "" ) {
                $user->uuid = \Ramsey\Uuid\Uuid::uuid4()->toString();
                $user->save();
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn("uuid");
        });
    }
}
