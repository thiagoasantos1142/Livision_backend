<?php

namespace App\Providers;

use App\Core\Contracts\UserRepositoryInterface;
use App\Infrastructure\Repositories\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;
use App\Domain\Repositories\VideoRepositoryInterface;
use App\Infrastructure\Repositories\EloquentVideoRepository;


class RepositoryServiceProvider extends ServiceProvider
{
    public $singletons = [
        UserRepositoryInterface::class => EloquentUserRepository::class
    ];

    public function register()
    {
        $this->app->singleton(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->singleton(VideoRepositoryInterface::class, EloquentVideoRepository::class);
    }

    

}