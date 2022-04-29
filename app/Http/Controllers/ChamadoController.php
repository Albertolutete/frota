<?php

namespace App\Http\Controllers;

use App\chamado;
use App\Empresa;
use App\Equipamento;
use App\Manutencoe;
use App\Previlegio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChamadoController extends Controller
{

    public function paginaPrincipal()
    {
        return view('paginaPrincipal');
    }

    public function AbrirChamado()
    
    {
        return view("AbrirChamado") ;
    }

    public function verificarChamado($equipamento_id)
    {
        // return $equipamento_id;
        return chamado::where("equipamento_id", $equipamento_id)->where("status", "a")->exists();
    }
    public function CadastrarChamado(Request $request)
    {
        // Verifica se ja existe uma chamado aberto para o equipamento
        if ($this->verificarChamado($request->get("equipamento_id"))) {
            return "existe";
        }

        if (!$request->get("equipamento_id")) {
            return "nok";
        }
        $chamado = new chamado();
        date_default_timezone_set('America/Sao_Paulo');

        if ($request->hasFile('tec_manutencao')) {

            $request->validate([
                'image' => 'mimes:jpeg,bmp,png'             // Only allow .jpg, .bmp and .png file types.
            ]);
            // Save the file locally in the storage/public/ folder under a new folder named /chamado
            $request->tec_manutencao->store('chamados', 'public');

            // Store the record, using the new file hashname which will be it's new filename identity.
            $chamado->anexo = $request->tec_manutencao->hashName();
        } else {
            $chamado->anexo = "";
        }

        $chamado->nome = $request->get('nome');
        $chamado->equipamento_id = $request->get("equipamento_id");                       
        $chamado->empresa_id = $request->get("empresa_id");                      
        $chamado->Motivo = $request->input('motivo');
        $chamado->cargo = $request->input('cargo');
        $chamado->status = "a";
        $chamado->telefone = $request->get('telefone');
        $chamado->tipo = $request->get('tipo');
        $chamado->detalhes = $request->get("detalhes"); 
        $chamado->loja_id = $request->get("loja_id");               // Descomentar depois de fazer o refresh
        
        $this->enviarEmailChamado($chamado->equipamento_id);
        $dados = $chamado->save();                          // Finally, save the record. // campo por esclarecer
        // $tecnico_id = 1;
        return "ok";

    }

    public function listarChamados()
    {
        // 
        $empresa = Empresa::find(Auth::user()->empresa_id);
        if ($empresa->tipo == "principal") {
            $clientesDaEmpresaLogada = $empresa->empresasclientes;
            
            foreach ($clientesDaEmpresaLogada as $cliente){
                $chamados[] = chamado::orderbydesc("id")->where("empresa_id", $cliente->id)->get();
            }
            
        } else if($empresa->tipo == "cliente"){
            $chamados[] = chamado::where("empresa_id", Auth::user()->empresa_id)->orderbydesc("id")->get();
        }

        $output = "";
        foreach ($chamados as $chamadosintem) {
            foreach ($chamadosintem as $chamado){
                $status = $chamado->status;
                $close = "inline-block";
                $open = "none";
                if ($status == "f") {
                    $open = "inline-block";
                    $close = "none";
                }
    
                $detail = $chamado->detalhes;
                $detalhes = substr($detail, 0, 15);
    
    
                //echo  "teste";   
                $empresa = Empresa::find($chamado->empresa_id);
                $output .=  '
                <tr>
                    <td>' . $chamado->nome . '</td>
                    <td>' . $this->getTipo($chamado->tipo) . '</td>
                    <td>' . $empresa->descricao . '</td>
                    <td>' . $chamado->equipamento->nome . '</td>
                    <td>' . $chamado->Motivo . '</td>
                    <td>' . $chamado->Telefone . '</td>
                    <td>
                        <span class="" style="font-size: 22px">
                            <i style="color: blue;cursor:pointer; display: ' . $close . '" class="far fa-envelope abrir" data-toggle="modal"
                                data-target="#modal-xl" onclick="abrirEnvelope(this, ' . $chamado->id . ')"></i>
                            <i class="fas fa-check" data-toggle="modal"
                                data-target="#modal-xl" style="color:green; cursor:pointer ;display: ' . $open . '"
                                onclick="abrirEnvelope(this, ' . $chamado->id . ')"></i>
                        </span>
                    </td>
                    
                </tr>
            ';
                
            }
        }
        if(empty($output)){
            $output = "<tr><td align=center colspan=7><p class='mx-auto'>Não existe nenhuma solicitação disponível</p>.</td></tr>";
        }
        echo $output;
    }

    public function getTipo($tipo)
    {
        switch ($tipo) {
            case 'p':
                return "Preventivo";
            case 'c':
                return "Corretivo";
            default:
                return "";
        }
    }
    public function abrirEnvelope($id)
    {
        // $chamado = new chamado();

        $cmd = chamado::find($id);

        $empresa = Empresa::find($cmd->empresa_id);

        $results = [];
        $results["nome"] = $cmd->nome;
        $results["empresa"] = $empresa->descricao;                           // Campo por adicionar
        $results["equipamento"] = $cmd->equipamento->nome;                   // Campo por adicionar
        $results["motivo"] = $cmd->Motivo;
        $results["tipo"] = $this->getTipo($cmd->tipo);
        $results["telefone"] = $cmd->Telefone;
        $results['detalhes'] = $cmd->detalhes;
        $results["cargo"] = $cmd->cargo;
        $data = $cmd->created_at->format('d/m/Y');
        $data .= " às " . $cmd->created_at->format('H:i');
        $results["data"] = $data;
        $results["anexo"] = $cmd->anexo;

        print_r(json_encode($results));
    }


    public function obterStatus()
    {
        $empresa = Empresa::find(Auth::user()->empresa_id);
        // $chamados = chamado::all();
        
        if ($empresa->tipo == "principal") {
            
            $clientesDaEmpresaLogada = $empresa->empresasclientes;
            
            foreach ($clientesDaEmpresaLogada as $cliente){
                $chamadosTotal[] = chamado::orderbydesc("id")->where("empresa_id", $cliente->id)->get();
                $chamadosAbertos[] = chamado::where("empresa_id", $cliente->id)->where("status", "a")->count();
                $chamadosEspera[] = chamado::where("empresa_id", $cliente->id)->where("status", "f")->count();
            }
            
            // $chamadosTotal = chamado::orderbydesc("id")->get();
            
            // $chamadosTotal = count($chamados);
            
        } else if($empresa->tipo == "cliente"){
            $chamadosTotal[] = chamado::where("empresa_id", Auth::user()->empresa_id)->get();
            $chamadosAbertos[] = chamado::where("status", "a")->where("empresa_id", Auth::user()->empresa_id)->count();
            $chamadosEspera[] = chamado::where("status", "f")->where("empresa_id", Auth::user()->empresa_id)->count();
        
        }
        $total = 0;
        foreach($chamadosTotal as $chamTotal){
            $total += count($chamTotal);
        }
        
        $chamadosAb = 0;
        foreach($chamadosAbertos as $chamAbertos){
            $chamadosAb += $chamAbertos;
        }
            
        $chamadosEsp = 0;
        foreach($chamadosEspera as $chamTotal){
            $chamadosEsp += $chamTotal;
        }
        $output = "";
        $output .= $total . "," . $chamadosAb . "," . $chamadosEsp;

        echo $output;
    }

    public function FinalizarChamado()
    {
        return view('FinalizarChamado');
    }

     
    function enviarEmailManutencao($equipamento_id = 0)
    {
        //pegar o email o propreitrio do equipamento
        $this->getEmail($equipamento_id);
        exit();

        $emailDestino = "elevadores@havan.com.br";
        $equipamento_id = base64_encode("1");
        $arquivo = "
        <html>
        <body>
          <h1>Manutenção efetuada com sucesso. Segue em Anexo o link para download do Relatório</h1>
          <a href='https://www.gruposipar.com/Elevador?id=$equipamento_id'>Clique aqui para recuperar a senha( https://www.gruposipar.com/Elevador?id=$equipamento_id) </a>
         
        </body>
        </html>";


        $emissor = "nailton@7elevadores.com.br";
        $origem = "Havan";
        //email padrao
        $destinoEmail = $emailDestino;
        $assunto = "Assunto do email";
        $header = 'MIME-version:1.0' . "\r\n";
        $header .= 'Content-type:text/html; charset=iso-8859-1' . "\r\n";
        $header .= 'From:' . $origem . '<' . $emissor . '>';
        $en = mail($destinoEmail, $assunto, $arquivo, $header);

        if ($en) :
            return "enviado com sucesso";
        else :
            return "nao foi possivel enviar";
        endif;
    }

    /**
     * este metodo devolve o email da empresa que efectua  a manutencao do equipamento que esta efectuar o chamado
     */
    function getEmailDestinoChamado($equipamento_id){
        $equipamento = Equipamento::find($equipamento_id);
        //b empresa que gerencia esta empresa
        //pegar a o email da empresa gerencie a empresaa....
        $lojaDonaEquipamento = Empresa::find($equipamento->empresa_id);
        $empresaDonaDaLoja = Empresa::find($lojaDonaEquipamento->empresa_id);
        $empresaPrestadoraServico = Empresa::find($empresaDonaDaLoja->empresa_id);

        return $empresaPrestadoraServico->email;
    }

    /**
     * este metodo retorna o email da empresa que efectua  o envio do do chamado
     */
    function getEmailEmissorChamado($equipamento_id){
        $equipamento = Equipamento::find($equipamento_id);
        $loja = Empresa::find($equipamento->empresa_id);
        $empresa = Empresa::find($loja->empresa_id);
        $array = array("empresa"=>$empresa->descricao,"email"=>$empresa->email);
        return $array;
    }
    
    function enviarEmailChamado($equipamento_id = 0)
    {
        //$emailDestino = "albertolutete10@gmail.com";
       $emailDestino =  $this->getEmailDestinoChamado($equipamento_id);
       $dadosEmissor  = $this->getEmailEmissorChamado($equipamento_id);//"elevadores@havan.com.br";
       $emissor = $dadosEmissor["email"];
        //   return $emissor;

        $equipamento_id = base64_encode($equipamento_id);
        $arquivo = "
        <html>
        <body>
          <h1>Solicitação de manutenção, segue em anexo o pedido para a manutenção:</h1>
          <a href='https://www.gruposipar.com/Elevador/resumo?id=$equipamento_id'>Vizualizar anexo ( https://www.gruposipar.com/Elevador/resumo?id=$equipamento_id) </a>
         
        </body>
        </html>";

        $origem = $dadosEmissor["email"];
        //email padrao
        $destinoEmail = $emailDestino;
        $assunto = "Assunto do email";
        $header = 'MIME-version:1.0' . "\r\n";
        $header .= 'Content-type:text/html; charset=iso-8859-1' . "\r\n";
        $header .= 'From:' . $origem . '<' . $emissor . '>';
        $en = mail($destinoEmail, $assunto, $arquivo, $header);

        if ($en) :
            return "enviado com sucesso";
        else :
            return "nao foi possivel enviar";
        endif;
    }

    public function resumo()
    {
        return view("relatorioChamado");
    }

    public function getMessageManutencao()
    {
    }
}
