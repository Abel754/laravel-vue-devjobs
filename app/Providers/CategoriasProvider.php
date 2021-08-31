<?php

namespace App\Providers;

use View;
use App\Categoria;
use Illuminate\Support\ServiceProvider;

class CategoriasProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Ho apliquem a totes les vistes. Això fa que ens passem totes les dades de Categoria a totes les vistes
        View::composer('*', function($view) {
            $categorias = Categoria::all();
            $view->with('categorias', $categorias);
        });
    }
}
