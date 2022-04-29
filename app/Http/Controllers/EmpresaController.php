<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Empresa;
use App\Previlegio;
use Illuminate\Support\Facades\Auth;


class EmpresaController extends Controller
{
    
   
    public function Empresas()
    {
        if (!Auth::check()) {
            // The user is not logged in...
            return redirect("login");
        }
        
        if (!Previlegio::temPrevilegio("listar_empresas",Auth::user()->id)):
            return view("semPermissao");
        endif;
        
        $Empresa =  Empresa::orderbydesc("id")->where("id", "<>", Auth::user()->id)->where("tipo", "<>", "loja")->where("tipo", "<>", "principal")->get();
        
        $empresa = Empresa::find(Auth::user()->empresa_id);
        
        // $cliente = Empresa::select("*")
        // ->where('tipo', 'cliente-comum')
        // ->get();
        
        
        $clientes =  $empresa->empresasclientes->where("tipo", "<>", "principal");
        // array_push($clientes, $cliente);
        
        return view('Empresas', ['Empresa' => $clientes]);
    }

    public function CadastrarEmpresas()
    {
        if (!Auth::check()) {
            // The user is not logged in...
            return redirect("login");
        }
        if (!Previlegio::temPrevilegio("registar_empresa",Auth::user()->id)):
            return view("semPermissao");
        endif;
        return view('CadastrarEmpresas');
    }

    public function cadastarempresaSubmit(Request $request)
    {
        if($this->existeEmail($request->email)){
            return "nok";
            return $this->existeEmail($request->email);
        }
        $Empresa = new Empresa();

        if (!Auth::check()) {
            // The user is not logged in...
            return "logout";
        }
        // return "Nao verificou";
        $empresa_id = Auth::user()->empresa_id;
        
        if($request->tipo == "loja"){
            $empresa_id = $request->empresa_id;
        }
        // $teste = $request
        
        $Empresa->descricao = $request->descricao;
        $Empresa->cidade = $request->cidade;
        $Empresa->responsavel = $request->responsavel;
        $Empresa->estado = $request->estado;
        $Empresa->bairro = $request->bairro;
        $Empresa->logradouro = $request->logradouro;
        $Empresa->numero = $request->numero;
        $Empresa->cep = $request->cep;
        $Empresa->cnpj = $request->cnpj;
        $Empresa->email = $request->email;
        $Empresa->status = $request->status;
        $Empresa->tipo = $request->tipo;
        $Empresa->empresa_id = $empresa_id;
        $Empresa->telefone = $request->telefone;
        $requests = new Request();

        $partes =  explode(" ",$Empresa->responsavel);
        if(count($partes) > 1):
            $requests["sobrenome"] =  $partes[1];
        else:
            $requests["sobrenome"] =  "";
        endif;
            
        $requests["email"] =  $Empresa->email ;
        $requests["nome"] =  $partes[0];

        $requests["password"] =  $Empresa->cnpj ;
        $requests["cpf"] =  $Empresa->cnpj ;


        if ($request->hasFile('logo')) {

            $request->validate([
                'image' => 'mimes:jpeg,bmp,png'             // Only allow .jpg, .bmp and .png file types.
            ]);
            // Save the file locally in the storage/public/ folder under a new folder named /Empresa
            $path_logo = $request->logo->store('logo_empresas', 'public');
            // Store the record, using the new file hashname which will be it's new filename identity.
            $Empresa->logo = $path_logo;
        } else {
            $Empresa->logo = "";
        }

        
        
        $Empresa->save();
        
        // return "$Empresa";
        
        $user=  UserController::registarUsuario($requests,$Empresa->id);
        //onde o 2 passado como parametro representa a funcao de prestador de servico
        UserController::adicionarFuncaoUsuario($user->id,2);
        // return $user;

        //registar user

        //registar a funcao do user
        // return "oooooOA";
        
        
        echo "ok";
    }

    public function deletarEmpresa($id)
    {
        $empresa = Empresa::findOrfail($id);

        foreach($empresa->lojas as $loja){
            $this->deleteHelper($loja->id);
        }
        // $loja->usuarios()->delete();
        $empresa->delete();
        return redirect('/Empresas')->with('msg', 'Empresa eliminado com sucesso!');

    }
    
