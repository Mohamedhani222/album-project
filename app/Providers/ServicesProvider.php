<?php

namespace App\Providers;

use App\Models\Album;
use App\Services\AlbumService;
use App\Services\AlbumServiceInterface;
use Illuminate\Support\ServiceProvider;

class ServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(
            AlbumServiceInterface::class,
            AlbumService::class);
    }
}
