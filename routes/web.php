<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\EventController; 
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\EquipamentoController;
use App\Http\Controllers\ComponenteController;
use App\Http\Controllers\SubComponenteController;
use App\Http\Controllers\ManutencaoController;
use App\Http\Controllers\TecnicoController;
use App\Http\Controllers\lojaController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\ChamadoController;
use App\Http\Controllers\RelatorioManutencaoController;
use App\Http\Controllers\UserController;




  
use App\Http\Controllers\FullCalenderController;
  
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
  
Route::get('fullcalender', [FullCalenderController::class, 'index']);
Route::post('fullcalenderAjax', [FullCalenderController::class, 'ajax']);




// Chamados
Route::get('/',[ChamadoController::class ,'paginaPrincipal']);
Route::get('/AbrirChamado',[ChamadoController::class ,'AbrirChamado']);
Route::post('/CadastrarChamado',[ChamadoController::class ,'CadastrarChamado']);
Route::get('/FinalizarChamado',[ChamadoController::class ,'FinalizarChamado']);
Route::get('/listarChamados',[ChamadoController::class ,'listarChamados']);
Route::get('/abrirEnvelope/{id}',[ChamadoController::class ,'abrirEnvelope']);
Route::get('/obterStatus',[ChamadoController::class ,'obterStatus']); 
Route::get('/resumo',[ChamadoController::class ,'resumo']); 
Route::get('/removerChamado',[ChamadoController::class ,'removerChamado']); 

//Agenda
Route::get('/calendario',[AgendaController::class ,'calendario']);


Route::get('/Graficos',[EventController::class ,'Graficos']);
Route::get('/CadastrarUsuario',[EventController::class ,'CadastrarUsuario']);
Route::get('/Usuarios',[EventController::class ,'Usuarios']);
Route::get('/projeto',[EventController::class ,'projeto']);
Route::get('/CadastrarProjeto',[EventController::class ,'cadastrarProjeto']);
Route::get('/Equipamentos',[EventController::class ,'Equipamentos']);
Route::get('/CriticoEquipamento',[EventController::class ,'CriticoEquipamento']);
Route::get('/CriticoManutencao',[EventController::class ,'CriticoManutencao']);
Route::get('/Rankings',[EventController::class ,'Rankings']);

// Tecnicos
Route::get('/Tecnico',[TecnicoController::class ,'Tecnico'])->name("tecnico.listar");
Route::get('/CadastrarTecni',[TecnicoController::class ,'CadastrarTecni']);
Route::post('/tecnico',[TecnicoController::class ,'tecEvent']);
Route::delete('/tecnicodeletar/{id}',[TecnicoController::class ,'tecnicodeletar'])->name("tecnicodeletar");;
Route::get('/editar',[TecnicoController::class ,'editar']);
Route::post('/editarEmpresa',[EmpresaController::class ,'editarLoja']);

// Empresas
Route::get('/Empresas',[EmpresaController::class ,'Empresas']);
Route::get('/Cadastrarempresas',[EmpresaController::class ,'cadastrarEmpresas']);
Route::post('/empresacad',[EmpresaController::class ,'cadastarempresaSubmit'])->name("empresacad");
Route::delete('/empredeletar/{id}',[EmpresaController::class ,'deletarEmpresa'])->name("deletar_empresa");
Route::get('/buscarLojas/{empresa_id?}',[EmpresaController::class ,'buscarLojas']);
Route::get('/preencherDadosEmpresa/{id}',[EmpresaController::class ,'preencherDadosEmpresa'])->name("preencherDadosEmpresa");
Route::get('/getDadosLoja/{id}',[EmpresaController::class ,'getDadosLoja'])->name("getDadosLoja");
Route::post('/editarLoja/',[EmpresaController::class ,'editarLoja'])->name("editarLoja");
Route::delete('/deleteloja/{id}',[EmpresaController::class ,'deleteloja'])->name("deleteloja");
Route::get('/edit',[EmpresaController::class ,'edit'])->name("editarEmpresa");
Route::post('/editarEmpresa',[EmpresaController::class ,'editarLoja']);



// Lojas
Route::get('/Lojas',[lojaController::class ,'Loja']);
Route::get('/CadastrarLoja',[lojaController::class ,'cadastrarLoja'])->name("CadastrarLoja");
Route::delete('/loja/{id}',[LojaController::class ,'deletarLoja']);
Route::get('/buscarEquipamentos/{loja_id?}',[LojaController::class ,'buscarEquipamentos']);


