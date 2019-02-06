<?php

namespace App\Providers;
use App\Observers\ProjectObserver;
use App\Observers\TaskObserver;
use App\Channel;
use App\Project;
use App\Task;
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
          
           \View::composer('*', function ($view) {
            $view->with('channels', Channel::all());
            Project::observe(ProjectObserver::class);
            Task::observe(TaskObserver::class);
        });

        }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
