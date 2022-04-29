<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tecnico extends Model
{
    protected $table='tecnico';

    public function user()
    {
        return $this->belongsTo("App\User");
    }
}
