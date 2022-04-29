@extends('layouts.master')

@section('content')

<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Criticidade Veiculo</h1>
			</div>



			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Criticidade</a></li>
					<li class="breadcrumb-item active">Veiculo</li>
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

						<option> aguardando Peça </option>
						<option value="2"> aguardando Resgate</option>
						<option value="3"> aguardando Técnico</option>
						<option value="3"> aguardando Aprovação de orçamento</option>
					</select>
				</div>
				<div class="col-3">
					<select class="form-select" aria-label="Default select example">
						<option selected>Ambulancia</option>
						<option value="1">Caminhoneta</option>
						<option value="2">Onibus</option>

					</select>
				</div>

			</div>
		</br>
		<div class="row">
			<div class="col-2">
				<button class="btn btn-primary">Filtrar</button>
			</div>

		</div>
	</form>
	<br><br>
	<div class="card has-table col-12">
		<header class="card-header">
			<p class="card-header-title">
				<span class="icon"><i class="mdi mdi-account-multiple"></i></span>
				Informações do veiculo
			</p>
			<a href="#" class="card-header-icon">
				<span class="icon"><i class="mdi mdi-reload"></i></span>
			</a>
		</header>
		<div class="card-content">
			<table class="table">
				<thead>
					<tr>
						<th scope="col"></th>
						<th scope="col">Aguardando Resgate</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td scope="row"></td>
						<td data-label="Aguardando Resgate" scope="row">Ambulancia</td>
					</tr>
					<tr>
						<td scope="row"></td>
						<td data-label="Aguardando Resgate" scope="row">Onibus</td>
					</tr>
					<tr>
						<td scope="row"></td>
						<td data-label="Aguardando Resgate" scope="row">Caminhoneta</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>


</section>

@endsection
