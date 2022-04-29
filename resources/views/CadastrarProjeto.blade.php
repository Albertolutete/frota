@extends('layouts.master')

@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Projeto</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Cadastrar Projeto</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>
<section class="content">
	


	<div class="card">
		<div class="card-body">
			<div class="CENTER col-xs-8">
				<h2 class="title">Cadastrar Projeto</h2>
			</br>
			<form name="SIM_Predial" enctype="multipart/form-data" id="SIM_Predial" action="confirmacao/" method="POST">
				<div class="mb-3">
					<input type="hidden" name="MAX_FILE_SIZE" value="1024000" />
					<label for="formFile" class="form-label">Selecione um Arquivo</label>
					<input class="form-control" type="file" id="formFile" name="ArquivoProjetos" accept=".pdf, .png, .jpg, .jpeg, .bmp, .doc, .docx">
					<small id="passwordHelpBlock" class="form-text text-muted">Extensões aceitas: PDF, PNG, JPG, JPEG, BMP, DOC, DOCX</small>
				</div>
				<div class="mb-3">
					<label class="form-label">Data do Pedido</label>
				</br>
				<small class="opacity-75">Campo auto preenchido</small>
				<div class="row">
					<div class="col">
						<input class="form-control" id="DataDeEnvio" name="DataDeEnvio" type="date" value="" readonly>
					</div>
					<div class="col">
						<input class="form-control" id="horaentrada" name="horaentrada" type="time" value="" readonly>
					</div>
				</div>
			</div>
		</br>
	</br>
	<div class="row">
		<div class="col">
			<div class="d-grid gap-2">
				<button type="button" class="btn btn-secondary" ><i class="mdi mdi-arrow-left-bold"><a href="projeto" style="color: aliceblue;">Voltar</a></i> </button>
			</div>
		</div>
		<div class="col">
			<div class="d-grid gap-2">
				<input type="submit" class="btn btn-primary" text="Enviar">
			</div>
		</div>
	</div>
</form>
</div>
</div>
</div>
</section>
@endsection
