@extends('layouts.master')

@section('title','Painel Gerencial')

@section('content')

<!-- /.content-header -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Painel</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Painel</li>
				</ol>
			</div>
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<!-- Small boxes (Stat box) -->
		<div class="row">

           <!-- =========================================================== -->
   
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-info">
              <span class="info-box-icon"><i class="far fa-envelope"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Chamados em espera</span>
              	<span class="info-box-number" id="chmdAbertos"></span>
               
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-success">
              <span class="info-box-icon"><i class="fa fa-check-to-slot"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Chamados finalizados</span>
                <span class="info-box-number" id="chmdFinalizados"></span>

            
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-warning">
              <span class="info-box-icon"><i class="far fa-envelope"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total de chamados</span>
                <span class="info-box-number" id="chamadosTotal"></span>

                
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
         



			<!-- /.col -->
			<!--<div class="col-md-3  col-sm-6 col-6">-->
			<!--	<div class="info-box">-->
			<!--		<span class="info-box-icon bg-yellow"><i class="far fa-envelope"></i></span>-->

			<!--		<div class="info-box-content">-->
			<!--			<span class="info-box-text">Total de chamados</span>-->
			<!--			<span class="info-box-number" id="chamadosTotal"></span>-->
			<!--		</div>-->
					<!-- /.info-box-content -->
			<!--	</div>-->
				<!-- /.info-box -->
			<!--</div>-->
			<!-- /.col -->

			<!--<div class="col-md-3 col-sm-6 col-6">-->
			<!--	<div class="info-box">-->
			<!--		<span class="info-box-icon bg-green "><i class="fa fa-check-to-slot"></i></span>-->

			<!--		<div class="info-box-content">-->
			<!--			<span class="info-box-text">Chamados Finalizados</span>-->
			<!--			<span class="info-box-number" id="chmdFinalizados"></span>-->
			<!--		</div>-->
					<!-- /.info-box-content -->
			<!--	</div>-->
				<!-- /.info-box -->
			<!--</div>-->

			<!--<div class="col-md-3 col-sm-6 col-6 ">-->
			<!--	<div class="info-box">-->
			<!--		<span class="info-box-icon bg-info"><i class="far fa-envelope-open"></i></span>-->

			<!--		<div class="info-box-content">-->
			<!--			<span class="info-box-text">Chamados em espera</span>-->
			<!--			<span class="info-box-number" id="chmdAbertos"></span>-->
			<!--		</div>-->
					<!-- /.info-box-content -->
			<!--	</div>-->
				<!-- /.info-box -->
			</div>

			<?php if (App\Previlegio::temPrevilegio("abrir_chamado", Auth::user()->id)): ?>
				<div class="col-md-3 col-sm-4 col-4 ">
					<div class="info-box-text">
						<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-xl-form">
							Solicitar atendimento
						</button>
					</div>

				</div>
			<?php endif ?>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title"> </h3>

							<div class="card-tools">
								<div class="input-group input-group-sm" style="width: 150px;">
									<input type="text" name="table_search" class="form-control float-right"
									placeholder="Procurar">

									<div class="input-group-append">
										<button type="submit" class="btn btn-default">
											<i class="fas fa-search"></i>
										</button>
									</div>
								</div>
							</div>
						</div>
						<!-- /.card-header -->
						<div class="card-body table-responsive p-0" style="height: 400px;">
							<table class="table table-head-fixed text-nowrap table-striped">
								<thead>
									<tr>
										<th>Emissor</th>
										<th>Tipo</th>
										<th>Empresa</th>
										<th>Equipamento</th>
										<th>Motivo</th>
										<th>Telefone</th>
										<th>Status</th>

									</tr>
								</thead>
								<tbody id="listChamados">
									{{-- @foreach ($chamados as $chamado)
										<tr>
											<td>{{ $chamado['nome'] }}</td>
											<td>{{ $chamado['equipamento'] }}</td>
											<td>{{ $chamado['Motivo'] }}</td>
											<td>{{ $chamado['Telefone'] }}</td>
											<td>{{ $chamado['detalhes'] }}</td>
											<td>{{ $chamado['data'] }}</td>

											<td>
												<span class="" style="font-size: 22px">
													<i class="far fa-envelope abrir" data-toggle="modal"
													data-target="#modal-xl" onclick="abrirEnvelope(this)"></i>
													<i class="far fa-envelope-open" data-toggle="modal"
													data-target="#modal-xl" style="display: none"
													onclick="clickme()"></i>
												</span>
											</td>

										</tr>

										@endforeach --}}


									</tbody>
								</table>
							</div>
							<!-- /.card-body -->
						</div>
						<!-- /.card -->
					</div>
				</div>


				<!--Modal para detalhes de chamados-->
				<div class="modal fade" id="modal-xl">
					<div class="modal-dialog modal-xl">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Atendimento</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">

								<div id="chamados-detail">
									<div class="descricao">
										<h3>Detalhes do Chamado</h3>
										<hr>
										<table>
											<tr>
												<th>Nome</th>
												<td class="nome"></td>
											</tr>
											<tr>
												<th>Tipo</th>
												<td class="tipo"></td>
											</tr>
											<tr>
												<th>Empresa</th>
												<td class="empresa"></td>
											</tr>
											<tr>
												<th>Equipamento</th>
												<td class="equipamento"></td>
											</tr>
											<tr>
												<th>Motivo</th>
												<td class="motivo"></td>
											</tr>
											<tr>
												<th>Telefone</th>
												<td class="telefone"></td>
											</tr>
											<tr>
												<th>Detalhes</th>
												<td class="detalhes"></td>
											</tr>
											<tr>
												<th>Cargo</th>
												<td class="cargo"></td>
											</tr>
											<tr>
												<th>Data</th>
												<td class="data"></td>
											</tr>

										</table>
									</div>
									<div id="anexo-chamado" class="anexo">
										<img width="100%" height="100%" src="" alt="">
									</div>

								</div>

							</div>
							<div class="modal-footer justify-content-between">
								<button type="button" class="btn btn-default" data-dismiss="modal">ok</button>

							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
			</div>
		</div>

		<!-- inicio modal -->
		<!--Modal de abertura de chamado-->
		<div class="modal fade" id="modal-xl-form">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">

						<div class="CENTER col-xs-8">
							<h2><b>Solicitar Atendimento</b></h2>
						</br>
						<form name="SIM_Predial" id="SIM_Predial" onsubmit="return validarChamado()">
							@csrf
							<div class="mb-3">

								<br>
								<h6>Seu Nome completo</h6>
								<div class="row">
									<div class="col">
										<input type="text" name="nome" class="form-control" placeholder="Nome Sobrenome"
										aria-label="First name" REQUIRED>
									</div>
								</div>
								<br>
								<h6>Seu Cargo</h6>
								<div class="row">
									<div class="col">
										<input type="text" name="cargo" class="form-control" placeholder="Cargo"
										aria-label="First name" REQUIRED>
									</div>
								</div>
							</br>

							<div class="mb-3">
								<h6>Porque está abrindo este chamado?</h6>
								<select class="form-select" aria-label="Default select example" name="motivo">
									<option value="Resgate">Resgate</option>
									<option value="Resgate de passageiros">Resgate de passageiros</option>
									<option value="Equipamento parado com problema">Equipamento parado com problema
									</option>
									<option value="Equipamento funcionando mas com problema">Equipamento funcionando mas
										com problema</option>
									</select>
								</div>
							</br>

							@php
							$equipamentos = App\Equipamento::where("empresa_id",Auth::user()->empresa_id)->get();
							$empresaLojas = App\Empresa::where("tipo","=","loja")->where("empresa_id","=",Auth::user()->empresa_id)->get();
							$empresa_id = App\Empresa::where("tipo","=","cliente")->where("empresa_id","=",Auth::user()->empresa_id)->get();

							@endphp
							<input type="hidden" name="empresa_id" value="{{ Auth::user()->empresa_id }}">
							<div class="mb-3">
								<h6>Loja</h6>
								<select class="form-select" aria-label="Default select example" name="loja_id" id="loja_id" required>
									<option value="">Selecione a Loja</option>
									@foreach($empresaLojas as $empresa)
									<option value="{{$empresa->id}}">{{$empresa->descricao}}</option>
									@endforeach
								</select>
							</div>
						</br>

						<div class="mb-3">
							<h6>Equipamento</h6>
							<select id = "equipamentos" class="form-select" aria-label="Default select example" name="equipamento_id" required>
								{{-- @foreach($equipamentos as $equipamento)
									<option value="{{$equipamento->id}}">{{$equipamento->nome}}</option>
									@endforeach --}}
								</select>
							</div>
						</br>

						<div class="mb-3">
							<h6>Tipo de Manutenção</h6>
							<select class="form-select" aria-label="Default select example" name="tipo" required>
								<option disabled selected>Escolha o tipo de manutenção</option>
								<option value="c">Corretivo</option>
								<option value="p">Preventivo</option>
							</select>
						</div>
					</br>

					<div class="mb-3">
						<h6>Seu Telefone</h6>
						<input class="form-control" maxlength="11" type="phone" placeholder="(XX) 9XXX-XXXX" name="telefone"
						>
					</div>
					<!--pattern="^[0-9]{10}" max="3"-->
					<h6>Detalhes</h6>
					<div class="form-floating">
						<textarea maxlength="120" name="detalhes" class="form-control"
						placeholder="Deixe uma Observação" id="floatingTextarea" REQUIRED></textarea>
						<label for="floatingTextarea">Descrição do problema</label>
					</div>
				</br>
				<div class="mb-3">
					<label class="form-label">Data da Solicitação</label>
				</br>
				<small class="opacity-75">Campo auto preenchido</small>
				<div class="row">
					<div class="col">
						<input class="form-control" id="dataentrada" name="dataentrada" type="date"
						value="<?php echo date('Y-m-d'); ?>" readonly>
					</div>
					<div class="col">
						<input class="form-control" id="horaentrada" name="horaentrada" type="time"
						value="<?php date_default_timezone_set('America/Sao_Paulo');
						echo date('H:i'); ?>" readonly>
					</div>
				</div>
			</div>
			<h5>Anexar Foto</h5>
			<div class="mb-3">
				<input class="form-control" type="file" name="tec_manutencao"
				accept=".png, .jpg, .jpeg, .bmp" id="tec_manutencao">
				<small id="passwordHelpBlock" class="form-text text-muted">Extensões aceitas: PNG, JPG,
					JPEG, BMP </small>
				</div>
			</br>




		</br>
		<div class="row">
			<div class="col">
				<div class="d-grid gap-2">
					<button type="button" class="btn btn-outline-secondary" data-dismiss="modal" aria-label="Close">Sair</button>
				</div>
			</div>
			<div class="col">
				<div class="d-grid gap-2">
					<input type="submit" class="btn btn-primary" text="Enviar">
				</div>
			</div>
		</div>
		{{-- Campos ocultos --}}
	</form>
