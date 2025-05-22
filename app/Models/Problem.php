<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Problem extends Model
{
    protected $guarded = [];
  public function createdBy():BelongsTo
  {
      return $this->belongsTo(User::class);
  }

    public function answeredBy():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
