@extends('layouts.master')

@section('content')

@php
$tecnico_id  = base64_decode(filter_input(INPUT_GET, "id"));
$tecnico= App\tecnico::Find($tecnico_id);



@endphp

<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Editar Técnico</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Editar Técnico</li>
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
									<h1 class="h4 text-gray-900 mb-4">Editar Técnico</h1>
								</div>
								<form id="formeditecnico" name="formeditecnico"  novalidate onsubmit="return validar validareditTecnico()" >
									@csrf
									{{csrf_field()}}
									<div class="form-group">
										<input id="nome" placeholder="<?= $tecnico->name?>" type="text" class="form-control @error('name') is-invalid @enderror" name="nome"  required autocomplete="name" autofocus>
									</div>
									<div class="form-group">
										<input id="sobrenome" placeholder="<?= $tecnico->user->sobrenome?>" type="text" class="form-control @error('sobrenome') is-invalid @enderror" name="sobrenome"  required autocomplete="name" autofocus>
									</div>
									<div class="form-group">
										<input id="email" placeholder="<?= $tecnico->user->email?>" type="email" class="form-control @error('email') is-invalid @enderror" name="email"  required autocomplete="email">
									</div>
									<div class="form-group">
										<input id="cpf" placeholder="<?= $tecnico->user->cpf?>" type="number" class="form-control @error('cpf') is-invalid @enderror" name="cpf" required autocomplete="cpf" autofocus>
									</div>
									<div class="form-group">
										<input id="Rg" placeholder="<?= $tecnico->user->rg?>" type="number" class="form-control @error('rg') is-invalid @enderror" name="Rg"  required autocomplete="Rg" autofocus>
									</div>
									<div class="form-group">
										<input id="telefone" placeholder="<?= $tecnico->user->telefone?>" type="tel" class="form-control @error('telefone') is-invalid @enderror" name="telefone" required autocomplete="name" autofocus>
									</div>

									<div class="row mb-0">
										<div class="col-md-6 offset-md-4">
											<button type="submit" class="btn btn-primary">
												Salvar
											</button>
											<button  class="btn btn-warning">

												<a href="Tecnico" class="button"style="text-decoration: none;  color:aliceblue;">
													Voltar
												</a>
											</button>
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
			<div class="popup-container">
				<div class="popup-container">
					<div class="popup-msg">
						<div class="popup-sucesso">
							<div class="popup-checkado"><i class="fas fa-check"></i></div>
							<div class="popup-texto">Dado alterado com sucesso</div>
							<div class="popup-fechar"><i class="fas fa-times"></i></div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<script>

		var formeditecnico = document.getElementById("formeditecnico");

		function validareditTecnico(){
			let popup = document.querySelector(".popup-container");
			// axios.defaults.withCredentials = true;
			// axios.defaults.headers.common['X-CSRF-TOKEN'] = token_var;

			var formData = new FormData(formeditecnico);

			axios({
				method: 'post',
				url: "editarEmpresa",
				headers: { "Content-Type": "multipart/form-data",
			},
			data: formData,
		})
		.then(res => {
			if(res.data == "ok"){
				popup.classList.add("mostrar");
				setTimeout(()=>{
					location.href = "Tecnico";
					popup.classList.remove("mostrar");
				}, 2000);
			}
			// console.log(res);
		})
		.catch(err => {
			console.error(err);
		})
		return false;
	}
	</script>
	@endsection
