<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('is_image', function ($attrib, $value, $parameters, $validator){
            $data = explode( ',', $value);
            $image = base64_decode($data[1]);
            $f = finfo_open();
            $result = finfo_buffer($f, $image, FILEINFO_MIME_TYPE);
            return $result === "image/png" || $result === "image/jpeg" || $result === "image/gif" || $result === "image/svg+xml";
        });
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
