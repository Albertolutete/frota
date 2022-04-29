<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Componente;
use App\Subcomponente;
use Illuminate\View\Component;

class SubComponenteController extends Controller
{
    //

    function existeSubComponente($componente){
        $retorno = Subcomponente:: where("nome","=",$componente->nome)->where("componente_id","=",$componente->componente_id)->get();
        return count($retorno);
    }

    function store(Request $request){

        $subcomponente = $request->input("componente");
        $componente_id = $request->componente_id;
        $subCom = new Subcomponente();
        $subCom->nome= $subcomponente;
        $subCom->componente_id = $componente_id;
        if(!empty($subCom->nome) and $subCom->componente_id >  0):
            //verificar se ja nao existe
            if(!$this->existeSubComponente($subCom))
                $subCom->save();
        endif;

        return back();
    }
    
    function editarSubComp(Request $request){
        $subcomponente = Subcomponente::find($request->subcomponente_id);
        $nome = $request->get("subcomponente");
  
        if(!empty($nome)){
            $subcomponente->nome = $nome;
            $subcomponente->save();
            
            return back();
            
        } else {
            return "vazio";
        }
    }
    
    function deletesubcomponente($subcomp_id){
        Subcomponente::find($subcomp_id)->delete();
        
        return redirect("/equipamento");
    }


}
