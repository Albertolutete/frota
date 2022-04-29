<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = "empresas";

    public function empresa()
    {
        return belongsTo("chamado_id");
    }
    
    public function empresasclientes()
    {
        return $this->hasMany(Empresa::class);
    }
    
    public function lojas()
    {
        return $this->hasMany(Empresa::class);
    }
    
    public function equipamentos(){
        return $this->hasMany(Equipamento::class);
    }
    public function usuarios(){
        return $this->hasMany(User::class);
    }
    
}
