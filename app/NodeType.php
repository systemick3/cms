<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NodeType extends Model
{
  /**
   * Define a one-to-may relationship.
   * Get the avatar for this user.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany.
   */
  public function nodes()
  {
    return $this->hasMany(Node::class);
  }
}
