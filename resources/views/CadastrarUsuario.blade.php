@extends('layouts.master')

@section('content')

<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Cadastrar Usuário</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Cadastrar Usuário</li>
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
							src="{{ asset('admin/img/security_PNG.png') }}" alt="" srcset="" class="img-fluid">
						</div>
						<div class="col-lg-6">
							<div class="p-5">
								<div class="text-center">
									<h1 class="h4 text-gray-900 mb-4">Registrar Usuário</h1>
								</div>
								<form method="POST" action="registarUser">
									@csrf
									<div class="form-group">
										<input id="name" placeholder="Nome" type="text"
										class="form-control @error('name') is-invalid @enderror" name="name"
										value="{{ old('name') }}" required autocomplete="name" autofocus>

										@error('name')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
									<div class="form-group">
										<input id="email" placeholder="Email" type="email"
										class="form-control @error('email') is-invalid @enderror" name="email"
										value="{{ old('email') }}" required autocomplete="email">

										@error('email')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
									<div class="form-group">
										<input id="password" placeholder="Senha" type="password"
										class="form-control @error('password') is-invalid @enderror" name="password"
										required autocomplete="new-password">

										@error('password')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
									<div class="form-group">



										<input id="password-confirm" placeholder="Confirmar Senha" type="password"
										class="form-control" name="password_confirmation" required
										autocomplete="new-password">

									</div>
									<div class="form-group">
										<div class="custom-control custom-checkbox small">
											<input type="checkbox" class="custom-control-input" id="customCheck" />

										</div>
									</div>
									<div class="row mb-0">
										<div class="col-md-6 offset-md-4">
											<button type="submit" class="btn btn-primary">
												{{ __('Register') }}
											</button>

											<button class="btn btn-warning">

												<a href="Usuarios" class="button"
												style="text-decoration: none;  color:aliceblue;">
												Voltar
											</a>
										</button>
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
@endsection
