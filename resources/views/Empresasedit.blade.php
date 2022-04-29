@extends('layouts.master')

@section('title','Editar Empresa')

@section('content')

@php
$empresa_id  = base64_decode(filter_input(INPUT_GET, "id"));
$empresa= App\Empresa::Find($empresa_id);



@endphp
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Editar Empresa</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Editar Empresa</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
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
									<h1 class="h4 text-gray-900 mb-4">Editar Empresa</h1>
								</div>

								<form id="formeditEmpresa" name="formeditEmpresa" novalidate onsubmit="return validareditEmpresa()">
									@csrf
									{{csrf_field()}}
									<div class="form-group">
										<p class="form-label mb-0">Nome:</p>
										<input  placeholder="Razão Social/ Nome Fantasia" type="text"
										class="form-control @error('name') is-invalid @enderror" name="descricao"
										value="<?= $empresa->descricao ?>" required autocomplete="name" autofocus>
									</div>
									<div class="form-group">
										<p class="form-label mb-0">Cidade:</p>
										<input  placeholder="Cidade" type="text"
										class="form-control @error('name') is-invalid @enderror" name="cidade"
										value="<?= $empresa->cidade ?>" required autocomplete="name" autofocus>
									</div>
									<div class="form-group">
										<p class="form-label mb-0">Responsável:</p>
										<input  placeholder="Nome do Responsável" type="text"
										class="form-control @error('name') is-invalid @enderror" name="responsavel"
										value="<?= $empresa->responsavel ?>" required autocomplete="name" autofocus>

									</div>
									<div class="form-group">
										<p class="form-label mb-0">Estado:</p>
										<input  placeholder="Estado" type="text"
										class="form-control @error('name') is-invalid @enderror" name="estado"
										value="<?= $empresa->estado ?>" required autocomplete="name" autofocus>


									</div>
									<div class="form-group">
										<p class="form-label mb-0">Bairro:</p>
										<input  placeholder="Bairro" type="text"
										class="form-control @error('name') is-invalid @enderror" name="bairro"
										value="<?= $empresa->bairro ?>" required autocomplete="name" autofocus>

									</div>
									<div class="form-group">
										<p class="form-label mb-0">Logradouro:</p>
										<input  placeholder="Endereço" type="text"
										class="form-control @error('name') is-invalid @enderror" name="logradouro"
										value="<?= $empresa->logradouro ?>" required autocomplete="name" autofocus>


									</div>
									<div class="form-group">
										<p class="form-label mb-0">Número:</p>
										<input  placeholder="Número" type="text"
										class="form-control @error('name') is-invalid @enderror" name="numero"
										value="<?= $empresa->numero ?>" required autocomplete="name" autofocus>


									</div>
									<div class="form-group">
										<p class="form-label mb-0">CEP:</p>
										<input id="cep" placeholder="Cep" type="text"
										class="form-control @error('name') is-invalid @enderror" name="cep"
										value="<?= $empresa->cep ?>" required autocomplete="name" autofocus>


									</div>
									<div class="form-group">
										<p class="form-label mb-0">CNPJ:</p>
										<input  placeholder="Cpnj" type="text"
										class="form-control @error('name') is-invalid @enderror" name="cnpj"
										value="<?= $empresa->cnpj ?>" required autocomplete="name" autofocus>
									</div>
									<div class="form-group">
										<p class="form-label mb-0">Telefone:</p>
										<input  placeholder="Telefone" type="text"
										class="form-control @error('name') is-invalid @enderror" name="telefone"
										value="<?= $empresa->telefone ?>" required autocomplete="name" autofocus>
									</div>
									<div class="form-group">
										<p class="form-label mb-0">Email:</p>
										<input id="email" placeholder="Email" type="email"
										class="form-control @error('email') is-invalid @enderror" name="email"
										value="<?= $empresa->email ?>" required autocomplete="email">
									</div>

									<input type="hidden" name="tipo" value="cliente">
									<input type="hidden" name="empresa_id" value="{{$empresa_id}}">

									<div class="form-group">
										<p class="form-label mb-0">Status:</p>
										<select name="status" id="" class="form-control">
											<option value="Ativo">Ativo</option>
											<option value="Inatio">Inativo</option>
										</select>

									</div>

									<div class="form-group">
										<labe>Escolha a logo ou deixe em branco para a logo atual</labe><hr>
										<img id="output" src="storage/app/public/{{$empresa->logo}}" width="100" height="100" style="border-radius: 50%">
										<input  placeholder="Logotipo da empresa" type="file"
										class="form-control @error('name') is-invalid @enderror" name="logo"
										value="{{ old('logo') }}" autofocus onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
									</div>

									<div class="row mb-0">
										<div class="col-md-6 offset-md-4">
											<button type="submit" class="btn btn-primary" id="empresaSubmit">
												Salvar
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
<div class="popup-container">
	<div class="popup-msg">
		<div class="popup-sucesso">
			<div class="popup-checkado"><i class="fas fa-check"></i></div>
			<div class="popup-texto">Dado alterado com sucesso!</div>
			<div class="popup-fechar"><i class="fas fa-times"></i></div>
		</div>
	</div>
</div>
<script>

var formEditEmpresa = document.getElementById("formeditEmpresa");

function validareditEmpresa(){
	let popup = document.querySelector(".popup-container");
	// axios.defaults.withCredentials = true;
	// axios.defaults.headers.common['X-CSRF-TOKEN'] = token_var;

	var formData = new FormData(formEditEmpresa);

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
			location.href = "Empresas";
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
