<?php

namespace App\Providers;

use App\Domain\Video\Contracts\VideoStorageInterface;
use App\Domain\Video\Services\VideoStorageServiceInterface;
use App\Infrastructure\Services\AwsS3VideoStorage;
use App\Infrastructure\Storage\S3VideoStorageService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(VideoStorageServiceInterface::class, S3VideoStorageService::class);
        $this->app->bind(VideoStorageInterface::class, AwsS3VideoStorage::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
