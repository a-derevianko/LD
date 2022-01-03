<?php

namespace App\Providers;

use App\Entities\Author;
use App\Repositories\Author\AuthorRepository;
use App\Repositories\Author\AuthorRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use LaravelDoctrine\ORM\Facades\EntityManager;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(AuthorRepositoryInterface::class, function () {
            return new AuthorRepository(
                em: EntityManager::getRepository(Author::class)
            );
        });
    }

    public function boot()
    {
        //
    }
}
