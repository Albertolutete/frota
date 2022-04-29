@extends('layouts.master')

@section('content')

<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Rankings</h1>
			</div>



			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Rankings</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
	<section class="content">

		<br>
		<form action="" method="">
			<div class="row">

				<div class="col-3">
					<select class="form-select" aria-label="Default select example" aria-placeholder="">
						<option value="2">Atrasos nas manutenções Preventivas</option>
						<option value="2">Médias dos atendimentos Corretivos</option>
						<option value="2">Total de acidentes</option>
						<option value="2">Médias das despezas geradas</option>
						<option value="2">Média de orçamentos</option>
						<option value="2">Média de peças soliçitadas</option>
						<option value="2">Total de resgates</option>
						<option value="2">Total de Manutenções Realizadas</option>
						<option value="2">Tempo médio de Atendimento</option>

					</select>
				</div>
				<div class="col-3">
					<select class="form-select" aria-label="Default select example">
						<option selected>Ambulância</option>
						<option selected>Ônibus</option>
						<option selected>Caminhonete</option>
					

					</select>
				</div>

			</div>
		</br>
		<div class="row">
			<div class="col-3">
				<button type="" class="btn btn-primary">Filtrar</button>
			</div>

		</div>
	</form>
	<br><br>
	<div class="card has-table col-12">
		<header class="card-header">
			<p class="card-header-title">
				<span class="icon"><i class="mdi mdi-account-multiple"></i></span>
				Atrasos nas manutenções preventivas
			</p>
			<a href="#" class="card-header-icon">
				<span class="icon"><i class="mdi mdi-reload"></i></span>
			</a>
		</header>
		<div class="card-content">
			<table class="table">
				<thead>
					<tr>
						<th scope="col">Veiculos</th>
						<th scope="col">Quantidade</th>
					</tr>

				</thead>
				<tbody>

					<tr>
						<td data-label="Loja" scope="row">Ambulância</td>

						<td data-label="Quantidade" scope="row">24</td>
					</tr>
					<tr>
						<td data-label="Loja" scope="row">Ônibus</td>

						<td data-label="Quantidade" scope="row">24</td>
					</tr>
					<tr>
						<td data-label="Loja" scope="row">Caminhoneta</td>

						<td data-label="Quantidade" scope="row">24</td>
					</tr>

				</tbody>
			</table>
		</div>
	</div>



</section>

@endsection
