<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
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
      Schema::defaultStringLength(191);
      // if delete a client, delete all contacts and actions that are associated with it
      Client::deleting(function ($client) {
        if($client->contacts()->delete()){
          $client->actions()->delete();
          $client->sections()->delete();
          return true;
        }
        elseif ($client->actions()->delete()) {
          $client->contacts()->delete();
          $client->sections()->delete();
          return true;
        }
        return true;
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
