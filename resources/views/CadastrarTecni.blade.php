@extends('layouts.master')

@section('content')

<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Cadastrar Técnico</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Cadastrar Técnico</li>
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

						<div class="col-lg-6 d-none d-lg-block bg-login-image"><img src="{{asset('admin/img/tecn.png')}}" alt="" srcset="" class="img-fluid"></div>
						<div class="col-lg-6">
							<div class="p-5">
								<div class="text-center">
									<h1 class="h4 text-gray-900 mb-4">Registrar Técnico</h1>
								</div>
								<form id="formTecnico" name="formTecnico"  novalidate onsubmit="return validarTecnico()" >
									@csrf
									<div class="form-group">
										<input id="nome" placeholder="Nome" type="text" class="form-control @error('name') is-invalid @enderror" name="nome"  required autocomplete="name" autofocus>
									</div>
									<div class="form-group">
										<input id="sobrenome" placeholder="Sobrenome" type="text" class="form-control @error('sobrenome') is-invalid @enderror" name="sobrenome"  required autocomplete="name" autofocus>
									</div>
									<div class="form-group">
										<input id="email" placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"  required autocomplete="email">
									</div>
									<div class="form-group">
										<input id="cpf" placeholder="CPF" type="number" class="form-control @error('cpf') is-invalid @enderror" name="cpf" required autocomplete="cpf" autofocus>
									</div>
									<div class="form-group">
										<input id="Rg" placeholder="RG" type="number" class="form-control @error('rg') is-invalid @enderror" name="Rg"  required autocomplete="Rg" autofocus>
									</div>
									<div class="form-group">
										<input id="telefone" maxlength="11" placeholder="Telefone" type="tel" class="form-control @error('telefone') is-invalid @enderror" name="telefone" required autocomplete="name" autofocus>
									</div>

									<div class="row mb-0">
										<div class="col-md-6 offset-md-4">
											<button type="submit" class="btn btn-primary">
												Cadastrar
											</button>
											<button  class="btn btn-warning">
												<a href="Tecnico" class="button"style="text-decoration: none;  color:aliceblue;">
													Voltar
												</a>
											</button>
											<hr />

										</form>
										<hr/>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="popup-container">
				<div class="popup-msg">
					<div class="popup-sucesso">
						<div class="popup-checkado"><i class="fas fa-check"></i></div>
						<div class="popup-texto">Técnico cadastrado com sucesso!</div>
						<div class="popup-fechar"><i class="fas fa-times"></i></div>
					</div>
				</div>
			</div>
		</section>
		@endsection
