<?php

namespace App\Providers;

use App\Strategies\DefaultSubmissionStrategy;
use App\Strategies\SubmissionStrategyInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SubmissionStrategyInterface::class, DefaultSubmissionStrategy::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
