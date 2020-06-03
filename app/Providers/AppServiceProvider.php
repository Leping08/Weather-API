<?php

namespace App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
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
        Collection::macro('downsample', function ($percent) {
            if ($this->count() > 100) {
                $nth = ($percent * .01) * $this->count();
                return $this->nth(round($nth));
            } else {
                return $this;
            }
        });

        Schema::defaultStringLength(191);
    }
}
