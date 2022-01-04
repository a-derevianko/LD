<?php

namespace App\Providers;

use App\Entities\Author;
use App\Interfaces\Repositories\AuthorRepositoryInterface;
use App\Repositories\Author\AuthorRepository;
use Illuminate\Support\ServiceProvider;
use LaravelDoctrine\ORM\Facades\EntityManager;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(AuthorRepositoryInterface::class, AuthorRepository::class);
    }

    public function boot()
    {
        //
    }
}
