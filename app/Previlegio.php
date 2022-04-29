<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Previlegio extends Model
{
    static function temPrevilegio($pre,$user_id){
        //pegar os previlegio da pessoa logad

        $user = User::Find($user_id);
        
       foreach($user->funcoes as $funcoes):
                foreach($funcoes->previlegios as $previlegio):
                   if(strtolower($pre)  == strtolower($previlegio->descricao) and strtolower($funcoes->pivot->estado) =="a"):
                        return TRUE;
                   endif;
            endforeach;
        endforeach;
        return FALSE;
        }
}
