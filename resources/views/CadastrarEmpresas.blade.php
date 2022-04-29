@extends('layouts.master')

@section('content')

@php
$tipo = base64_decode(filter_input(INPUT_GET, "tipo"));

@endphp
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Cadastrar Empresa</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Cadastrar Empresa</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->


</section>
<section class="content">

	<div class="row justify-content-center">
		<div class="col-xl-10 col-lg-12 col-md-9">
			<div class="card o-hidden border-0 shadow-lg my-5">
				<div class="card-body p-0">
					<!-- Nested Row within Card Body -->
					<div class="row">

						<div class="col-lg-6 d-none d-lg-block bg-login-image"><img
							src="{{ asset('admin/img/empresa.png') }}" alt="" srcset="" class="img-fluid">
						</div>
						<div class="col-lg-6">
							<div class="p-5">
								<div class="text-center">
									<h1 class="h4 text-gray-900 mb-4">Registrar Empresa</h1>
								</div>
								<form id="formEmpresa" name="formEmpresa" novalidate onsubmit="return validarEmpresa()">
									@csrf
									<div class="form-group">
										<input  placeholder="Razão Social/ Nome Fantasia" type="text"
										class="form-control @error('name') is-invalid @enderror" name="descricao"
										value="{{ old('name') }}" required autocomplete="name" autofocus>
									</div>
									<div class="form-group">
										<input  placeholder="Cidade" type="text"
										class="form-control @error('name') is-invalid @enderror" name="cidade"
										value="{{ old('name') }}" required autocomplete="name" autofocus>
									</div>
									<div class="form-group">
										<input  placeholder="Nome do Responsável" type="text"
										class="form-control @error('name') is-invalid @enderror" name="responsavel"
										value="{{ old('name') }}" required autocomplete="name" autofocus>

									</div>
									<div class="form-group">
										<input  placeholder="Estado" type="text"
										class="form-control @error('name') is-invalid @enderror" name="estado"
										value="{{ old('name') }}" required autocomplete="name" autofocus>


									</div>
									<div class="form-group">
										<input  placeholder="Bairro" type="text"
										class="form-control @error('name') is-invalid @enderror" name="bairro"
										value="{{ old('name') }}" required autocomplete="name" autofocus>

									</div>
									<div class="form-group">
										<input  placeholder="Endereço" type="text"
										class="form-control @error('name') is-invalid @enderror" name="logradouro"
										value="{{ old('logradouro') }}" required autocomplete="name" autofocus>


									</div>
									<div class="form-group">
										<input  placeholder="Número" type="text"
										class="form-control @error('name') is-invalid @enderror" name="numero"
										value="{{ old('numero') }}" required autocomplete="name" autofocus>


									</div>
									<div class="form-group">
										<input id="cep" placeholder="CEP" type="text"
										class="form-control @error('name') is-invalid @enderror" name="cep"
										value="{{ old('cep') }}" required autocomplete="name" autofocus>


									</div>
									<div class="form-group">
										<input  placeholder="CNPJ" type="text"
										class="form-control @error('name') is-invalid @enderror" name="cnpj"
										value="{{ old('cnpj') }}" required autocomplete="name" autofocus>
									</div>
									<div class="form-group">
										<input  placeholder="Telefone" type="text"
										class="form-control @error('name') is-invalid @enderror" maxlength="11" name="telefone"
										value="{{ old('telefone') }}" required autocomplete="name" autofocus>
									</div>
									<div class="form-group">
										<input id="email" placeholder="Email" type="email"
										class="form-control @error('email') is-invalid @enderror" name="email"
										value="{{ old('email') }}" required autocomplete="email">
									</div>

									{{-- <input type="hidden" name="empresa_id" > Precisa de atencao --}}
									<input type="hidden" name="tipo" value=<?php echo $tipo ?>>

									<div class="form-group">
										<input  placeholder="Logotipo da empresa" type="file"
										class="form-control @error('name') is-invalid @enderror" name="logo"
										value="{{ old('logo') }}" required autofocus>
									</div>
									<div class="form-group">
										<select name="status" id="" class="form-control">
											<option value="Ativo">Ativo</option>
											<option value="Inatio">Inativo</option>
										</select>

									</div>


									<div class="row mb-0">
										<div class="col-md-6 offset-md-4">
											<button type="submit" class="btn btn-primary" id="empresaSubmit">
												Cadastrar
											</button>

											<button class="btn btn-warning">

												<a href="Empresas" class="button"
												style="text-decoration: none;  color:aliceblue;">
												Voltar
											</a>
										</button>
									</div>

								</div>
								<hr />


							</form>
							<hr />

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>

<div class="modal fade" id="modal-sm">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Small Modal</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>One fine body&hellip;</p>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
				<button type="button" class="btn btn-primary">Salvar Alterações</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<div class="popup-container">
	<div class="popup-msg">
		<div class="popup-sucesso">
			<div class="popup-checkado"><i class="fas fa-check"></i></div>
			<div class="popup-texto">Empresa cadastrada com sucesso</div>
			<div class="popup-fechar"><i class="fas fa-times"></i></div>
		</div>
	</div>
</div>

@endsection
