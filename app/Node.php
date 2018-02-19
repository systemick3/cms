<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\NodeType;
use App\File;

class Node extends Model
{
  /**
   * Define a many-to-one relationship.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo.
  */
  public function nodetype()
  {
    return $this->belongsTo(NodeType::class);
  }

  /**
   * Define a many-to-one relationship.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo.
  */
  public function file()
  {
    return $this->belongsTo(File::class);
  }
}
