<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
    {
        View::share('url_public', getenv('URL_PUBLIC'));
        View::share('url_admin', getenv('URL_ADMIN'));
        // $arCaiDat = DB::table('caidat')->find(1);
        // View::share('arCaiDat', $arCaiDat);
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
