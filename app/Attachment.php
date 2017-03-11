<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    public function related()
    {
      return $this->morphTo();
    }
}
