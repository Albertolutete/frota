@extends('layouts.master')
@section('title','Manutenção Corretiva')

@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Manutenção Corretiva</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Manutenção Corretiva</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>
<section class="content">

	<br><br>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Manutenção Corretiva</h3>

					<div class="card-tools">
						<div class="input-group input-group-sm">
							<form method="post" name="frmEquipamento" action="{{ route('equipamento.pesquisar') }}">
								@csrf
								<div class="form-row">
									<div class="col-md-3"></div>
									<div class="col-md-10">
										<input type="text" name="parametro" class="form-control float-right"
										placeholder="Equipamento">
									</div>

									<div class="col-md-1">
										<button type="submit" class="btn btn-default">
											<i class="fas fa-search"></i>
										</button>
									</div>
								</form>
								<br><br>
							</div>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body table-responsive p-0" style="height: 400px;">
						<table class="table table-head-fixed text-nowrap table-striped">
							<thead>
								<tr>
									{{-- <th>Tipo</th> --}}
									<th>Equipamento</th>
									<th>Técnico</th>
									<th>Status</th>
									<th>Assinatura</th>
									<th>Data</th>
									<th>Opções</th>
								</tr>
							</thead>
							<tbody>


								@foreach ($manutencoes as $manutec)
								<?php foreach ($manutec as $man): ?>

									<tr>
										{{-- <td>@if ($man['tipo'] == 'p') Preventivo @else Corretivo @endif</td> --}}

										<td><?php $equipamento = App\Equipamento::find($man->equipamento_id);
										echo $equipamento->nome; ?></td>
										<td>{{ $man->tecnico->name }}</td>
										<td>@if ($man['status'] == 'a') Aberto @else Fechado @endif</td>
										<td><img src="{{ asset('sign/' . $man->assinaturaTecnico) }}" alt="Assinatura"
											width="150px" height='50px' >
										</td>
										<td>{{ $man->created_at }}</td>

										<td><a href="{{ Route('imprimir', base64_encode($man->id)) }}" target="_blank">Imprimir</a></td>
									</tr>


									<!-- colocar a modal para componente -->

									<!-- adicionar componente -->
									<!-- inicio modal -->
									<div class="modal fade" id='{{ 'modals-xl' . $man->id }}'>
										<div class="modal-dialog modal-xl">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title">Cadastrar Componente</h4>
													<button type="button" class="close" data-dismiss="modal"
													aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">

												<form method="post" action="{{ route('componente.store') }}">
													@csrf
													<div clasS="form-row">

														<div class="col-md-12">
															<label>Nome do Componente Reparável</label>
															<input type="text" name="componente" class="form-control">
														</div>
														<input type="hidden" name="equipamento_id"
														value="{{ $man->id }}">

														<div class="col-md-12">
															<br>
															<input type="submit" value="REGISTAR COMPONENTE"
															class="btn btn-primary col-md-12">
														</div>
													</form>

												</div>

											</div>
											<!-- /.modal-content -->


										</div>
										<!-- /.modal-dialog -->
									</div>

								<?php endforeach ?>
								<!-- fim modal componente -->
								@endforeach
							</tbody>
						</table>
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>
		</div>

	</section>

	@endsection
