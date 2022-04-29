<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Componente extends Model
{
    //
    function subcomponentes(){
        return $this->hasMany("App\Subcomponente");
    }
}
