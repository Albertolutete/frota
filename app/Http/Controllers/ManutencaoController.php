<?php

namespace App\Http\Controllers;

use App\corretivo;
use Illuminate\Http\Request;
use App\Manutencaocomponente;
use App\Manutencoe;
use App\chamado;
use App\Empresa;
use App\preventivo;
use App\Equipamento;
use App\Previlegio;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class ManutencaoController extends Controller
{
    //
    
    function uploadficheiro($file)
    {
        $caminho = "";
        if (!empty($file)) :
            return "ok";
        // $caminho = $file->store("ficheiros", "public");
        endif;
        return $caminho;
    }

    function getIdManutencao($manutencao_id)
    {
        $manutencao = Manutencoe::find($manutencao_id);
        return $manutencao->equipamento_id;
    }

    function fecharManutencao($manutencao_id)
    {
        $manutencao = Manutencoe::find($manutencao_id);
        $preventivo = preventivo::where("manutencao_id", $manutencao_id)->where("estado_manutencao", "a")->get();
        $manutencao->status = "f";
        
        foreach ($preventivo as $prev) {
            $prev->estado_manutencao = "f";
            $prev->save();
        }
        $chamdado = chamado::find($manutencao->chamado_id);
        if($chamdado){
            $chamdado->status = "f";
            $chamdado->save();

        }
        $manutencao->save();
        return "ok";
    }

    function store(Request $request)
    {
        $man_prev = preventivo::where("manutencao_id", $request->get("manutencao_id"))->where("subtitulo", $request->get("tipoManPrev"))->get();

        if (count($man_prev) > 0) {
            if ($request->has("status_select")) {
                $man_prev[0]->status = $request->get("status_select");
            } else {
                return "nok";
            }
            if ($request->hasFile('foto')) {

                $request->validate([
                    'image' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
                ]);
                // Save the file locally in the storage/public/ folder under a new folder named /chamado
                $request->foto->store('ficheiros', 'public');

                // Store the record, using the new file hashname which will be it's new filename identity.
                $man_prev[0]->foto = $request->foto->hashName();
            }
            $man_prev[0]->observacoes = $request->get('observacoes');
            $man_prev[0]->save();
            return "ok";
        }


        $prevent = new preventivo();
        $prevent->titulo = $request->get('nomeManPrev');
        $prevent->subtitulo = $request->get('tipoManPrev');
        // $prevent->dataAbertura = date('Y:m:d H:i');
        $prevent->observacoes = $request->get('observacoes');
        if (!$request->get('manutencao_id')) {
            $request["manutencao_d"] =  "";
        }
        $prevent->manutencao_id = $request->get('manutencao_id');                               // Campo por adicionars
        $prevent->estado_manutencao = "a";
        // $manu = Manutencoe::find($prevent->manutencao_id);
        // $cmd = chamado::find($manu->chamado_id);
        // // $cmd->status = "a";
        // $cmd->save();
        date_default_timezone_set('America/Sao_Paulo');

        // verifica se tem menos status selecionado
        if ($request->has("status_select")) {
            $prevent->status = $request->get("status_select");
        } else {
            return "nok";
        }

        // verifica se tem uma foto selecionada
        if ($request->hasFile('foto')) {

            $request->validate([
                'image' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);
            // Save the file locally in the storage/public/ folder under a new folder named /chamado
            $request->foto->store('ficheiros', 'public');

            // Store the record, using the new file hashname which will be it's new filename identity.
            $prevent->foto = $request->foto->hashName();
        }


        $dados = $prevent->save(); // Finally, save the record.

        if ($dados) {

            echo "ok";
        } else {
            echo "nok";
        }
    }

    function storeCorretiva(Request $request)
    {

        $man_corr = corretivo::where("manutencao_id", $request->get("manutencao_id"))->exists();

        if ($man_corr) {
            return "existe";
        }

        $corretiva = new corretivo();
        $corretiva->manutencao_id = $request->get('manutencao_id');                     // Campo por adicionars
        $corretiva->observacoes = $request->get('observacoes');
        $corretiva->material_aplicado = $request->get("material");
        $corretiva->situacao_equipamento = $request->get("situacao");
        date_default_timezone_set('America/Sao_Paulo');


        // verifica se tem uma foto selecionada
        if ($request->hasFile('tec_manutencao')) {
            $request->validate([
                'image' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);
            // Save the file locally in the storage/public/ folder under a new folder named /chamado
            $request->tec_manutencao->store('ficheiros', 'public');

            // Store the record, using the new file hashname which will be it's new filename identity.
            $corretiva->foto = $request->tec_manutencao->hashName();
        }

        $dados = $corretiva->save(); // Finally, save the record.

        if ($dados) {
            $this->fecharManutencao($request->get('manutencao_id'));
            // $enviarEmail = new ChamadoController();
            // $enviarEmail->enviarEmailManutencao($man_corr[0]->equipamento_id);
            echo "ok";
        } else {
            echo "nok";
        }
    }
    function getManutencao()
    {
        if (!Auth::check()) {
            // The user is not logged in...
            return redirect("login");
        }
        if (!Previlegio::temPrevilegio("listar_manutencao", Auth::user()->id)) :
            return view("semPermissao");
        endif;
        
        $tipoManutencao = filter_input(INPUT_GET, 'tipo');
        $equipamentos = [];
        $conjuntoManutencao = [];

        $empresa = Empresa::find(Auth::user()->empresa_id);
        if (strtolower($tipoManutencao) == "preventivo") {
            $tipo = "p";
            $view = "ManutencaoPreventiva";
        } else {
            $tipo = "c";
            $view = "ManutencaoCorretiva";
        }
        
        if ($empresa->tipo == "principal") {

            $equipamentos = $empresa->equipamentos;
     
            foreach($equipamentos as $equip){
                // echo "Imprimindo<br><br>" . $equip;
                $conjuntoManutencao[] = Manutencoe::orderbydesc("id")->where("equipamento_id", $equip->id)->where("tipo", $tipo)->get();
            }
            
            
        } else if($empresa->tipo == "cliente"){
            
            $lojas =  Empresa::where("empresa_id", Auth::user()->empresa_id)->get();

            foreach ($lojas as $loja){
                $equipamentos[] = Equipamento::where("empresa_id", $loja->id)->get("id");
                
            }
            
            $conjuntoManutencao = [];
            foreach($equipamentos as $equipamento) {
                foreach($equipamento as $equip){
                    $conjuntoManutencao[] = Manutencoe::where("equipamento_id", $equip->id)->where("tipo", $tipo)->get();
                }
            }
            
        }
            
        return view($view)->with("manutencoes", $conjuntoManutencao);
        // } else {
        //     if ($empresa->tipo == "principal") {
                
        //         $clientes =  $empresa->empresasclientes->where("tipo", "<>", "principal");

        //         foreach ($clientes as $cliente){
                    
        //             $lojas = $cliente->lojas;
        //             foreach($lojas as $loja){
                        
        //                 $equipamentos = $loja->equipamentos;
                        
                        
        //                 foreach($equipamentos as $equip){
        //                     // echo "Imprimindo<br><br>" . $equip;
        //                     $conjuntoManutencao[] = Manutencoe::orderbydesc("id")->where("equipamento_id", $equip->id)->where("tipo", "c")->get();
        //                 }
                        
        //             }
                    
        //         }
        //     } else {
        //         // $manutencoes = Manutencoe::orderbydesc("id")->where("tipo", "c")->get();
                
        //         $lojas =  Empresa::where("empresa_id", Auth::user()->empresa_id)->get();
                
        //         foreach ($lojas as $loja){
        //             $equipamentos[] = Equipamento::where("empresa_id", $loja->id)->get("id");
                    
        //         }
                
        //         $conjuntoManutencao = [];
        //         foreach($equipamentos as $equipamento) {
        //             foreach($equipamento as $equip){
        //                 $conjuntoManutencao[] = Manutencoe::where("equipamento_id", $equip->id)->where("tipo", "c")->get();
        //             }
        //         }
        //     }

        //     return view("ManutencaoCorretiva")->with("manutencoes", $conjuntoManutencao);
        // }
    }

    function terminarManutencao($manutencao_id)
    {
        $id_manutencao = base64_decode($manutencao_id);
        $man = Manutencoe::find($id_manutencao);
        $mc = Manutencaocomponente::where("manutencoe_id", "=", $id_manutencao)->get();
        foreach ($mc as $c) {
            $c->delete();
        }
        $man->delete();
        return redirect("manutencoes");
    }

    public function deletarManutencao($id)
    {
        $tipoManutencao = filter_input(INPUT_GET, 'tipo');

        if (strtolower($tipoManutencao) == "preventivo") {
            preventivo::findOrfail($id)->delete();
            return redirect('/manutencao?tipo=preventivo')->with('msg', '');
        } else {
            corretivo::findOrfail($id)->delete();
            return redirect('/manutencao?tipo=corretivo')->with('msg', '');
        }
    }
}
