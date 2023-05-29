<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\System\Module;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrap();
        // $modules = Module::whereHas('company_permissions', function($query){
        //     return $query->where('company_permissions.company_id', 1); //Auth::user()->company_id
        // })->get();
        //$modules = Module::all();
        //View::share(['modules' => $modules]);
        
    }
}
