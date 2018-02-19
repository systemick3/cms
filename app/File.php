<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Node;

class File extends Model
{

  /**
   * Define a many-to-one relationship.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo.
  */
  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
