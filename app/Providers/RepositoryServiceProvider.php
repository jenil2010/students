<?php

namespace App\Providers;

use App\Repositories\CourseRepository;
use App\Repositories\HostelRepository;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\HostelRepositoryInterface;
use App\Repositories\Interfaces\WardenRepositoryInterface;
use App\Repositories\WardenRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind( CourseRepositoryInterface::class, CourseRepository::class);
        $this->app->bind( HostelRepositoryInterface::class, HostelRepository::class);
        $this->app->bind( WardenRepositoryInterface::class, WardenRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
