<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Funcoesuser;
use App\Previlegio;

class UserController extends Controller
{
    //

    function listar(){
        if (!Auth::check()) {
            // The user is not logged in...
            return redirect("login");
        }
        if (!Previlegio::temPrevilegio("listar_usuarios",Auth::user()->id)):
            return view("semPermissao");
        endif;
        //pegar a pessoa logada e sua empresa
        if(isset(Auth::User()->id)){
            $empresa_id = Auth::User()->empresa_id;
            $users = User::where("empresa_id","=",$empresa_id)->get();
            return view("Usuarios.listar")->with("users",$users);
        }else{
           return redirect("home");
        }
    }

    function verFuncoes($user_id){
      $user_id = base64_decode($user_id);
      $user = User::find($user_id);
      
      return view("Usuarios.minhasFuncoes")->with("user",$user);
  
    }

    /**
     * 
     */
    public static function registarUsuario(Request $request,$empresa_id = 0)
    {

        if(!isset(Auth::user()->id)){
            return redirect("/Elevador");
        }

        // $user = new User();

        $request['password'] =  $request['cpf'];

        if($empresa_id  == 0){
            $id_empresa = Controller::getIdEmpresa();
        }else{
            $id_empresa = $empresa_id;
        }

      
        $userResult =  User::create([
            'name' => $request['nome']. " ".$request['sobrenome'],
            'email' => $request['email'],
            'empresa_id' => $id_empresa,
            'pin' => $request['cpf'],
            'password' => Hash::make($request['password']),
        ]);

        return $userResult;

    }

    public function editarSenha()
    {
        if (!Auth::check()) {
            // The user is not logged in...
            return redirect("login");
        }
        
        $user = Auth::user();
        $data = [

            "user" => $user
        ];
        return view("editarSenha", $data)->with("status", '');
    }

    public function editarSenhaSubmit(Request $request)
    {
        $userOldPass = Auth::user()->where("pin", trim($request->oldPassword))->exists();
    
        if($userOldPass){
            $newPass = $request->newPassword;
            $confirmPassword =$request->confirmPassword;

            if(trim($newPass) !== trim($confirmPassword)) {
                return view("editarSenha")->with("status", "2");
            } else {
                $user = Auth::user();
                $user->email = $request->email;
                $user->name = $request->name;
                $user->pin = $request->newPassword; 
                $user->password = Hash::make($request->newPassword);
                $user->save();

                return view("editarSenha")->with("status", "1");
            }
        } else {
            return view("editarSenha")->with("status", "0");
        }
    }

     static function  adicionarFuncaoUsuario($user_id, $funcoe_id){
         
       $funcao = new Funcoesuser();
       $funcao->funcoe_id = $funcoe_id;
       $funcao->user_id = $user_id;
       $funcao->estado = "a";
       $funcao->save();
       return true;
    }
}
