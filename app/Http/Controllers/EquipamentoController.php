<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipamento;
use App\Componente;
use App\chamado;
use App\Manutencoe;
use App\corretivo;
use App\preventivo;
use App\Subcomponente;
use App\Previlegio;
use App\Empresa;
use Illuminate\Support\Facades\Auth;


class EquipamentoController extends Controller
{
    //

    public function preencherDadosEquipamento($id)
    {
        // $chamado = new chamado();

        $equip = Equipamento::find($id);
        $empresa = Empresa::find($equip->empresa->empresa_id);

        $results = [];
        $results["nome"] = $equip->nome;
        $results["loja"] = $equip->empresa->descricao;                           // Campo por adicionar
        $results["empresa"] = $empresa->descricao;                           // Campo por adicionar
        $results["fabricante"] = $equip->fabricante;     
        $results["modelo"] = $equip->modelo;
        $results['detalhes'] = $equip->detalhes;
        $results['marca'] = $equip->marca;
        $results["numSerie"] = $equip->numeroSerie;
        $results["status"] = $equip->status;
        $results["descricao"] = $equip->descricao;
        $results["qrCode"] = asset($equip->qrCode);
        $results["anexo"] = $equip->qrcCode;

        $componentes = [];
        $compIds = [];

        foreach ($equip->componentes as $componente) {
            $componentes[] = $componente->nome;
            $compIds[] = $componente->id;
        }

        $results["componentes"] = $componentes;
        $results["compIds"] = $compIds;
        print_r(json_encode($results));
    }

    function listar()
    {
        if (!Auth::check()) {
            // The user is not logged in...
            return redirect("login");
        }

        if (!Previlegio::temPrevilegio("listar_equipamentos", Auth::user()->id)) :
            return view("semPermissao");
        endif;
        
        $equipamentos = [];
        $empresa = Empresa::find(Auth::user()->empresa_id);
        $clientes = $empresa->empresasclientes;
        foreach ($clientes as $cliente) {
            $lojas = $cliente->lojas;
            foreach ($lojas as $loja) {
                
                $equipamentos[] = Equipamento::where("empresa_id", $loja->id)->where("id", ">", 0)->orderByDesc('id')->get();
                
            }
        }
        
        
        return view('Equipamentos')->with("equipamentos", $equipamentos);
    }

    function store(Request $request)
    {

        $equi = new Equipamento();
        $equi->descricao = $request->input("descricao");
        $equi->nome = $request->input("nome");
        $equi->qrCode = "";
        $equi->modelo = $request->input("modelo");
        $equi->numeroSerie = $request->input("numeroSerie");
        $equi->marca = $request->input("marca");
        $equi->status = $request->input("status");
        $equi->fabricante = $request->input("fabricante");
        $equi->empresa_id = Auth::user()->empresa_id;                               // Atribui este equipamento a loja selecionada
        $equi->save();
        //criar qrcode
        //$nome = "imagens/qrCode.png";
        require_once('phpqrcode/qrlib.php');
        $equi->qrCode =  criarQRcode($equi->id);
        $equi->save();
        return redirect("equipamento");
    }


    function pesquisar(Request $request)
    {
        $parametro = $request->input("parametro");
        $equipamentos = Equipamento::where("descricao", "like", "%$parametro%")->get();
        return view("Equipamentos")->with("equipamentos", $equipamentos);
    }

    public function editarequipamento(Request $request, $equipamento_id)
    {

        $equipamento = Equipamento::find($equipamento_id);

        // $method = $request->method();

        if (!$request->isMethod('post')) {
            return $equipamento;
        }

        $equipamento->descricao = $request->input("descricao");
        $equipamento->nome = $request->input("nome");
        $equipamento->modelo = $request->input("modelo");
        $equipamento->numeroSerie = $request->input("marca");
        $equipamento->marca = $request->input("marca");
        $equipamento->status = $request->input("status");
        $equipamento->fabricante = $request->input("fabricante");
        $equipamento->empresa_id =  Auth::user()->empresa_id;

        $equipamento->save();

        return redirect("/equipamento");
    }

    public function deleteequipamento($equipamento_id)
    {

        $equipamento = Equipamento::find($equipamento_id);
        $manutencoes = Manutencoe::where("equipamento_id", $equipamento_id)->get();
        $componentes = Componente::where("equipamento_id", $equipamento->id)->get();
        $chamados = chamado::where("equipamento_id", $equipamento->id)->get();
        
        $equipamento->chamados()->delete();
        
        foreach($manutencoes as $man){
            $man->preventivas()->delete();
            $man->corretivas()->delete();
            $man->delete();
        }
        
        foreach($componentes as $comp) {
            $comp->subcomponentes()->delete();
            $comp->delete();
            
        }
        
        foreach($chamados as $cham){
            $cham->delete();
        }
        
        
        $equipamento->delete();
        return redirect("/equipamento");
    }
}
