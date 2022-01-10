<?php

namespace App\Providers;

use App\Interfaces\Repositories\ArticleRepositoryInterface;
use App\Interfaces\Repositories\AuthorRepositoryInterface;
use App\Interfaces\Repositories\PostRepositoryInterface;
use App\Repositories\Article\ArticleRepository;
use App\Repositories\Author\AuthorRepository;
use App\Repositories\Post\PostRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(AuthorRepositoryInterface::class, AuthorRepository::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(ArticleRepositoryInterface::class, ArticleRepository::class);
    }

    public function boot()
    {
        //
    }
}
