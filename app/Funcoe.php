<?php

namespace App;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcoe extends Model
{
    

    function previlegios(){
        return $this->belongsToMany("App\Previlegio","previlegiofuncoes");
    }
}
