<?php

namespace App\Providers;

use App\Traits\Validation;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;
use App\Http\Repositories\ProductRepository;
use App\Http\Repositories\ProductRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    use Validation;
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('alpha_spaces', function ($attribute, $value) {
            // This will only accept alpha and spaces.
            // If you want to accept hyphens use: /^[\pL\s-]+$/u.
            return preg_match('/^[\pL\s]+$/u', $value);
        });

        Validator::extend('grecaptcha', function ($attribute, $value) {
            // return $this->validateGReCaptcha($value);
        });


        //Log::channel('lead')->info("App Service Provider locales: ", config('app.locales')); 
        //Log::channel('lead')->info("App Service Provider segment", [request()->segment(1)]); 

        session(['langPrefix' => '']);
        session(['urlPrefix' => '']);

        //Log::channel('lead')->info("App Service Provider in array", [(int) in_array(request()->segment(1), config('app.locales'))]); 


        if (in_array(request()->segment(1), config('app.locales'))) {
            App::setLocale(request()->segment(1));
            if (App::getLocale() != 'en') {
                session(['langPrefix' => App::getLocale()]);
                session(['urlPrefix' => '/' . App::getLocale()]);
            }
        }


        //Log::channel('lead')->info("App Service Provider Session", [session()->all()]);
                

    }
}
