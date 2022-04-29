<?php

namespace App\Http\Controllers;

use App\Funcoe;
use App\Previlegio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FuncaoController extends Controller
{
    //

    function index(){
        if (!Auth::check()) {
            // The user is not logged in...
            return redirect("login");
        }
        if (!Previlegio::temPrevilegio("listar_funcoes",Auth::user()->id)):
            return view("semPermissao");
        endif;
        
        $funcoes = Funcoe::all();
        return view("Funcoes.listar")->with("funcoes",$funcoes);
    }
}
