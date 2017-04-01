<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Client;
use App\Action;
use App\Section;
use App\Project;

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
      // if delete a client, delete all contacts and actions and their relations that are associated with it
      Client::deleting(function ($client) {
          foreach ($client->actions as $action) {
            $action->attachments()->delete();
          }
          $client->actions()->delete();
          foreach ($client->sections as $section) {
            $section->attachments()->delete();
          }
          $client->sections()->delete();
          foreach ($client->projects as $project) {
            $project->attachments()->delete();
          }
          $client->projects()->delete();
          $client->contacts()->delete();
      });
      Action::deleting(function($action){
        $action->attachments()->delete();
      });
      Section::deleting(function($section){
        $section->attachments()->delete();
      });
      Project::deleting(function($project){
        $project->attachments()->delete();
        $project->project_task()->delete();
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
