<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Task
        $this->app->bind(
            \App\Repositories\Task\TaskRepositoryInterface::class,
            \App\Repositories\Task\TaskRepository::class,
        );

        // Folder
        $this->app->bind(
            \App\Repositories\Folder\FolderRepositoryInterface::class,
            \App\Repositories\Folder\FolderRepository::class
        );

        // User
        $this->app->bind(
            \App\Repositories\User\UserRepositoryInterface::class,
            \App\Repositories\User\UserRepository::class
        );
    }
}
