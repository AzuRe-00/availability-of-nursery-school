<?php

namespace App\Providers;

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
        /**
         * URLをhttps変換
         * ペジネーションのためのコード
         */
        \URL::forceScheme('https');
        $this->app['request']->server->set('HTTPS','on');
    }
}
