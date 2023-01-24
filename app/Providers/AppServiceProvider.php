<?php

namespace app\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {


        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Validator::extend('cpf', '\app\Utils\CpfValidation@validate');

        $regras = [
            'nome'=>'required',
            'telefone'=>'required',
            'cpf' => 'required|cpf',
            'placa_do_carro'=>'required',

               // configura assim
        ];
    }
}
