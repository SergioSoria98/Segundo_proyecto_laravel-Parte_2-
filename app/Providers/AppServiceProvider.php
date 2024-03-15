<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\MessagesInterface;
use App\Repositories\CacheMessages;
use App\Repositories\Messages;

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
        $this->app->bind(MessagesInterface::class, CacheMessages::class);
    }
}
