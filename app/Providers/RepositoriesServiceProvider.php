<?php

namespace App\Providers;

use App\Repositories\Contracts\MessageRepositoryContract;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Repositories\MessageRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(MessageRepositoryContract::class, MessageRepository::class);
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
    }
}
