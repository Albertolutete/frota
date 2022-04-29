<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Componente;
use App\Subcomponente;
use Illuminate\View\Component;

class ComponenteController extends Controller
{
    //

    function existeComponente($componente){
        $retorno = Componente:: where("nome","=",$componente->nome)->where("equipamento_id","=",$componente->equipamento_id)->get();
        return count($retorno);
    }

    function store(Request $request){

        // return "OOOOoiiiii";
        $componente = $request->input("componente");
        $equi_id = $request->input("equipamento_id");
        $com = new Componente();
        $com->nome= trim($componente);
        $com->equipamento_id = $equi_id;
        if(!empty($com->nome) and $com->equipamento_id >  0):
            //verificar se ja nao existe
            if(!$this->existeComponente($com))
                $com->save();
        endif;

        return back();
    }

    function preencherSubComponentes($componente_id)
    {
        $componente = Componente::find($componente_id);
        $result1 = "<button type='button' class='btn btn-outline-secondary p-1 mb-3' onclick='addSubComponente(this, $componente_id)'>Adicionar Subcomponente
        <i style='font-size: 24px; z-index: 99' class='fas fa-plus-square align-middle'></i></button>";
        $result = "";
        foreach ($componente->subcomponentes as $componente) {
            $nome = $componente->nome;
            $result .= "
            <h4 style='background: #f1f1f1; padding: 7px 15px; display:grid; justify-content: space-between; grid-template-columns: repeart(2, 1fr); color:#0b6bda' >
                <p>$componente->nome</p>
                <div style='display: flex; justify-content: flex-end;'>
                    <button title='Editar' type='button' class='btn-min btn-outline-edit me-3' onclick='editarSubComponente(this, $componente->id , \"$nome\")'><span class='mdi mdi-account-edit'></span></button>
                     <button class='btn-min btn-outline-delete' onclick='deletarSubComp($componente->id)'><span class='mdi mdi-delete'></span></button>
                </div>
                <div style='grid-column: span 2;' class='editar'></div>
            </h4>
            ";
        }

        if(empty($result)){
            $result1 = "<p>Nao existe nenhum subcomponente para este Componente</p>" . $result1;
        }else {
            return $result1 .= $result;
        }
        
        return $result1;
    }
    
    function editarComp(Request $request){
        $componente = Componente::find($request->componente_id);
        $nome = $request->get("componente");
        return $componente;
        if(!empty($nome)){
            $componente->nome = $nome;
            $componente->save();
            
            return back();
            
        } else {
            return "Nome vazio";
        }
    }
    
    function deletecomponente($comp_id){
        
        $componente = Componente::find($comp_id);
        $componente->subcomponentes()->delete();

        $componente->delete();
        
        return redirect("/equipamento");
        
    }
}
