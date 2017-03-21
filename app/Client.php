<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    // defining one to many relationship within laravel eloquent. One client can have many contacts.
    public function contacts(){
      return $this->hasMany('App\Contact');
    }
    public function actions(){
      return $this->hasMany('App\Action');
    }
    public function sections(){
      return $this->hasMany('App\Section');
    }
    //paslēpjam šos laukus kad konvertējam no model uz json
    protected $hidden = ['id', 'user_id', "created_at", "updated_at"];
}
