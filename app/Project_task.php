<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project_task extends Model
{
  public function project(){
    return $this->belongsTo('App\Project');
  }
}
