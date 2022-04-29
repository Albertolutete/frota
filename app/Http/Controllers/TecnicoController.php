<?php

namespace App\Http\Controllers;

use App\tecnico;

use App\Funcoesuser;
use App\Empresa;
use App\Previlegio;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class TecnicoController extends Controller
{


    function apresentar($equipamento_id, $tipoManutencao)
    {
        // if (!Auth::check()) {
        //     // The user is not logged in...
        //     return redirect("login");
        // }   
        $equipamento_id = base64_decode($equipamento_id);
        // return view("auth.loginTecnico")->with("equipamento_id", $equipamento_id)->with("tipoManutencao", $tipoManutencao); // descomentar depois


    // Para testes
        $tecnico = User::where("email", "=", "elias@gmail.com")->where("pin", "=", 123)->get();
        // $tecnico_id = $tecnico[0]->id; // Descomentar depois se...
        
        $tipo = $tipoManutencao;

        if ($tipo == "preventivo") {
            //  return view("Preventivo")->with("tecnico",$tecnico)->with("equi_id",$equipamento_id);
            return redirect("/Preventivo?id=" . base64_encode($equipamento_id) . "&tecnico_id=" . base64_encode(13));
            // return view("Preventivo")->with("tecnico",$tecnico)->with("equi_id",$equipamento_id);
        } else {
            return redirect("/corretivo?id=" . base64_encode($equipamento_id) . "&tecnico_id=" . base64_encode(13));
            //  return view("corretivo")->with("tecnico",$tecnico)->with("equi_id",$equipamento_id);
        }
    }
    
    // fim para testes

    function logar(Request $request)
    {
        $senha            = $request->input("password");
        $email            =  $request->input("email");
        $equipamento_id   = $request->input("equipamento_id");
        $tipo             = $request->input("tipoManutencao");

        $tecnico          =  User::where("email", "=", $email)->where("pin", "=", $senha)->get();

        if ($tipo == "preventivo") {
            //  return view("Preventivo")->with("tecnico",$tecnico)->with("equi_id",$equipamento_id);
            return redirect("/Preventivo?id=" . base64_encode($equipamento_id) . "&tecnico_id=" . base64_encode($tecnico[0]->id));
            // return view("Preventivo")->with("tecnico",$tecnico)->with("equi_id",$equipamento_id);
        } else {
            return redirect("/corretivo?id=" . base64_encode($equipamento_id) . "&tecnico_id=" . base64_encode($tecnico[0]->id));
            //  return view("corretivo")->with("tecnico",$tecnico)->with("equi_id",$equipamento_id);
        }
    }

    public function Tecnico()
    {
        if (!Auth::check()) {
            // The user is not logged in...
            return redirect("login");
        }
       // if (!Previlegio::temPrevilegio("listar_tecnico",Auth::user()->id)):
           // return view("semPermissao");
        //endif;
        $empresa = Empresa::find(Auth::user()->empresa_id);
        $usuarios = $empresa->usuarios;
        
        $Tecnico = [];
        foreach ($usuarios as $user) {
            $Tecnico[] = tecnico::where("user_id", $user->id)->get();
        }
        return view('Tecnico', ['Tecnico' => $Tecnico]);
    }

    public function tecEvent(Request $request)
    {
 
        $request->validate(
            [
                "nome" => "required"
            ]
        );
        $Tecnico = new tecnico();

        //verificar email
        if($this->existeEmail($request->email)){
            return "nok";
        }

        $user = UserController::registarUsuario($request);

        //criar user
        $Tecnico->cpf = $request->cpf;
        $Tecnico->rg = $request->Rg;
        $Tecnico->telefone = $request->telefone;
        $Tecnico->Prestadoraservico_id =UserController::getIdEmpresa();
        $Tecnico->user_id = $user->id; 
        $dados = $Tecnico->save();

        // adicionar as funcoes do user registado
        $funcao = new Funcoesuser();

    
        UserController::adicionarFuncaoUsuario($user->id,3);// onde 2 indica o id da funcao tecnico
        if ($dados) {
            echo "ok";
        }
    }

    public function cadastrarTecni()
    {
        if (!Auth::check()) {
            // The user is not logged in...
            return redirect("login");
        }
        //if (!Previlegio::temPrevilegio("registar_tecnico",Auth::user()->id)):
           // return view("semPermissao");
        //endif;

        return view('CadastrarTecni');
    }

    public function tecnicodeletar($tecnico_id)
    {
            
        $tecnico = tecnico::findOrfail($tecnico_id);
        
        User::findOrfail($tecnico->user_id)->delete();
        
        
                $tecnico->delete();

        return redirect('/Tecnico')->with('msg', '');
    }
      public function editar(){
         return view('EditarTecni');
    }
}
