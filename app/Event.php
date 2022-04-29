<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $table = "agenda";
  
    protected $fillable = [
        'title', 'start','color', 'end', 'tecnico_id'
    ];
}
