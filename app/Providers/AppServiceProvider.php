<?php

namespace App\Providers;

use Illuminate\Support\Collection;
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
        Collection::macro('downsample', function ($percent) {
            if ($this->count() > 100) {
                $nth = ($percent * .01) * $this->count();
                return $this->nth(round($nth));
            } else {
                return $this;
            }
        });
    }
}
