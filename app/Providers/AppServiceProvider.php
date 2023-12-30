<?php

namespace App\Providers;

use App\Contracts\BlogInterface;
use App\Contracts\TodoInterface;
use App\Contracts\UpdatedFileInterface;
use App\Contracts\UploadFileInterface;
use App\Repositories\BlogRepository;
use App\Repositories\EloquentTodoRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TodoInterface::class, EloquentTodoRepository::class);
        $this->app->bind(BlogInterface::class, BlogRepository::class);
        $this->app->bind(UploadFileInterface::class, BlogRepository::class);
        $this->app->bind(UpdatedFileInterface::class, BlogRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
