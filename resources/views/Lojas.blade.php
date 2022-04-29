@extends('layouts.master')

@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>loja</h1>
			</div>



			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Loja</li>
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
			<a href="CadastrarLoja"><button type="button" class="btn btn-outline-primary">Adicionar
				Loja</button></a>
			</div>

		</div>
		<button type="button" class="btn btn-success toastrDefaultSuccess">
			Launch Success Toast
		</button>

		<br><br>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Informações da Loja</h3>

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
									<th>Descrição</th>
									<th>Responsável</th>
									<th>Estado</th>
									<th>Bairro</th>
									<th>Logradouro</th>
									<th>Número</th>
									<th>CEPp</th>
									<th>CNPJ</th>
									<th>Email</th>
									<th>Telefone</th>
									<th>Status</th>
									<th>Cidade</th>
									<th>Opções</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($Lojas as $loja)

								<tr>
									<td>{{ $loja->descricao }}</td>
									<td>{{ $loja->responsavel }}</td>
									<td>{{ $loja->estado }}</td>
									<td>{{ $loja->bairro }}</td>
									<td>{{ $loja->logradouro }}.</td>
									<td>{{ $loja->numero }}.</td>
									<td>{{ $loja->cep }}.</td>
									<td>{{ $loja->cnpj }}.</td>
									<td>{{ $loja->email }}.</td>
									<td>{{ $loja->telefone }}.</td>
									<td>{{ $loja->status }}.</td>
									<td>{{ $loja->cidade }}.</td>



									<td>
										<button title="Editar" type="button" class="btn-min btn-outline-edit"><span
											class="mdi mdi-account-edit"></span></button>
											<form action="/loja/{{ $loja->id }}" style="display: inline-block;"
												method="POST">

												@csrf
												@method('DELETE')
												<button title="Excluir" type="submit"
												class="btn-min btn-outline-delete"><span
												class="mdi mdi-delete"></span></button>

											</form>
										</td>
										@endforeach
									</tr>
								</tbody>

							</table>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
			</div>

			<!-- /.card-header -->

			<div class="modal fade" id="modal-xl">
				<div class="modal-dialog modal-xl">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Cadastrar Equipamento</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<p>OLA VOCE VAI CADASTAR O SEU PRIMEIRO EQUIPAMENTO </p>
						</div>
						<div class="modal-footer justify-content-between">
							<button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
							<button type="button" class="btn btn-primary">Salvar</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
		</section>

		@endsection
