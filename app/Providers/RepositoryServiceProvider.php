<?php

namespace App\Providers;

use App\Repositories\Contracts\NuevoRecursoRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\TestRepositoryInterface;
use app\Repositories\Eloquent\NuevoRecursoRepository;
use App\Repositories\Eloquent\TestRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            TestRepositoryInterface::class, TestRepository::class,
            NuevoRecursoRepositoryInterface::class,
            NuevoRecursoRepository::class
        );
    }

    public function boot()
    {
        //
    }
}