<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\NodeType;
use App\File;

class Node extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'title', 'body', 'node_type_id',
  ];

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
