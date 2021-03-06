<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'display_name', 'title', 'body',
  ];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $casts = [
    'status' => 'boolean',
    'in_code' => 'boolean'
  ];
}
