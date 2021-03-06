<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
  public function client(){
    return $this->belongsTo('App\Client', 'client_id');
  }
  public function attachments(){
    return $this->morphMany('App\Attachment', 'related');
  }
  public function project_task()
  {
    return $this->hasMany('App\Project_task');
  }
}
