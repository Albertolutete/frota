<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Manutencoe as Manutencoes;
use Illuminate\Support\Facades\Auth;

class Manutencoe extends Model
{
    // Instancia uma manuntecao
    function __contruct(string $tipoManutencao, $equipamento_id, $chamado_id, $tecnico_id)
    {
        $manu = new Manutencoes();
        $manu->tipo  = $tipoManutencao; //preventiva ou corretiva
        $manu->status = "a"; //berto
        $manu->tecnico_id = $tecnico_id;                                          // Campo por alterar
        $manu->chamado_id = $chamado_id;                                          // Campo por alterar
        $manu->equipamento_id = $equipamento_id;
        $manu->save();
    }

    function criarManutencao($equipamento_id, $tipoManutencao, $chamado_id, $tecnico_id)
    {
        $manu = new Manutencoes();
        $manu->tipo  = $tipoManutencao; //preventiva ou corretiva
        $manu->status = "a"; //berto
        $manu->tecnico_id = $tecnico_id;                                          // Campo por alterar
        $manu->chamado_id = $chamado_id;                                          // Campo por alterar
        $manu->equipamento_id = $equipamento_id;
        $manu->save();


        // $manu = new Manutencoes();
        // $manu->tipo  = $tipoManutencao;//preventiva ou corretiva
        // $manu->status = "a";//berto
        // $manu->tecnico_id = 1;
        // $manu->equipamento_id = $equipamento_id;
        // $manu->dataAbertura = date("Y-m-d"); 
        // $manu->save();
        // return $manu;
    }
    /**
     * esta funcao retorna uma manutencao aberta,a mesma pode ja existir ou pode ser criado e depois retornado
     */
    public static function getManutencao($equipamento_id, $tipoManutencao, $tecnico_id)
    {
        $manutencao = Manutencoe::where("equipamento_id", "=", $equipamento_id)->get();
        $chamado = chamado::where("equipamento_id", "=", $equipamento_id)->where("status", "a")->get()->last();

        if(!isset($chamado)){

            $chamado['id'] = chamado::max("id") +1;
        }
        
        if (count($manutencao) > 0) {
            $ultimaManutencao = $manutencao[count($manutencao) - 1];
            if ($ultimaManutencao->status == "a") {
                return $ultimaManutencao;
            } else {
                $manu = new Manutencoe();
                $manu->tipo  = $tipoManutencao; //preventiva ou corretiva
                $manu->status = "a"; //berto
                $manu->tecnico_id = $tecnico_id;
                $manu->equipamento_id = $equipamento_id;
                $manu->chamado_id = $chamado["id"];
                $manu->save();
                return $manu;
            }
        } else {
            $manu = new Manutencoe();
            $manu->tipo  = $tipoManutencao; //preventiva ou corretiva
            $manu->status = "a"; //berto
            $manu->chamado_id = $chamado["id"];
            $manu->tecnico_id = $tecnico_id;

            $manu->equipamento_id = $equipamento_id;
            $manu->save();
            return $manu;
        }
    }

    public function tecnico()
    {
        return $this->belongsTo("App\User", "tecnico_id", "id"); 
    }


    public function preventivas()
    {
        return $this->hasMany("App\preventivo","manutencao_id","id"); 
    }


    public function corretivas()
    {
        return $this->hasMany("App\corretivo","manutencao_id","id"); 
    }

}
