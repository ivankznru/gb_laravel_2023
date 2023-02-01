<?php

namespace App\Providers;

use App\QueryBuilders\CategoriesQueryBuilder;
use App\QueryBuilders\CommentsQueryBuilder;
use App\QueryBuilders\NewsQueryBuilder;
use App\QueryBuilders\QueryBuilder;
use App\QueryBuilders\RequestInfoQueryBuilder;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(QueryBuilder::class, CommentsQueryBuilder::class);
        $this->app->bind(QueryBuilder::class, NewsQueryBuilder::class);
        $this->app->bind(QueryBuilder::class, CategoriesQueryBuilder::class);
        $this->app->bind(QueryBuilder::class, RequestInfoQueryBuilder::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
