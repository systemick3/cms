<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\File;

class User extends Authenticatable
{
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'email', 'password',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
   * Define a one-to-may relationship.
   * Get the avatar for this user.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany.
   */
  public function files()
  {
    return $this->hasMany(File::class);
  }
}
