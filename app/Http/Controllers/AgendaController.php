<?php

namespace App\Http\Controllers;
use App\agenda;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\Isset_;

class AgendaController extends Controller
{
    
    
     public function Calendario()
    {
        
        $Agenda = agenda::all();
        
       foreach($Agenda as $agenda){
           $events[]=[
               
               'titulo'=>$agenda->titulo,
               'cor'=>$agenda->cor,
               'dataInicio'=>$agenda->dataIncio,
               'dataFim'=>$agenda->dataFim,
               ];
               
                      }
                      
                     
        
        return view('calendario',['events'=>$events]);
    }
}
