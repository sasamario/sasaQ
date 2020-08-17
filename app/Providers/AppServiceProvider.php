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
        //MySQL5.7.7以前の場合、テーブルのIndexに指定できるデータ長が最大767byte
        //utf8mb4では1文字当たり4byteのため、191*4=764byteと収まるため191に指定
        \Illuminate\Support\Facades\Schema::defaultStringLength(191);
    }
}
