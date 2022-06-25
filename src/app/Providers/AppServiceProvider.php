<?php

namespace App\Providers;


use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;

use App\Services\User\UserService;
use App\Services\User\UserServiceInterface;
use Illuminate\Support\ServiceProvider;



class AppServiceProvider extends ServiceProvider
{
    /**
     * 登録する必要のある全コンテナシングルトン
     *
     * @var array
     */
    public array $singletons = [

      // Service層
      UserServiceInterface::class => UserService::class,
      
      // Repository層
      UserRepositoryInterface::class => UserRepository::class,
      FileRepositoryInterface::class => FileRepository::class, // ファイル関連
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
