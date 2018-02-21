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

  /**
   * Create a file from an uploaded file.
   *
   * @param  \Illuminate\Http\UploadedFile $uploadedFile
   * @return void
  */
  public function handleUploadedFile($uploaded_file)
  {
    $this->user_id = auth()->id();
    $this->filename = $uploaded_file->hashName();
    // Path is set in controller
    $this->filemime = $uploaded_file->getClientOriginalExtension();
    $this->filesize = $uploaded_file->getSize();
    $this->status = 1;
    $this->save();
  }
}
