@extends('layouts.master')

@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Empresas Cadastradas</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Empresas</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>
<section class="content">
	<div class="row">
		<div class="col-2">
			<a href="Cadastrarempresas?tipo=<?php echo base64_encode("cliente"); ?>"><button type="button" class="btn btn-outline-primary">Adicionar
				Empresa</button></a>
			</div> <br><br>

		</div>

		@if (session('msg'))
		<h1>{{ session('msg') }}</h1>

		@endif
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Empresa</h3>

						<div class="card-tools">
							<div class="input-group input-group-sm" style="width: 150px;">
								<input type="text" name="table_search" class="form-control float-right"
								placeholder="Procurar">

								<div class="input-group-append">
									<button type="submit" class="btn btn-default">
										<i class="fas fa-search"></i>
									</button>
								</div>
							</div>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body table-responsive p-0" style="height: 300px;">
						<table class="table table-head-fixed text-nowrap">
							<thead>
								<tr>
									<th>Razão Social</th>
									<th>Nome do Responsável</th>
									<th>Estado</th>
									<th>Bairro</th>
									<th>Numero</th>
									{{-- <th>numero</th> --}}
									{{-- <th>CEP</th> --}}
									{{-- <th>CNPJ</th> --}}
									<th>Email</th>
									<th>Telefone</th>
									<th>Status</th>
									<th>Cidade</th>
									<th>Opções</th>

								</tr>
							</thead>
							<tbody>

								@foreach ($Empresa as $empre)
								@php
								$empresa_id = base64_encode($empre->id);
								@endphp
								<tr>
									<td>{{ $empre->descricao }}</td>
									<td>{{ $empre->responsavel }}</td>
									<td>{{ $empre->estado }}</td>
									<td>{{ $empre->bairro }}</td>
									<td>{{ $empre->logradouro }}.</td>
									{{-- <td>{{ $empre->numero }}.</td> --}}
									{{-- <td>{{ $empre->cep }}.</td> --}}
									{{-- <td>{{ $empre->cnpj }}.</td> --}}
									<td>{{ $empre->email }}.</td>
									<td>{{ $empre->telefone }}.</td>
									<td>{{ $empre->status }}.</td>
									<td>{{ $empre->cidade }}.</td>


									<td>
										<button title="Ver detalhes" class="btn-min btn-outline-info px-3" type="button" onclick="preencherDadosEmpresa({{ $empre->id }})"><span class="fas fa-info px-2" id="editBtn"
											data-toggle="modal" data-target="#modal-xl-info"></span>
										</button> -
										<a href="edit?id={{$empresa_id}}"> <button title="Editar" type="button" class="btn-min btn-outline-edit"><span
											class="mdi mdi-account-edit"></span></button> </a> -

											<!--<form action="{{ Route('deletar_empresa',$empre->id) }}" style="display: inline-block;"-->
											<!--    method="POST">-->

											<!--    @csrf-->
											<!--    @method('DELETE')-->
											<!--    <button title="Excluir" type="submit"-->
											<!--        class="btn-min btn-outline-delete"><span-->
											<!--            class="mdi mdi-delete"></span></button>-->

											<!--</form>-->

											<button class="btn-min btn-outline-delete"><span class="mdi mdi-delete"
												data-bs-toggle="modal" data-bs-target="#exampleModal"
												data-id="{{ $empre->id }}"
												onclick="sendId({{ $empre->id }})"></span>

												<?php $Empre_id = $empre->id; ?>
											</button>

										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
			</div>


			<!-- Modal de detalhes da empresa -->

			<div class="modal fade" id="modal-xl-info" height: "500px">
				<div class="modal-dialog modal-xl px-5">
					<div class="modal-content" style="overflow-y: auto; !important">
						<div class="modal-header">
							<h4 class="modal-title">Informções sobre a Empresa</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="popup-container">
								<div class="popup-msg">
									<div class="popup-sucesso">
										<div class="popup-checkado"><i class="fas fa-check"></i></div>
										<div class="popup-texto">Empresa cadastrada com sucesso!</div>
										<div class="popup-fechar"><i class="fas fa-times"></i></div>
									</div>
								</div>
							</div>
							<div id="equipamento-detail" class='equipamento-detail'>
								<div class="descricao">
									<table>

										<tr>
											<th>Nome da Empresa</th>
											<td class="nome"></td>
										</tr>
										<tr>
											<th>Razão Social</th>
											<td class="razaosocial"></td>
										</tr>
										<tr>
											<th>Nome do Responsável</th>
											<td class="responsavel"></td>
										</tr>

										<tr>
											<th>Estado</th>
											<td class="estado"></td>
										</tr>
										<tr>
											<th>Bairro</th>
											<td class="bairro"></td>
										</tr>
										<!--<tr>-->
										<!--    <th>Endereço</th>-->
										<!--    <td class="empresa"></td>-->
										<!--</tr>-->
										<tr>
											<th>Email</th>
											<td class="email"></td>
										</tr>
										<tr>
											<th>Telefone</th>
											<td class="telefone"></td>
										</tr>
										<tr>
											<th>Cidade</th>
											<td class="cidade"></td>
										</tr>
										<tr>
											<th>Status</th>
											<td class="status"></td>
										</tr>
										<tr>
											<th>Logradouro</th>
											<td class="logradouro"></td>
										</tr>
										<tr>
											<th>CNPJ</th>
											<td class="cnpj"></td>
										</tr>
										<tr>
											<th>CEP</th>
											<td class="cep"></td>
										</tr>
										<tr>
											<th>Número</th>
											<td class="numero"></td>
										</tr>


									</table>
								</div>
								<div class="anexo">
									<h4>Logo da Empresa</h4>
									<p><img class="logo" src="" style="width: 200px"></p>

								</div>
							</div>
						</div>

						<div class="modal-header">
							<h4 class="modal-title">Lojas da Empresa</h4>
						</div>
						<div class="modal-body componente-detail">
							<div class="componentes-info">

								<input type="hidden" value="" class='empresa_id'>
								<button type="button" class=" btn btn-outline-primary p-1 mb-3" onclick="addLoja()">Cadastrar Uma Loja
									<i style="font-size: 30px" class="fas fa-plus-square align-middle"></i></button>
									<div class="componentes">
									</div>


									<div id="confirmarDeletarLoja" class="modal-dialog modal-dialog-centered" style="position: fixed; bottom: 20%; left: 30%; opacity:0;
									pointer-events:none; visibility: hidden; transition: 0.5s">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Confirmar Exclusão da Loja</h5>

										</div>
										<div class="modal-body">
											<i class="nav-icon fas fa-exclamation-circle" style="color:red"></i>
											<p>Esta ação eliminará os dados permanentemente. Deseja continuar?</p>

											<form id="deleteloja" style="display: inline-block;" method="POST">

												@csrf
												@method('DELETE')


												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="fecharModal()">Não</button>
													<button title="Excluir" type="submit" class="btn btn-danger">Sim</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>

						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
			</div>


			<!-- Modal Eliminar equipamento-->
			<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Confirmação</h5>
							<form id="empredeletar" style="display: inline-block;" method="POST">

								@csrf
								@method('DELETE')
								<button type="button" class="btn-close" data-bs-dismiss="modal"
								aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<i class="nav-icon fas fa-exclamation-circle" style="color:red"></i>
								<p>Esta ação eliminará os dados permanentemente. Deseja continuar?</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
								<button title="Excluir" type="submit" class="btn btn-danger">Sim</button>
							</div>
						</form>
					</div>
				</div>
			</div>

		</section>



		<script>


		function sendId(Empre_id) {

			var emp_id = Empre_id;
			let form = document.getElementById("empredeletar");
			form.action = "empredeletar/" + Empre_id;

		}

		function preencherDadosEmpresa(id){
			document.querySelector(".empresa_id").value = id;
			axios({
				method: 'get',
				url: `preencherDadosEmpresa/${id}`,

			})
			.then(res => {

				if(res.data){
					var equipamentoArray = res.data;
					var equipamentoDetail = document.getElementById("equipamento-detail");

					console.log(res.data);
					// anexo.src = "storage/app/public/chamados/" + equipamentoArray["anexo"];
					equipamentoDetail.querySelector(".nome").innerHTML = equipamentoArray["nome"];
					equipamentoDetail.querySelector(".estado").innerHTML = equipamentoArray["estado"]; // Novo
					equipamentoDetail.querySelector(".responsavel").innerHTML = equipamentoArray["responsavel"]; // Novo
					equipamentoDetail.querySelector(".cidade").innerHTML = equipamentoArray["cidade"]; // Sem dados
					equipamentoDetail.querySelector(".bairro").innerHTML = equipamentoArray["bairro"];
					equipamentoDetail.querySelector(".telefone").innerHTML = equipamentoArray["telefone"];
					equipamentoDetail.querySelector(".email").innerHTML = equipamentoArray["email"];          //
					equipamentoDetail.querySelector(".status").innerHTML = equipamentoArray["status"];          //
					equipamentoDetail.querySelector(".logradouro").innerHTML = equipamentoArray["logradouro"]; //
					equipamentoDetail.querySelector(".cnpj").innerHTML = equipamentoArray["cnpj"]; //
					equipamentoDetail.querySelector(".cep").innerHTML = equipamentoArray["cep"]; //
					equipamentoDetail.querySelector(".numero").innerHTML = equipamentoArray["numero"]; //
					equipamentoDetail.querySelector(".logo").src = "/Elevador/storage/app/public/" + equipamentoArray["logo"]; //


					var lojas = "";
					equipamentoArray["lojas"].forEach((comp, i) => {
						lojas += `
						<h4 onclick="listarSubComp(this, ${equipamentoArray['compIds'][i]})"
						style="background: #ccc; padding: 7px 15px; display:flex; justify-content: space-between; align-items:center;">
						<p>${comp} </i></p>
						<div style='display: flex; justify-content: flex-end;'>
						<button title='Editar' type='button' class='btn-min btn-outline-edit me-3' onclick='editarLoja(this, ${equipamentoArray["compIds"][i]} ,\"${comp}\", ${id})'>
						<span class='mdi mdi-account-edit'></span></button>
						<button class='btn-min btn-outline-delete' onclick='deletarLoja(this, ${equipamentoArray["compIds"][i]})'><span class='mdi mdi-delete'></span></button>
						</div>
						</h4>

						<div class="editar"></div>
						<hr>`;
					});

					listarLojas(lojas);
				}
			})
			.catch(err => {
				console.error(err);
			})
		}

		function listarLojas(lojas){
			var componenteDetail = document.querySelector(".componente-detail .componentes");
			var btn = document.querySelector(".componente-detail button");

			componenteDetail.innerHTML = lojas;
		}



		function addLoja(equipamento_id){

			var componenteDetail = document.querySelector(".componente-detail");
			var empresa_id = document.querySelector(".empresa_id").value;
			var btn = document.querySelector(".componente-detail button");
			let divForm = document.createElement('div');

			divForm.innerHTML = `<form class="box new-box" id="formEmpresaLoja" onsubmit="return validarEmpresaLoja()">
			@csrf
			<h5>Dados da Loja</h1>
			<input type="hidden" name="tipo" value="loja">
			<input type="hidden" name="redirect" value="redirect">
			<input type="hidden" value="${empresa_id}" class='empresa_id' name="empresa_id">
			<div class="form-row">

			<div class="col-md-12 mb-3">
			<label>Nome da Loja</label>
			<input  placeholder="Razão Social/ Nome Fantasia" type="text"
			class="form-control @error('name') is-invalid @enderror" name="descricao"
			value="{{ old('name') }}" required autocomplete="name" autofocus>
			</div>
			<div class="col-md-12 mb-3">
			<label>Cidade</label>
			<input  placeholder="Cidade" type="text"
			class="form-control @error('name') is-invalid @enderror" name="cidade"
			value="{{ old('name') }}" required autocomplete="name" autofocus>
			</div>
			<div class="col-md-12 mb-3">
			<label>Responsável</label>
			<input  placeholder="Nome do Responsável" type="text"
			class="form-control @error('name') is-invalid @enderror" name="responsavel"
			value="{{ old('name') }}" required autocomplete="name" autofocus>
			</div>
			<div class="col-md-12 mb-3">
			<label>Estado</label>
			<input  placeholder="Estado" type="text"
			class="form-control @error('name') is-invalid @enderror" name="estado"
			value="{{ old('name') }}" required autocomplete="name" autofocus>
			</div>
			<div class="col-md-12 mb-3">
			<label>Bairro</label>
			<input  placeholder="Bairro" type="text"
			class="form-control @error('name') is-invalid @enderror" name="bairro"
			value="{{ old('name') }}" required autocomplete="name" autofocus>
			</div>

			<div class="col-md-12 mb-3">
			<label>Endereço</label>
			<input  placeholder="Endereço" type="text"
			class="form-control @error('name') is-invalid @enderror" name="logradouro"
			value="{{ old('logradouro') }}" required autocomplete="name" autofocus>
			</div>

			<div class="col-md-12 mb-3">
			<label>Número</label>
			<input  placeholder="Número" type="number"
			class="form-control @error('name') is-invalid @enderror" name="numero"
			value="{{ old('numero') }}" required autocomplete="name" autofocus>
			</div>

			<div class="col-md-12 mb-3">
			<label>CEP</label>
			<input id="cep" placeholder="CEP" type="text"
			class="form-control @error('name') is-invalid @enderror" name="cep"
			value="{{ old('cep') }}" required autocomplete="name" autofocus>
			</div>

			<div class="col-md-12 mb-3">
			<label>CPNJ</label>
			<input  placeholder="CNPJ" type="text"
			class="form-control @error('name') is-invalid @enderror" name="cnpj"
			value="{{ old('cnpj') }}" required autocomplete="name" autofocus>
			</div>

			<div class="col-md-12 mb-3">
			<label>Telefone</label>
			<input  placeholder="Telefone" type="text"
			class="form-control @error('name') is-invalid @enderror" name="telefone"
			value="{{ old('telefone') }}" required autocomplete="name" autofocus>
			</div>

			<div class="col-md-12 mb-3">
			<label>Email</label>
			<input id="email" placeholder="Email" type="email"
			class="form-control @error('email') is-invalid @enderror" name="email"
			value="{{ old('email') }}" required autocomplete="email">
			</div>

			<div class="col-md-12 mb-3">
			<label>Status:</label>
			<select name="status" id="" class="form-control">
			<option value="Ativo">Ativo</option>
			<option value="Inatio">Inativo</option>
			</select>
			</div>

			<div class="col-md-12 mb-3">
			<label>Logotipo da Empresa</label>
			<input  placeholder="Logotipo da empresa" type="file"
			class="form-control @error('name') is-invalid @enderror" name="logo"
			value="{{ old('logo') }}" autofocus>
			</div>

			<div class="col-md-12 row mb-3">
			<button type="button" class="btn btn-outline-danger col-md-6" onclick="removerForm(this)">Ocultar Formulário</button>
			<input type="submit" value="REGISTAR LOJA" class="btn btn-primary col-md-6">
			</div>
			</div>
			</form>`;

			divForm.classList.add('box', 'new-box');
			componenteDetail.querySelector(".componentes-info").insertBefore(divForm, btn);
		}

		function removerForm(e){
			// alert(e.);
			e.parentNode.parentNode.parentNode.remove();
		}


		function listarSubComp(){
			console.log("listarSubComp Loja...");
		}


		function editarLoja(event, loja_id, nome, empresa_id){
			console.log("editarComponente Loja...");

			var componenteDetail = event.parentNode.parentNode.nextSibling.nextSibling;
			var btn = componenteDetail.querySelector('div');
			let divForm = document.createElement('div');
			axios({
				method: 'get',
				url: `getDadosLoja/${loja_id}`,

			})
			.then(res => {
				empresa = res.data;


				divForm.innerHTML = `<form method="POST" action="editarLoja" class="box new-box" id="formEmpresaLojaEditar">
				@csrf
				<h5>Editando Dados da Loja</h1>
				<input type="hidden" name="tipo" value="loja">
				<input type="hidden" name="redirect" value="redirect">
				<input type="hidden" value="${empresa_id}" class='empresa_id' name="empresa_id">
				<input type="hidden" value="${loja_id}" class='empresa_id' name="loja_id">
				<div class="form-row">

				<div class="col-md-12 mb-3">
				<label>Nome da Loja</label>
				<input  placeholder="Razão Social/ Nome Fantasia" type="text"
				class="form-control @error('name') is-invalid @enderror" name="descricao"
				value="${empresa['descricao']}" required autocomplete="name" autofocus>
				</div>
				<div class="col-md-12 mb-3">
				<label>Cidade</label>
				<input  placeholder="Cidade" type="text"
				class="form-control @error('name') is-invalid @enderror" name="cidade"
				value="${empresa['cidade']}" required autocomplete="name" autofocus>
				</div>
				<div class="col-md-12 mb-3">
				<label>Responsável</label>
				<input  placeholder="Nome do Responsável" type="text"
				class="form-control @error('name') is-invalid @enderror" name="responsavel"
				value="${empresa['responsavel']}" required autocomplete="name" autofocus>
				</div>
				<div class="col-md-12 mb-3">
				<label>Estado</label>
				<input  placeholder="Estado" type="text"
				class="form-control @error('name') is-invalid @enderror" name="estado"
				value="${empresa['estado']}" required autocomplete="name" autofocus>
				</div>
				<div class="col-md-12 mb-3">
				<label>Bairro</label>
				<input  placeholder="Bairro" type="text"
				class="form-control @error('name') is-invalid @enderror" name="bairro"
				value="${empresa['bairro']}" required autocomplete="name" autofocus>
				</div>

				<div class="col-md-12 mb-3">
				<label>Endereço</label>
				<input  placeholder="Endereço" type="text"
				class="form-control @error('name') is-invalid @enderror" name="logradouro"
				value="${empresa['logradouro']}" required autocomplete="name" autofocus>
				</div>

				<div class="col-md-12 mb-3">
				<label>Número</label>
				<input  placeholder="Número" type="number"
				class="form-control @error('name') is-invalid @enderror" name="numero"
				value="${empresa['numero']}" required autocomplete="name" autofocus>
				</div>

				<div class="col-md-12 mb-3">
				<label>CEP</label>
				<input id="cep" placeholder="CEP" type="text"
				class="form-control @error('name') is-invalid @enderror" name="cep"
				value="${empresa['cep']}" required autocomplete="name" autofocus>
				</div>

				<div class="col-md-12 mb-3">
				<label>Cpnj</label>
				<input  placeholder="Cpnj" type="text"
				class="form-control @error('name') is-invalid @enderror" name="cnpj"
				value="${empresa['cnpj']}" required autocomplete="name" autofocus>
				</div>

				<div class="col-md-12 mb-3">
				<label>Telefone</label>
				<input  placeholder="Telefone" type="text"
				class="form-control @error('name') is-invalid @enderror" name="telefone"
				value="${empresa['telefone']}" required autocomplete="name" autofocus>
				</div>

				<div class="col-md-12 mb-3">
				<label>Email</label>
				<input id="email" placeholder="Email" type="email"
				class="form-control @error('email') is-invalid @enderror" name="email"
				value="${empresa['email']}" required autocomplete="email">
				</div>

				<div class="col-md-12 mb-3">
				<label>Status</label>
				<select name="status" id="" class="form-control">
				<option value="Ativo">Ativo</option>
				<option value="Inatio">Inativo</option>
				</select>
				</div>

				<div class="col-md-12 mb-3">
				<label>Logotipo da empresa</label>
				<input  placeholder="Logotipo da empresa" type="file"
				class="form-control @error('name') is-invalid @enderror" name="logo"
				value="${empresa['logo']}" autofocus>
				</div>

				<div class="col-md-12 row mb-3">
				<button type="button" class="btn btn-outline-danger col-md-6" onclick="removerForm(this)">Ocultar Formulário</button>
				<input type="submit" value="Salvar" class="btn btn-primary col-md-6">
				</div>
				</div>
				</form>`;

				divForm.classList.add('box', 'new-box');
				// btn.appendChild(divForm);
				componenteDetail.innerHTML = divForm.innerHTML;


			})
			.catch(err => {
				console.log(err.data);
			})



		}

		function deletarLoja(e, loja_id){
			window.event.cancelBubble = true

			var confirm = document.getElementById("confirmarDeletarLoja");
			confirm.style.opacity = "1";
			confirm.style.visibility = "visible";
			confirm.style.pointerEvents = "auto";

			var maisInfo = document.getElementById("modal-xl-info");
			maisInfo.style.pointerEvents = "none";

			var h4s = document.querySelectorAll("h4");

			h4s.forEach((item) =>{item.style.pointerEvents = "none";});

			var deleteForm = document.getElementById("deleteloja");
			deleteForm.action = `/Elevador/deleteloja/${loja_id}`;
			console.log("deletarComp Loja...");
		}

		function fecharModal(){
			var confirm = document.getElementById("confirmarDeletarLoja");
			confirm.style.pointerEvents = "none";
			confirm.style.opacity = "0";
			confirm.style.visibility = "hidden";
			confirm.style.opacity = "0";

			document.getElementById("modal-xl-info").style.pointerEvents = "auto";
			var h4s = document.querySelectorAll("h4");

			h4s.forEach((item) =>{item.style.pointerEvents = "auto";});
		}

		function validarEmpresaLoja() {
			let formLojaEmpresa = document.getElementById("formEmpresaLoja");

			// console.log(formLojaEmpresa);
			// return false;
			// event.preventDefault();
			let popup = document.querySelector(".popup-container");
			var formData = new FormData(formLojaEmpresa);

			axios({
				method:'post',
				url: "empresacad",
				headers: { "Content-Type": "multipart/form-data" },
				data: formData

			})
			.then(res => {
				console.log(res.data);
				if(res.data == "ok"){
					popup.classList.add("mostrar");
					setTimeout(()=>{
						location.href = "Empresas";
						popup.classList.remove("mostrar");
					}, 3500);
				} else if(res.data == "nok"){
					alert("O email introduzido já existe.");
				} else if(res.data == "logout"){
					location.href = "/login";
				}
			})
			.catch(err => {
				console.error(err);
			});

			return false;

		}

		</script>



		@endsection
