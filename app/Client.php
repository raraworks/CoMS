<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    // defining one to many relationship within laravel. One client can have many contacts.
    public function contacts(){
      return $this->hasMany('App\Contact');
    }
    public function actions(){
      return $this->hasMany('App\Action');
    }
}
