@extends('layouts.master')

@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Técnico</h1>
			</div>



			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Técnico</a></li>
					<li class="breadcrumb-item active">Técnico</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->

	@if (session('msg'))
	<h1>{{ session('msg') }}</h1>

	@endif
</section>
<section class="content">
	<div class="row">
		<div class="col-4">
			<a href="CadastrarTecni"><button type="button" class="btn btn-outline-primary">Adicionar
				Técnicos</button></a>
			</div>

		</div>


		<br><br>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Informações do Técnico</h3>

						<div class="card-tools">
							<div class="input-group input-group-sm" style="width: 150px;">
								<input type="text" name="table_search" class="form-control float-right"
								placeholder="Search">

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

									<th>Nome completo</th>
									<th>RG</th>
									<th>CPF</th>
									<th>Email</th>
									<th>Telefone</th>
									<th>Opções</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($Tecnico as $tecn)
								<?php foreach($tecn as $tecnico): ?>

									<tr>
										<td>{{ $tecnico->user->name }}</td>
										<td>{{ $tecnico->rg }}</td>
										<td>{{ $tecnico->cpf }}</td>
										<td>{{ $tecnico->user->email }}.</td>
										<td>{{ $tecnico->telefone }}.</td>
										<td>
											<!--<a href="editar?id={{$tecnico->id}}"> <button title="Editar" type="button" class="btn-min btn-outline-edit"><span-->
											<!--         class="mdi mdi-account-edit"></span></button> </a>-->
											<button class="btn-min btn-outline-delete"><span class="mdi mdi-delete"
												data-bs-toggle="modal" data-bs-target="#exampleModal"
												data-id="{{ $tecnico->id }}"
												onclick="sendId({{ $tecnico->id }})"></span>

												<?php $Tecnicos_id = $tecnico->id; ?>
											</button>
										</td>
									</tr>
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

		<!-- Modal Eliminar equipamento-->
		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Confirmação</h5>
						<form id="tecnicodeletar" style="display: inline-block;" method="POST">

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

		<!-- /.card-header -->


	</section>


	<script>

	function sendId(Tecnicos_id) {

		var tec_id = Tecnicos_id;
		let form = document.getElementById("tecnicodeletar");
		form.action = "tecnicodeletar/" + Tecnicos_id;

	}

	</script>

	@endsection
