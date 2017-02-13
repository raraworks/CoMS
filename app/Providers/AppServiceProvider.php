<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      Client::deleting(function ($client) {
        if($client->contacts()->delete()){
          $client->actions()->delete();
          return true;
        }
        return false;
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
