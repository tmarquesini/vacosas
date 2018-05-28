<?php

namespace App\Providers;

use App\Contribuicao;
use App\Observables\ContribuicaoObservable;
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
        $timezone = "America/New_York";
        if (function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
        Carbon::setLocale('pt_BR');
        ini_set('max_execution_time', 180); // 3 minutes

        Contribuicao::observe(ContribuicaoObservable::class);

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
