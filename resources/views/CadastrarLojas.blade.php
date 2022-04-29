@extends('layouts.master')

@section('content')

<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Cadastrar Loja</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Cadastrar Loja</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->

	<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-sm">
		Launch Small Modal
	</button>
</section>
<section class="content">

	<div class="row justify-content-center">
		<div class="col-xl-10 col-lg-12 col-md-9">
			<div class="card o-hidden border-0 shadow-lg my-5">
				<div class="card-body p-0">
					<!-- Nested Row within Card Body -->
					<div class="row">

						<div class="col-lg-6 d-none d-lg-block bg-login-image"><img
							src="{{ asset('admin/img/Loja.png') }}" alt="" srcset="" class="img-fluid">
						</div>
						<div class="col-lg-6">
							<div class="p-5">
								<div class="text-center">
									<h1 class="h4 text-gray-900 mb-4">Registrar Loja</h1>
								</div>
								<div class="erros">
									@if ($errors->any())
									<div class="alert alert-danger p-2 mb-3">
										@foreach ($errors as $err)
										<p>{{ $err }}</p>
										@endforeach
									</div>

									@endif
								</div>
								<form id="formLoja" name="formLoja" onsubmit="return validarLoja()">
									@csrf
									<div class="form-group">
										<input placeholder="Nome" type="text"
										class="form-control @error('name') is-invalid @enderror" name="descricao"
										value="{{ old('name') }}" required autocomplete="name" autofocus>


									</div>
									<div class="form-group">
										<input placeholder="Cidade" type="text"
										class="form-control @error('name') is-invalid @enderror" name="cidade"
										value="{{ old('cidade') }}" required autocomplete="name" autofocus>


									</div>
									<div class="form-group">
										<input placeholder="Responsável" type="text"
										class="form-control @error('name') is-invalid @enderror" name="responsavel"
										value="{{ old('responsavel') }}" required autocomplete="name" autofocus>


									</div>
									<div class="form-group">
										<input placeholder="Estado" type="text"
										class="form-control @error('name') is-invalid @enderror" name="estado"
										value="{{ old('estado') }}" required autocomplete="name" autofocus>


									</div>
									<div class="form-group">
										<input placeholder="Bairro" type="text"
										class="form-control @error('name') is-invalid @enderror" name="bairro"
										value="{{ old('bairro') }}" required autocomplete="name" autofocus>

									</div>
									<div class="form-group">
										<input placeholder="Logradouro" type="text"
										class="form-control @error('name') is-invalid @enderror" name="logradouro"
										value="{{ old('logradouro') }}" required autocomplete="name" autofocus>


									</div>
									<div class="form-group">
										<input placeholder="Número" type="text"
										class="form-control @error('name') is-invalid @enderror" name="numero"
										value="{{ old('numero') }}" required autocomplete="name" autofocus>


									</div>
									<div class="form-group">
										<input id="cep" placeholder="CEP" type="text"
										class="form-control @error('name') is-invalid @enderror" name="cep"
										value="{{ old('cep') }}" required autocomplete="name" autofocus>


									</div>
									<div class="form-group">
										<input placeholder="CNPJ" type="text"
										class="form-control @error('name') is-invalid @enderror" name="cnpj"
										value="{{ old('cnpj') }}" required autocomplete="name" autofocus>


									</div>
									<div class="form-group">
										<input placeholder="Telefone" type="text"
										class="form-control @error('name') is-invalid @enderror" name="telefone"
										value="{{ old('telefone') }}" required autocomplete="name" autofocus>


									</div>
									<div class="form-group">
										<input id="email" placeholder="Email" type="email"
										class="form-control @error('email') is-invalid @enderror" name="email"
										value="{{ old('email') }}" required autocomplete="email">


									</div>

									<div class="form-group">
										<select name="status:" id="" class="form-control">
											<option value="Ativo">Ativo</option>
											<option value="Inatio">Inativo</option>
										</select>

									</div>


									<div class="row mb-0">
										<div class="col-md-6 offset-md-4">
											<button type="submit" class="btn btn-primary">Cadastrar</button>
												<button class="btn btn-warning">
											<a href="Lojas" class="button" style="text-decoration: none;  color:aliceblue;">
										Voltar</a></button>
									</div>


									<hr/>

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

<div class="popup-container">
	<div class="popup-msg">
		<div class="popup-sucesso">
			<div class="popup-checkado"><i class="fas fa-check"></i></div>
			<div class="popup-texto">Loja cadastrada com sucesso!</div>
			<div class="popup-fechar"><i class="fas fa-times"></i></div>
		</div>
	</div>
</div>




@endsection
