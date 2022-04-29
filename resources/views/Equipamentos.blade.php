@extends('layouts.master')

@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Frota</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Frota</li>
				</ol>
			</div>

		</div>
	</div><!-- /.container-fluid -->
</section>
<section class="content">
	<div class="row">
		<div class="col-3">
			<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-xl"
			onclick="limparForm()">
			Adicionar Equipamento
		</button>
	</div>

</div>
<br><br>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Equipamentos </h3>

				<!--<div class="card-tools">-->
				<!--	<div class="input-group input-group-sm">-->
				<!--		<form method="post" name="frmEquipamento" action="{{ route('equipamento.pesquisar') }}">-->
				<!--			@csrf-->
				<!--			<div class="form-row">-->
				<!--				<div class="col-md-3"></div>-->
				<!--				<div class="col-md-10">-->
				<!--					<input type="text" name="parametro" class="form-control float-right"-->
				<!--					placeholder="Equipamento">-->
				<!--				</div>-->

				<!--				<div class="col-md-1">-->
				<!--					<button type="submit" class="btn btn-default">-->
				<!--						<i class="fas fa-search"></i>-->
				<!--					</button>-->
				<!--				</div>-->
				<!--			</form>-->
				<!--			<br><br>-->
				<!--		</div>-->
				<!--	</div>-->
				<!--</div>-->
				<!-- /.card-header -->
				<div class="card-body table-responsive p-0" style="height: 400px;">
					<table class="table table-head-fixed text-nowrap ">
						<thead>
							<tr>
								<th>Veiculo</th>
								<th>Modelo</th>
								<th>Fabricante</th>
								<th>Número Série</th>
								<th>Marca</th>
								<th>Empresa</th>
								<th>Status</th>
								<th>QrCode</th>
								<th>Imprimir</th>
								<th>Detalhes</th>
								<th>Opções</th>

							</tr>
						</thead>
						<tbody>

							@foreach ($equipamentos as $equipamento)
							<?php foreach ($equipamento as $equi): ?>
								<tr>
									<td>{{ $equi->nome }}</td>
									<td>{{ $equi->modelo }}</td>
									<td>{{ $equi->fabricante }}</td>
									<td>{{ $equi->numeroSerie }}</td>
									<td>{{ $equi->marca }}</td>
									<td>{{ $equi->empresa->descricao }}</td>
									<?php $empresa_id = $equi->empresa_id; ?>
									<td>{{ $equi->status }}</td>
									<td><img src="{{ asset($equi->qrCode) }}" style="width: 50px"></td>

									<td data-label="Imprimir" scope="row"><a href="{{ asset($equi->qrCode) }}"
										target="printf"><button type="button" onclick="printFrame()"
										class="btn-min btn-outline-secondary"><span
										class="mdi mdi-printer"></button></a>
									</td>
									<td>
										<button title="Mais Detalhes" type="button"
										class="btn-min btn-outline-info" onclick="preencherDadosEquipamento({{ $equi->id }})"><span class="fas fa-info px-2" id="editBtn"
										data-toggle="modal" data-target="#modal-xl-info"
										></span></button>
									</td>
									<td>
										<button title="Editar" type="button" class="btn-min btn-outline-edit"><span
											class="mdi mdi-account-edit" id="editBtn" data-toggle="modal"
											data-target="#modal-xl"
											onclick="editEquip({{ $equi->id }})"></span></button>

											<button class="btn-min btn-outline-delete"><span class="mdi mdi-delete"
												data-bs-toggle="modal" data-bs-target="#exampleModal"
												data-id="{{ $equi->id }}"
												onclick="sendId({{ $equi->id }})"></span>

												<?php $equipamento_id = $equi->id; ?>
											</button>

										</td>


									</tr>
									<!-- colocar a modal para componente -->

									<!-- adicionar componente -->
									<!-- inicio modal -->
									<div class="modal fade" id='{{"modals-xl".$equi->id}}'>
										<div class="modal-dialog modal-xl">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title">{{$equi->nome}}</h4>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">

													<form method="post" action="{{route('componente.store')}}">
														@csrf
														<div clasS="form-row">

															<div class="col-md-12">
																<label>Nome do Componente Reparável</label>
																<input type="text" name="componente" class="form-control">
															</div>
															<input type="hidden" name="equipamento_id" value="{{$equi->id}}">

															<div class="col-md-12">
																<br>
																<input type="submit" value="REGISTAR COMPONENTE" class="btn btn-primary col-md-12">
															</div>
														</form>

													</div>

												</div>
												<!-- /.modal-content -->


											</div>
											<!-- /.modal-dialog -->
										</div>

										<!-- fim modal componente -->
									<?php endforeach ?>
									@endforeach
								</tbody>
							</table>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
			</div>

			<!-- inicio modal Cadastrar/Editar Equipamento -->
			<div class="modal fade" id="modal-xl">
				<div class="modal-dialog modal-xl">
					<div class="modal-content" id="modal-ocultar">
						<div class="modal-header">
							<h4 class="modal-title">Cadastrar Equipamento</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">

							<form method="post" action="{{ route('equipamento.store') }}" id="editEquip">
								@csrf

								<div class="form-row">
									@php
									$empresaLojas = App\Empresa::where('tipo', '=', 'loja')->get();
									$empresas = App\Empresa::where("tipo","=","cliente")->where("empresa_id","=",Auth::user()->empresa_id)->get();


									@endphp
								
							    </br>
        						</div>
        
        						<div clasS="form-row">
        
        							<div class="col-md-4">
        								<label>Veiculo</label>
        								<input type="text" name="nome" class="form-control" id="nomeEquip">
        							</div>
        
        							<div class="col-md-4">
        								<label>Modelo</label>
        								<input type="text" name="modelo" class="form-control" id="modeloEquip">
        							</div>
        
        							<div class="col-md-4">
        								<label>Fabricante</label>
        								<input type="text" name="fabricante" class="form-control" id="fabricanteEquip">
        							</div>
        						</div>
        
        						<div clasS="form-row">
        
        							<div class="col-md-4">
        								<label>Número de Série</label>
        								<input type="text" name="numeroSerie" class="form-control" id="numeroSerieEquip">
        							</div>
        
        							<div class="col-md-4">
        								<label>Marca</label>
        								<input type="text" name="marca" class="form-control" id="marcaEquip">
        							</div>
        
        							<div class="col-md-4">
        								<label>Status</label>
        								<select name="status" class="form-control" id="statusEquip">
        									<option value="conforme">Conforme</option>
        									<option value="não conforme">Não conforme</option>
        									<option value="Equipamento Aguardando peça"> Aguardando peça</option>
        									<option value="Equipamento Aguardando orçamento"> Aguardando orçamento</option>
        								</select>
        							</div>
        						</div>
        
        
        						<div clasS="form-row">
        
        							<div class="col-md-12">
        								<label>Descrição</label>
        								<textarea class="form-control" name="descricao" id="descricaoEquip"></textarea>
        							</div>
        						</div>
        						<br><br>
        						<div class="col-md-12">
        							<input type="submit" value="REGISTAR EQUIPAMENTO" class="btn btn-primary col-md-12">
        						</div>
					</form>

				</div>

			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>

	<!-- Modal Eliminar equipamento-->
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Confirmação</h5>
					<form id="deleteequipamento" style="display: inline-block;" method="POST">

						@csrf
						@method('DELETE')
						<button type="button" class="btn-close" data-bs-dismiss="modal"
						aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<i class="nav-icon fas fa-exclamation-circle" style="color:red"></i>
						<p>Esta ação eliminará os dados do equipamento e todos os seus componentes e subcomponentes permanentemente. Deseja continuar?</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
						<button title="Excluir" type="submit" class="btn btn-danger">Sim</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- inicio modal Mais Informacoes do Equipamento -->
	<div class="modal fade" id="modal-xl-info" height: "500px">
		<div class="modal-dialog modal-xl px-5">
			<div class="modal-content" style="overflow-y: scroll;">
				<div class="modal-header">
					<h4 class="modal-title">Informções sobre o Equipamento</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<div id="equipamento-detail" class='equipamento-detail'>
						<div class="descricao">
							<table>

								<tr>
									<th>Nome do Equipamento</th>
									<td class="nome"></td>
								</tr>
								<tr>
									<th>Modelo</th>
									<td class="modelo"></td>
								</tr>
								<tr>
									<th>Marca</th>
									<td class="marca"></td>
								</tr>
								<tr>
									<th>Fabricante</th>
									<td class="fabricante"></td>
								</tr>
								<tr>
									<th>Numero de Série</th>
									<td class="numSerie"></td>
								</tr>
								<tr>
									<th>Empresa responsável</th>
									<td class="empresa"></td>
								</tr>
								<tr>
									<th>Status</th>
									<td class="status"></td>
								</tr>
								<tr>
									<th>Descrição do Equipamento</th>
									<td class="descricao-equip"></td>
								</tr>


							</table>
						</div>
						<div class="anexo">
							<h4>QRCode</h4>
							<p><img class="qrCode" src="" style="width: 200px"></p>

						</div>
					</div>
				</div>

				<div class="modal-header">
					<h4 class="modal-title">Componentes do Equipamento</h4>
				</div>
				<div class="modal-body componente-detail">
					<div class="componentes-info">

						<input type="hidden" value="" class='equip_id'>
						<button type="button" class=" btn btn-outline-primary p-1 mb-3" onclick="addComponente()">Adicionar componente
							<i style="font-size: 30px" class="fas fa-plus-square align-middle"></i></button>
							<div class="componentes">
							</div>


							<div id="confirmarDeletarSubComp" class="modal-dialog modal-dialog-centered" style="position: fixed; bottom: 20%; left: 30%; opacity:0;
							pointer-events:none; visibility: hidden; transition: 0.5s">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Confirmar deletar Subcomponente</h5>

								</div>
								<div class="modal-body">
									<i class="nav-icon fas fa-exclamation-circle" style="color:red"></i>
									<p>Esta ação eliminará os dados permanentemente. Deseja continuar?</p>

									<form id="deleteSubComp" style="display: inline-block;" method="POST">

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


		<!-- Modal Eliminar Subcomponente-->


		<iframe style="width:0px;height:0px;position: absolute;border:0;display: none;" id="printf" name="printf"
		src=""></iframe>



	</section>


	<script>


	function sendId(equipamento_id) {

		var equip_id = equipamento_id;
		let form = document.getElementById("deleteequipamento");
		form.action = "deleteequipamento/" + equipamento_id;

	}

	function editEquip(equipamento_id) {
		let formEdit = document.getElementById("editEquip");
		let nomeEquip = document.getElementById("nomeEquip");
		let modeloEquip = document.getElementById("modeloEquip");
		let fabricanteEquip = document.getElementById("fabricanteEquip");
		let numeroSerieEquip = document.getElementById("numeroSerieEquip");
		let marcaEquip = document.getElementById("marcaEquip");
		let statusEquip = document.getElementById("statusEquip");
		let descricaoEquip = document.getElementById("descricaoEquip");

		let modalContent = document.getElementById("modal-ocultar");
		modalContent.style.opacity = "0.6";
		modalContent.style.pointerEvents = "none";

		let editBtn = document.getElementById("editBtn");

		axios.get("editarequipamento/" + equipamento_id)
		.then(res => {
			// console.log(res.data)
			if (res.data) {

				nomeEquip.value = res.data["nome"];
				descricaoEquip.value = res.data["descricao"];
				modeloEquip.value = res.data["modelo"];
				fabricanteEquip.value = res.data["fabricante"];
				numeroSerieEquip.value = res.data["numeroSerie"];
				marcaEquip.value = res.data["marca"];
				statusEquip.value = res.data["status"];
				modalContent.style.opacity = "1";
				modalContent.style.pointerEvents = "auto";
			}
		})
		.catch(err => {
			console.error(err);
		})
		formEdit.action = "editarequipamento/" + equipamento_id;
	}

	function limparForm(params) {
		let formEdit = document.getElementById("editEquip");

		formEdit.action = "{{ route('equipamento.store') }}";

		nomeEquip.value = "";
		descricaoEquip.value = "";
		modeloEquip.value = "";
		fabricanteEquip.value = "";
		numeroSerieEquip.value = "";
		marcaEquip.value = "";
		statusEquip.value = "Conforme";
	}

	function preencherDadosEquipamento(id) {
		let modalContent = document.getElementById("modal-ocultar");
		document.querySelector(".equip_id").value = id;
		modalContent.style.opacity = "0.6";
		modalContent.style.pointerEvents = "none";
		axios({
			method: 'get',
			url: `preencherDadosEquipamento/${id}`,

		})
		.then(res => {
			if(res.data){
				var equipamentoArray = res.data;
				var equipamentoDetail = document.getElementById("equipamento-detail");

				// console.log(res.data);
				// anexo.src = "storage/app/public/chamados/" + equipamentoArray["anexo"];
				equipamentoDetail.querySelector(".nome").innerHTML = equipamentoArray["nome"];
				equipamentoDetail.querySelector(".modelo").innerHTML = equipamentoArray["modelo"]; // Novo
				equipamentoDetail.querySelector(".marca").innerHTML = equipamentoArray["marca"]; // Novo
				equipamentoDetail.querySelector(".fabricante").innerHTML = equipamentoArray["fabricante"]; // Sem dados
				equipamentoDetail.querySelector(".numSerie").innerHTML = equipamentoArray["numSerie"];
				equipamentoDetail.querySelector(".empresa").innerHTML = equipamentoArray["empresa"];          //
				equipamentoDetail.querySelector(".status").innerHTML = equipamentoArray["status"]; //
				equipamentoDetail.querySelector(".descricao-equip").innerHTML = equipamentoArray["descricao"];
				equipamentoDetail.querySelector(".qrCode").src = equipamentoArray["qrCode"]; //

				var componentes = "";
				equipamentoArray["componentes"].forEach((comp, i) => {
					componentes += `
					<div class="editarComponente" style="display: none"></div>
					<h4 onclick="listarSubComp(this, ${equipamentoArray['compIds'][i]})"
					style="background: #ccc; padding: 7px 15px; display:flex; justify-content: space-between; align-items:center; cursor: pointer">
					<p>${comp} <i class="fas fa-chevron-down" style="font-size: 14px;"></i></p>
					<div style='display: flex; justify-content: flex-end;'>
					<button title='Editar' type='button' class='btn-min btn-outline-edit me-3' onclick='editarComponente(this,${equipamentoArray["compIds"][i]},\"${comp.trim()}\")'>
					<span class='mdi mdi-account-edit'></span></button>
					<button class='btn-min btn-outline-delete' onclick='deletarComp(this, ${equipamentoArray["compIds"][i]})'><span class='mdi mdi-delete'></span></button>
					</div>
					</h4>
					<div class="subComponentes">

					</div>
					<hr>`;
				});

				listarComponentes(componentes);
				modalContent.style.opacity = "1";
				modalContent.style.pointerEvents = "auto";
			}
		})
		.catch(err => {
			console.error(err);
		})
	}

	function listarComponentes(componente){
		// window.event.cancelBubble = true;
		var componenteDetail = document.querySelector(".componente-detail .componentes");
		// var btn = document.querySelector(".componente-detail button");

		componenteDetail.innerHTML = componente;
	}

	function addComponente(){
		var componenteDetail = document.querySelector(".componente-detail");
		var equipamento_id = document.querySelector(".equip_id").value;
		var btn = document.querySelector(".componente-detail button");
		let divForm = document.createElement('div');

		divForm.innerHTML = `<form method="post" action="{{route('componente.store')}}">
		@csrf
		<div class="form-row">

		<div class="col-md-12 mb-3">
		<label>Nome do Componente Reparável</label>
		<input type="text" name="componente" class="form-control">
		</div>
		<input type="hidden" name="equipamento_id" value="${equipamento_id}">

		<div class="col-md-12 row mb-3">
		<button type="button" class="btn btn-outline-secondary col-md-6" onclick="removerForm(this)">Ocultar Formulario</button>
		<input type="submit" value="REGISTAR COMPONENTE" class="btn btn-primary col-md-6">
		</div>
		</div>
		</form>`;

		divForm.classList.add('box', 'new-box');
		componenteDetail.querySelector(".componentes-info").insertBefore(divForm, btn);

	}


	function listarSubComp (event, id){
		axios.get(`preencherSubComponentes/${id}`)
		.then(res => {
			event.nextElementSibling.innerHTML = res.data;
		})
		.catch(err => {
			console.error(err);
		})

		event.nextElementSibling.classList.toggle("activo");

	}

	function addSubComponente(event, equipamento_id){
	// 		var componenteDetail = document.querySelector(".componente-detail");
		var btn = event.parentNode.querySelector(".componente-detail .subComponentes button");
		var componenteDetail = event.parentNode;
		let divForm = document.createElement('div');

		divForm.innerHTML = `<form method="post" action="{{route('subcomponente.store')}}">
		@csrf
		<div class="form-row">

		<div class="col-md-12 mb-3">
		<label>Nome do Subcomponente</label>
		<input type="text" name="componente" class="form-control">
		</div>
		<input type="hidden" name="componente_id" value="${equipamento_id}">

		<div class="col-md-12 row mb-3">
		<button type="button" class="btn btn-outline-danger col-md-6" onclick="removerForm(this)">Ocultar Formulario</button>
		<input type="submit" value="REGISTAR COMPONENTE" class="btn btn-primary col-md-6">
		</div>
		</div>
		</form>`;

		divForm.classList.add('box', 'new-box');

// 		componenteDetail.querySelector(".componentes-info .componentes .subComponentes").insertBefore(divForm, btn);
		componenteDetail.insertBefore(divForm, btn);
	}

	function editarSubComponente(event, subcomponente_id, nome){
		var componenteDetail = event.parentNode.parentNode.querySelector('.editar');
		var btn = componenteDetail.querySelector('div');

		let divForm = document.createElement('div');

		divForm.innerHTML = `<form method="post" action="{{route('editarSubComp.store')}}">
		@csrf
		<div class="form-row">

		<div class="col-md-12 mb-3">
		<p style='color: #000; font-size: 14px'>Editando o Subcomponente</p>
		<input type="text" name="subcomponente" class="form-control" value="${nome}">
		</div>
		<input type="hidden" name="subcomponente_id" value="${subcomponente_id}">

		<div class="col-md-12 row mb-3">
		<button type="button" class="btn btn-outline-danger col-md-6"  onclick="removerForm(this)">Ocultar Formulario</button>
		<input type="submit" value="Salvar" class="btn btn-primary col-md-6">
		</div>
		</div>
		</form>`;

		divForm.classList.add('box', 'new-box');
		// btn.appendChild(divForm);
		componenteDetail.innerHTML = divForm.innerHTML;
	}

	function removerForm(e){
		// alert(e.);
		e.parentNode.parentNode.parentNode.remove();
	}


	function editarComponente(e, componente_id, nomeComp){

		var nome = nomeComp;
		window.event.stopPropagation(); // = true;
		e.cancelBubble = true;
		var componenteDetail = e.parentNode.parentNode.previousSibling.previousSibling;
		// var btn = componenteDetail.querySelector('div');

		let divForm = document.createElement('div');

		divForm.innerHTML = `
		<form method="post" action="{{route('editarSubComp.store')}}">
		@csrf
		<div class="form-row">

		<div class="col-md-12 mb-3">
		<p style='color: #000; font-size: 14px'>Editando o Subcomponente</p>
		<input type="text" name="subcomponente" class="form-control" value="${nome}">
		</div>
		<input type="hidden" name="subcomponente_id" value="${componente_id}">

		<div class="col-md-12 row mb-3">
		<button type="button" class="btn btn-outline-danger col-md-6"  onclick="removerForm(this)">Ocultar</button>
		<input type="submit" value="Salvar" class="btn btn-primary col-md-6">
		</div>
		</div>
		</form>`;

		divForm.classList.add('box', 'new-box');
		componenteDetail.innerHTML = divForm.innerHTML;
		componenteDetail.style.display= 'block';
	}

	function deletarComp(e, componente_id){
		window.event.cancelBubble = true

		var confirm = document.getElementById("confirmarDeletarSubComp");
		confirm.style.opacity = "1";
		confirm.style.visibility = "visible";
		confirm.style.pointerEvents = "auto";

		var maisInfo = document.getElementById("modal-xl-info");
		maisInfo.style.pointerEvents = "none";

		var h4s = document.querySelectorAll("h4");

		h4s.forEach((item) =>{item.style.pointerEvents = "none";});

		var deleteForm = document.getElementById("deleteSubComp");
		deleteForm.action = `/Elevador/deletecomponente/${componente_id}`;
	}

	function deletarSubComp(idsubcomp){
		var confirm = document.getElementById("confirmarDeletarSubComp");
		confirm.style.opacity = "1";
		confirm.style.visibility = "visible";
		confirm.style.pointerEvents = "auto";

		var maisInfo = document.getElementById("modal-xl-info");
		maisInfo.style.pointerEvents = "none";

		var h4s = document.querySelectorAll("h4");

		h4s.forEach((item) =>{item.style.pointerEvents = "none";});

		var deleteForm = document.getElementById("deleteSubComp");
		deleteForm.action = `/Elevador/deletesubcomponente/${idsubcomp}`;

	}

	function fecharModal(){
		var confirm = document.getElementById("confirmarDeletarSubComp");
		confirm.style.pointerEvents = "none";
		confirm.style.opacity = "0";
		confirm.style.visibility = "hidden";
		confirm.style.opacity = "0";

		document.getElementById("modal-xl-info").style.pointerEvents = "auto";
		var h4s = document.querySelectorAll("h4");

		h4s.forEach((item) =>{item.style.pointerEvents = "auto";});
	}

	var empresa = document.getElementById("empresa_id");
	var lojas = document.getElementById("lojas");
	empresa.addEventListener("change", buscarLojas);

	function buscarLojas() {

		axios({
			method:'get',
			url: `buscarLojas/${empresa.value}`,

		})
		.then (res => {
			// console.log(res.data);
			lojas.innerHTML = res.data;
		})
	}

	</script>

	@endsection