</div>

</div>

</div>
<!-- /.modal-content -->


</div>
<!-- /.modal-dialog -->
</div>

<div class="popup-container admin">
	<div class="popup-msg">
		<div class="popup-sucesso">
			<div class="popup-checkado"><i class="fas fa-check"></i></div>
			<div class="popup-texto">O seu pedido foi enviado com sucesso!</div>
			<div class="popup-fechar"><i class="fas fa-times"></i></div>
		</div>
	</div>
</div>

</section>
<script>
function voltar(){
	document.querySelector(".close").click();
}
function listarChamados(){
	var listarChamados = document.querySelector("#listChamados");
	// var id = setInterval(() => {

	axios.defaults.withCredentials = true;
	axios({
		method: 'get',
		url: "listarChamados",
	})
	.then(res => {
		listarChamados.innerHTML = res.data;
		// console.log(res)
	})
	.catch(err => {
		console.error(err);
	})
	// }, 1500);
}
// listarChamados();
var flug = -1;
var id2 = setInterval(() => {
	axios({
		method: 'get',
		url: "obterStatus",
	})
	.then(res => {
		result = res.data;
		console.log(res.data);
		resultArray = result.split(",");

		if(flug != resultArray[0]){
			flug = resultArray[0];
			listarChamados();
		}

		document.getElementById("chmdFinalizados").innerHTML = resultArray[2];
		document.getElementById("chamadosTotal").innerHTML = resultArray[0];
		document.getElementById("chmdAbertos").innerHTML = resultArray[1];
		// console.log(resultArray);
	})
	.catch(err => {
		console.error(err);
	})
}, 1500);
</script>
@endsection
