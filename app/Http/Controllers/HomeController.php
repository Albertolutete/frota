<?php

namespace App\Http\Controllers;

use App\chamado;
use App\Previlegio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (!Auth::check()) {
            // The user is not logged in...
            return redirect("login");
        }
        
        if (!Previlegio::temPrevilegio("listar_chamado",Auth::user()->id)):
            return view("semPermissao");
        endif;
        
        $chamados = chamado::all();
     
        $total = $chamados->count();
        return view('home', ["chamados" => $chamados, "total" => $total]);
    }


   
}