    public function buscarLojas($empresa_id = null)
    {
        $result = '';
        if($empresa_id !== null){
            $empresaCliente_id = $empresa_id;
            // $empresas = Empresa::where("empresa_id", $empresaCliente_id)->get();
            
            $lojas = Empresa::find($empresaCliente_id)->lojas;

            foreach($lojas as $empresa){     
                $result .= '<option value="'. $empresa->id . '">'. $empresa->descricao .'</option>';
            }
        }

        return $result;
    }
    
    function preencherDadosEmpresa($empresa_id){
        $empresa = Empresa::find($empresa_id);
        // $lojas = Empresa::find($empresa->lojas->empresa_id);

        $results = [];
        $results["nome"] = $empresa->descricao;
        $results["responsavel"] = $empresa->responsavel;                           // Campo por adicionar
        $results["estado"] = $empresa->estado;     
        $results["bairro"] = $empresa->bairro;
        $results['email'] = $empresa->email;
        $results["telefone"] = $empresa->telefone;
        $results["cnpj"] = $empresa->cnpj;
        $results["logradouro"] = $empresa->logradouro;
        $results["numero"] = $empresa->numero;
        $results["cep"] = $empresa->cep;
        $results["cidade"] = $empresa->cidade;
        $results["status"] = $empresa->status;
        $results["logo"] = $empresa->logo;

        $lojas = [];
        $lojaIds = [];

        foreach ($empresa->lojas as $loja) {
            $lojas[] = $loja->descricao;
            $lojaIds[] = $loja->id;
        }

        $results["lojas"] = $lojas;
        $results["compIds"] = $lojaIds;
        
        print_r(json_encode($results));
    }
    
    function getDadosLoja($empresa_id){
        return Empresa::find($empresa_id);
    }
    
    function editarLoja(Request $request){
        $empresa = Empresa::find($request->loja_id);
        
        if($request->tipo == "cliente"){
            $empresa = Empresa::find($request->empresa_id);
            $this->editarEmpresa($empresa, $request);
            return "ok";
        }
        $this->editarEmpresa($empresa, $request);
        
        return back();
    }
    
    function editarEmpresa($loja, $request){
        $loja->descricao = $request->descricao;
        $loja->cidade = $request->cidade;
        $loja->responsavel = $request->responsavel;
        $loja->estado = $request->estado;
        $loja->bairro = $request->bairro;
        $loja->logradouro = $request->logradouro;
        $loja->numero = $request->numero;
        $loja->cep = $request->cep;
        $loja->cnpj = $request->cnpj;
        $loja->email = $request->email;
        $loja->status = $request->status;
        $loja->tipo = $request->tipo;
        // $loja->empresa_id = $request->empresa_id;
        $loja->telefone = $request->telefone;

        if ($request->hasFile('logo')) {

            $request->validate([
                'image' => 'mimes:jpeg,bmp,png'             // Only allow .jpg, .bmp and .png file types.
            ]);
            // Save the file locally in the storage/public/ folder under a new folder named /Empresa
            $path_logo = $request->logo->store('logo_empresas', 'public');
            // Store the record, using the new file hashname which will be it's new filename identity.
            $loja->logo = $path_logo;
        } 
        
        return $loja->save();
    }
    
    public function deleteloja($id)
    {
       
        $this->deleteHelper($id);
        
        return redirect('/Empresas')->with('msg', 'Loja eliminado com sucesso!');

    }
    
    function deleteHelper($id){
         $loja = Empresa::findOrfail($id);
        $equipamentos = $loja->equipamentos()->get();
        
        foreach($equipamentos as $equipamento) {
            //  Deletar os componentes e seus Subcomponentes
            $componentes = $equipamento->componentes()->get();
            
            foreach ($componentes as $comp){
                $comp->subcomponentes()->delete();
                $comp->delete();
            }
            
            // Deletar as manutencoes preventivas e corretivas
            $manutencoes = $equipamento->manutencoes()->get();
            foreach ($manutencoes as $manutencao) {
                $manutencao->preventivas()->delete();
                $manutencao->preventivas()->delete();
                $manutencao->delete();
            }
            
            // Deletar os chamados
            $equipamento->chamados()->delete();
            $equipamento->delete();
            
        }
        
        $loja->usuarios()->delete();
        $loja->delete();
        
        return true;
    }
    
    public function edit(){
         return view('Empresasedit');
    }

}
