<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chamado extends Model
{
    protected $table = "chamado";
    protected $fillable = ["nome", 'equipamento', 'Motivo', 'telefone', 'data', 'anexo'];

    public function equipamento()
    {
        return $this->belongsTo("App\Equipamento");
    }

    public function empresa()
    {
        return $this->belongsTo("App\empresa", "empresa_id");
    }
}
