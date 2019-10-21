<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  protected $guarded = ['id'];

  public function log()
  {
    return $this->morphMany('App\Log', 'loggable');
  }
}
