<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\TestRepositoryInterface;
use App\Repositories\Eloquent\TestRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(TestRepositoryInterface::class, TestRepository::class);
    }

    public function boot()
    {
        //
    }
}