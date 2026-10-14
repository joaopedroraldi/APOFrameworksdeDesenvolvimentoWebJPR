<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Faz os botões de paginação usarem o visual do Bootstrap 3.
        Paginator::useBootstrapThree();

        // Deixa as URLs do CRUD em português: /clientes/novo e /clientes/1/editar
        // (o padrão do Laravel seria /clientes/create e /clientes/1/edit).
        Route::resourceVerbs([
            'create' => 'novo',
            'edit' => 'editar',
        ]);
    }
}
