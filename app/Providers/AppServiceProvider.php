<?php

namespace App\Providers;

use App\Models\ReportTracker;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Report\ReportRepository;
use App\Repositories\Report\ReportRepositoryInterface;
use App\Repositories\Reporter\ReporterRepository;
use App\Repositories\Reporter\ReporterRepositoryInterface;
use App\Repositories\ReportTracker\ReportTrackerRepository;
use App\Repositories\ReportTracker\ReportTrackerRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        /** 
         * User
         * @var UserRepository
         * @var UserRepositoryInterface
         */
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        /** 
         * Category
         * @var CategoryRepository
         * @var CategoryRepositoryInterface
         */
        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );

        /** 
         * Report
         * @var ReportRepository
         * @var ReportRepositoryInterface
         */
        $this->app->bind(
            ReportRepositoryInterface::class,
            ReportRepository::class
        );


        /** 
         * Reporter
         * @var ReporterRepository
         * @var ReporterRepositoryInterface
         */
        $this->app->bind(
            ReporterRepositoryInterface::class,
            ReporterRepository::class
        );

        /** 
         * ReportTracker
         * @var ReportTrackerRepository
         * @var ReportTrackerRepositoryInterface
         */
        $this->app->bind(
            ReportTrackerRepositoryInterface::class,
            ReportTrackerRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Paginator::useBootstrap();
    }
}
