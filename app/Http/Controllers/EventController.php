<?php

namespace App\Http\Controllers;

use App\empresa;
use Illuminate\Http\Request;


use App\Event;
use App\Http\Controllers\Auth\RegisterController;
use App\loja;
use App\Manutencoe;
use App\chamado;
use App\preventivo;
use App\Previlegio;
use App\tecnico;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\Isset_;

class EventController extends Controller
{


   
    public function projeto()
    {

        return view('projeto');
    }
     public function Graficos()
    {

        return view('Graficos');
    }
    
    public function Rankings(){
        
        return view('Rankings');
    }
    
    
     public function CriticoEquipamento()
    {

        return view('CriticoEquipamento');
    }
    public function CriticoManutencao()
    {

        return view('CriticoManutencao');
    }
    public function Usuarios()
    {

        return view('Usuarios');
    }
    public function Equipamentos()
    {
        if (!Auth::check()) {
            // The user is not logged in...
            return redirect("login");
        }
        if (!Previlegio::temPrevilegio("listar_equipamentos",Auth::user()->id)):
            return view("semPermissao");
        endif;
        return view('Equipamentos');
    }

    public function CadastrarProjeto()
    {

        return view('CadastrarProjeto');
    }
    public function Preventivo()
    {
        
        return view('Preventivo');
    }

    public function cadastrarUsuario()
    {
        if (!Auth::check()) {
            // The user is not logged in...
            return redirect("login");
        }
        if (!Previlegio::temPrevilegio("cadastrar_usuario",Auth::user()->id)):
            return view("semPermissao");
        endif;
        return view('CadastrarUsuario');
    }

    public function corretivo()
    {
        
        return view('corretivo');
    }

    public function validar(Request $request)
    {
        $foto = $request->input('fotoField');
        $observacoes = $request->input('obsField');
        // $status = $request->('surname');

        print_r("sucesso");
        // echo "";
    }

    public function sign(Request $request)
    {
        $file = $request->assinatura;
        
        $folderPath = public_path('../sign/'); // A pasta onde vai estar as imagens
        // $image = explode(";base64,", $request->assinatura); // 
        
        $image = json_decode($file);
        $image_type = explode("image/", $image->signature);
        $image_type_png = explode(";base64,", $image_type[1]);
        
        $image_base64 = base64_decode($image_type_png[1]);
        
        $image_name = uniqid() . '.' . $image_type_png[0];
        $file = $folderPath . $image_name;
        $data = file_put_contents($file, $image_base64);
        
        $manutencao_id = $request->manutencao_id;
        $manutencao = Manutencoe::find($manutencao_id);
        
        if (!$request->cliente) {
            $manutencao->assinaturaTecnico = $image_name;
            
        } else {
            $manutencao->assinaturaCliente = $image_name;
            
        }


        $data = $manutencao->save();

        if ($data) {
            echo "sucesso";
        }
    }

    public function registarUser(Request $request)
    {
        if(!isset(Auth::user()->id)){
            return redirect("/Elevador");
        }

        $request["empresa_id"] = Auth::user()->empresa_id;

        // $user = new User();

        $userResult =  User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'empresa_id' => $request['empresa_id'],
            'pin' => $request['password'],
            'password' => Hash::make($request['password']),
        ]);

        $userResult->save();

        redirect("/Elevador");
    }
}