Route::get('/Preventivo',[EventController::class ,'Preventivo']);
Route::get('/corretivo',[EventController::class ,'corretivo']);
Route::post('/validar',[EventController::class ,'validar']);
Route::post('/signature-pad',[EventController::class ,'sign'])->name("signature-pad");


// Usuarios
Route::get('/editarSenha',[UserController::class ,'editarSenha'])->name("editarSenha");
Route::post('/editarSenhaSubmit',[UserController::class ,'editarSenhaSubmit'])->name("editarSenhaSubmit");



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



//routas ferenando
// Equipamentos
Route::post('/equipamentostore',[EquipamentoController::class ,'store'])->name("equipamento.store");
Route::get('/equipamento',[EquipamentoController::class ,'listar'])->name("equipamento.listar");
Route::get('/Elevador/{equipamento_id?}',[EquipamentoController::class ,'listar'])->name("equipamento.listar");
Route::post('/equipamento/pesquisar',[EquipamentoController::class ,'pesquisar'])->name("equipamento.pesquisar");
Route::get('/editarequipamento/{id}',[EquipamentoController::class ,'editarequipamento'])->name("editarequipamento");
Route::post('/editarequipamento/{id}',[EquipamentoController::class ,'editarequipamento'])->name("editarequipamento");
Route::delete('/deleteequipamento/{id}',[EquipamentoController::class ,'deleteequipamento'])->name("deleteequipamento");
Route::get('/preencherDadosEquipamento/{id}',[EquipamentoController::class ,'preencherDadosEquipamento'])->name("preencherDadosEquipamento");

// Componentes 
Route::get('/preencherSubComponentes/{id}',[ComponenteController::class ,'preencherSubComponentes'])->name("preencherSubComponentes");
Route::post('/componente/store',[ComponenteController::class ,'store'])->name("componente.store");
Route::delete('/deletecomponente/{id}',[ComponenteController::class ,'deletecomponente'])->name("deletecomponente");
Route::post('/editarComp/store',[ComponenteController::class ,'editarComp'])->name("editarComp.store");

// SubComponentes
Route::post('/subcomponente/store',[SubComponenteController::class ,'store'])->name("subcomponente.store");
Route::post('/editarSubComp/store',[SubComponenteController::class ,'editarSubComp'])->name("editarSubComp.store");
Route::delete('/deletesubcomponente/{id}',[SubComponenteController::class ,'deletesubcomponente'])->name("deletesubcomponente");

Route::post('/manutencao/store',[ManutencaoController::class ,'store'])->name("manutencao.preventiva");
Route::post('/manutencao/store/corretiva',[ManutencaoController::class ,'storeCorretiva'])->name("manutencao.corretiva"); // Adicionada por Diaku
Route::get('/manutencao/fecharManutencao/{manutencao_id}',[ManutencaoController::class ,'fecharManutencao'])->name("fechar-manutencao");

Route::get('/tecnico/login/{equipamento_id?}/{tipoManutencao?}',[TecnicoController::class ,'apresentar'])->name("tecnico.apresentar");

Route::post('/tecnico/login',[TecnicoController::class ,'logar'])->name("loginTecnico");


Route::get('/manutencao',[ManutencaoController::class ,'getManutencao'])->name("manutencoes.listar");
Route::delete('/manutencao/{id}',[ManutencaoController::class ,'deletarManutencao'])->name("deletar_preventiva");              // Adicionada por Diaku


Route::get('/manutencao/eliminar/{manutencao_id}',[ManutencaoController::class ,'terminarManutencao'])->name("manutencao.terminar");



//  Users
Route::post('/registarUser',[EventController::class ,'registarUser']);


Route::get('/imprimir/{manutencao_id}',[RelatorioManutencaoController::class ,'imprimir'])->name("imprimir");


//novas routas fernando

//funcoes e previlegios

Route::get('/listar', [App\Http\Controllers\FuncaoController::class, 'index'])->name('funcoes.listar');
Route::get('/listar/{funcao_id}', [App\Http\Controllers\PrevilegioController::class, 'index'])->name('previlegio.listar');
Route::get('/remover/{previlegio_id}/{funcao_id}', [App\Http\Controllers\PrevilegioController::class, 'remover'])->name('previlegio.remover');

Route::get('/usuarios', [App\Http\Controllers\UserController::class, 'listar'])->name('usuario.listar');

Route::get('/funcoes/{user_id}', [App\Http\Controllers\UserController::class, 'verFuncoes'])->name('usuario.funcoes');

Route::get('/manutencoes/{manutencoe_id}', [App\Http\Controllers\RelatorioManutencaoController::class, 'imprimir'])->name('manutencao.imprimir');
