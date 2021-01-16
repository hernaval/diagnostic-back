<?php

namespace App\Providers;
use App\Repositories\EloquentRepository; 
use App\Repositories\UserRepository; 
use App\Repositories\RestitutionRepository; 
use App\Repositories\MesureRepository; 
use App\Repositories\Eloquent\UserRepositoryImpl; 
use App\Repositories\Eloquent\RestitutionRepositoryImpl; 
use App\Repositories\Eloquent\MesureRepositoryImpl; 
use App\Repositories\Eloquent\BaseRepository; 

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvier extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepository::class, BaseRepository::class);
       $this->app->bind(UserRepository::class, UserRepositoryImpl::class);
       $this->app->bind(RestitutionRepository::class, RestitutionRepositoryImpl::class);
       $this->app->bind(MesureRepository::class, MesureRepositoryImpl::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
