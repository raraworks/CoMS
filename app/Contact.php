<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    // comment: you can use the following line, if you dont follow the Model->DB table naming convention
    //tell laravel to use this DB table for this model
    // protected $table = 'tablename';
    //many to one relationship
    public function client(){
      return $this->belongsTo('App\Client', 'client_id');
    }
}
