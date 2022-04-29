<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipamento extends Model
{
    //
    function componentes(){
        return $this->hasMany("App\Componente");
    }
    
    function manutencoes(){
        return $this->hasMany("App\Manutencoe");
    }
    
    function chamados(){
        return $this->hasMany("App\chamado");
    }
    
    function empresa(){
        return $this->belongsTo("App\Empresa");
    }
}
