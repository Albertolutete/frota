<?php

namespace App\Http\Controllers;

use App\Funcoe;
use App\Previlegio;
use App\Previlegiofuncoe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrevilegioController extends Controller
{
    //

    function index($funcao_id){

       $id= base64_decode($funcao_id);
        if (!Previlegio::temPrevilegio("listar_previlegios",Auth::user()->id)):
            return view("semPermissao");
        endif;
        $funcao = Funcoe::find($id);
        return view("Funcoes.previlegios")->with("funcao",$funcao);
        
    }

    function remover($previlegio_id, $funcao_id){
        $id_previlegio = base64_decode($previlegio_id);
        $id_funcao = base64_decode($funcao_id);

        $funcaoPrevilegio = Previlegiofuncoe::where("previlegio_id","=",$id_previlegio)->where("funcoe_id","=",$id_funcao)->get();
        $obj = $funcaoPrevilegio[0];
        $obj->delete();
        return view("sms.mensagem")->with("mensagem",$this->getMensagem(
            "Função Removido com Sucesso",
            "Listar Funções",
            "funcoes.listar",
            "green"));
    }
}
