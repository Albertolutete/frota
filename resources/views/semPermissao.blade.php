@extends('layouts.master')

@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Área Restrita</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ Route('home') }}">Home</a></li>
					<li class="breadcrumb-item active">Área Restrita</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>
<section class="content">
	<div class="row">
		<div class="col-3">
			<button type="button" class="btn btn-outline-primary" data-toggle="modal" >
				Voltar
			</button>
		</div>


	</div>
	<br><br>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Área restrita</h3>
				</div>
				<!-- /.card-header -->
				<div class="card-body table-responsive p-0" style="height: 300px;">
					<p style="color: rgb(255, 51, 0); text-align: center; font-size: 54px"><i class="fas fa-warning"></i></p>
					<h1 align=center style="color: rgb(255, 51, 0)">Sem permissão para acessar as informações desta página</h1>
					<p align=center style="color: rgb(199, 44, 5); font-size: 24px">Por favor, solicite ao Administrador</p>
				</div>
				<!-- /.card-body -->
			</div>
			<!-- /.card -->
		</div>
	</div>

</section>

@endsection
