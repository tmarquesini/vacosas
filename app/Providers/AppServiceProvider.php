<?php

namespace App\Providers;

use App\User;
use App\Vacosa;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Ramsey\Uuid\Uuid;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $timezone = "America/Belem";
        if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
        Carbon::setLocale('pt_BR');
        ini_set('max_execution_time', 180); //3 minutes


        //adiciona o código uuid de vacosas já cadastrado no sistema antes da implementaçao do uuid. Pode ser retirado depois da certeza que nenhuma vacosa está sem uuid
        $vacosas = Vacosa::all();
        foreach ($vacosas as $vacosa){
           if ($vacosa->uuid == "" ){
               $vacosa->where("id",$vacosa->id)
               ->update(["uuid"=>Uuid::uuid4()->toString()]);
           }
        }

        //adiciona o código uuid de usuários já cadastrado no sistema antes da implementaçao do uuid. Pode ser retirado depois da certeza que nenhum usuário está sem uuid
        $users = User::all();
        foreach ($users as $user){
           if ($user->uuid == "" ){
               $user->where("id",$user->id)
               ->update(["uuid"=>Uuid::uuid4()->toString()]);
           }
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
