<?php

namespace App\Providers;

use App\Models\Breed;
use App\View\Components\LeafletScripts;
use App\View\Components\LeafletStyles;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
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
        Paginator::defaultView('vendor.pagination.bootstrap-4');
        Blade::if('admin' , function () {
            return auth()->user()->role_id == env('APP_ADMIN_ROLE', 1);
        });
        Blade::if('moder', function () {
            return auth()->user()->role_id == env('APP_MODER_ROLE', 2);
        });
        Blade::if('mayor', function () {
            return auth()->user()->role_id == env('APP_MAYOR_ROLE', 3);
        });
        Blade::if('agronom', function () {
            return auth()->user()->role_id == 4;
        });
        Blade::if('consumer', function () {
            return auth()->user()->role_id == 5;
        });
        Blade::if('chef', function () {
            return auth()->user()->role_id == 6;
        });
        Blade::if('agronomist', function () {
            return auth()->user()->role_id == 7;
        });
        Blade::if('brigadier', function () {
            return auth()->user()->role_id == 8;
        });
        view()->composer('layouts.sidebar-left', function($view){
            $view->with('counts', Breed::where('status', 2)->count());
        });
        Blade::component('leaflet-scripts', LeafletScripts::class);
        Blade::component("leaflet-styles",LeafletStyles::class);
    }
}
