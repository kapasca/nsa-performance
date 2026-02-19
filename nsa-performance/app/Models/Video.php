<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
  protected $fillable = [
    'title',
    'excerpt',
    'url',
    'status',
    'published_at'
  ];

  protected $casts = [
    'published_at' => 'datetime'
  ];
}
