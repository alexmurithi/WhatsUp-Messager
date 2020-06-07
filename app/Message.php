<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
protected $fillable =['from','to','text'];

  protected $casts = [
      'email_verified_at' => 'datetime',
  ];
}
