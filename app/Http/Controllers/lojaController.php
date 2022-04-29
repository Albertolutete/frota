<?php

namespace App\Http\Controllers;

use App\loja;
use App\Equipamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class lojaController extends Controller
{
    

    public function Loja()
    {
        $Lojas =  loja::all();

        return view('Lojas', ['Lojas' => $Lojas]);
    }

    public function cadastrarLoja()
    {
        return view("CadastrarLojas");
    }

    public function cadastarLojaSubmit(Request $request)
    {

        $request->validate(
            [
                "descricao" => "required"
            ]
        );
        $Lojas = new loja();

        // $teste = $request

        $Lojas->descricao = $request->descricao;
        $Lojas->cidade = $request->cidade;
        $Lojas->responsavel = $request->responsavel;
        $Lojas->estado = $request->estado;
        $Lojas->bairro = $request->bairro;
        $Lojas->logradouro = $request->logradouro;
        $Lojas->numero = $request->numero;
        $Lojas->cep = $request->cep;
        $Lojas->cnpj = $request->cnpj;
        $Lojas->email = $request->email;
        $Lojas->status = $request->status;
        $Lojas->empresa_id = 0;
        $Lojas->telefone = $request->telefone;


        $Lojas->save();
        if (!Auth::check()) {
            return "loggedout";
        }
        if ($Lojas) {

            return back();
        }
    }
    public function deletarLoja($id)
    {
        loja::findOrfail($id)->delete();

        return redirect('/Lojas')->with('msg', '');

    }

    public function buscarEquipamentos($loja_id = null)
    {
        $result = '';
        if($loja_id !== null){
            $empresa_id = $loja_id;
            $equipamentos = Equipamento::where("empresa_id", $empresa_id)->get();
            
            foreach($equipamentos as $equipamento){     
                $result .= '<option value="'. $equipamento->id . '">'. $equipamento->nome .'</option>';
            }
        }

        return $result;
    }
}
