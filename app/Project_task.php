<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project_task extends Model
{
    /**
     * @inheritdoc
     */
    protected $table = 'project_tasks';

  public function project(){
    return $this->belongsTo('App\Project');
  }
}
