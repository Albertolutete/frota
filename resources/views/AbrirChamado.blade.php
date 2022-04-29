@extends('layouts.mainForm')

@section('title', 'Abrir Chamado')

@section('content')

@php

//pegar o id proveniente do qrCode
$equipamento_id = trim(filter_input(INPUT_GET, 'id'));
if (empty($equipamento_id)):
header("location:/Elevador?sms=nok");
exit();
endif;

// receber as informacoes vindos do qrCode
$equipamento_id = filter_input(INPUT_GET, 'id');
// $tecnico_id = base64_decode(filter_input(INPUT_GET, 'tecnico_id'));

if (isset($equipamento_id)):
$equipamento_id = base64_decode($equipamento_id);
$equipamento = App\Equipamento::find($equipamento_id);
endif;
//verificar manutencao aberto ou criar caso nao tenha uma aberta
// $manutencao = App\Manutencoe::getManutencao($equipamento_id, 'p', $tecnico_id);

if (!empty($manutencao)) {
	//pegar o id da manutencao
	// $manutencao = App\Manutencoe::where("status", "a")->where("tipo", "p")->get(['id', 'chamado_id', 'tecnico_id'])->last();
	$manutencao_id = $manutencao['id'];
	// $chamado_id = $manutencao['chamado_id'];

}

$equipamento_nome = $equipamento->nome;

@endphp
<div class="row Conteudo">
	<div class="LEFT col-xs-2"></div>
	<div class="card">
		<div class="card-body">
			<div class="CENTER col-xs-8">
			</br>
			<form name="SIM_Predial" id="SIM_Predial"  onsubmit="return validarChamado()">
				@csrf
				<div class="mb-3">

					<div class="parent-tab">
						<h1 style="text-align: center; text-transform: uppercase">Solicitar Atendimento</h1>
						<div class="equipamento">

							<div class="form-input">
								<span>Nome do Equipamento</span>
								<input type="text" name="nome" id="nome_id" readonly value="{{ $equipamento_nome }}">
							</div>
							<div class="form-input">
								<span>Modelo</span>
								<input type="text" name="modelo" id="modelo_id" readonly value=<?= $equipamento->modelo ?>>
							</div>
							<div class="form-input">
								<span>Numero de Série</span>
								<input type="text" name="num_serie" id="num_serie_id" readonly value=<?= $equipamento->numeroSerie ?>>
							</div>
							<div class="form-input fabricante">
								<span>Fabricante</span>
								<input type="text" name="fabricante" id="frabricante_id" readonly value=<?= $equipamento->fabricante ?>>
							</div>

							<div class="form-input marca">
								<span>Marca</span>
								<input type="text" name="marca" id="frabricante_id" readonly value=<?= $equipamento->marca ?>>
							</div>

						</div>
					</div>

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
						<option value="1">Resgate</option>
						<option value="Resgate de passageiros">Resgate de passageiros</option>
						<option value="Equipamento parado com problema">Equipamento parado com problema</option>
						<option value="Equipamento funcionando mas com problema">Equipamento funcionando mas com problema</option>
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
				<input class="form-control" maxlength="11" type="phone" placeholder="(XX) 9XXXX-XXXX" name="telefone"
				>

			</div>
			<!-- pattern="^[0-9]{10}" max="3"-->
			<h6>Detalhes</h6>
			<div class="form-floating">
				<textarea maxlength="120" name="detalhes" class="form-control"
				placeholder="Leave a comment here" id="floatingTextarea" REQUIRED></textarea>
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


	@php
	$equipamento = App\Equipamento::find($equipamento_id);
	$loja = App\Empresa::find($equipamento->empresa_id);
	$empresa = App\Empresa::find($loja->empresa_id);

	@endphp
	<input type="hidden" name="equipamento_id" value=<?= $equipamento->id ?>>
	<input type="hidden" name="loja_id" value=<?= $loja->id ?>>
	<input type="hidden" name="empresa_id" value=<?= $empresa->id ?>>



</br>
<div class="row">
	<div class="col">
		<div class="d-grid gap-2">
			<button class="btn btn-secondary" onclick="voltar()">Voltar</button>
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
<div class="RIGHT col-xs-2"></div>
</div>

<div class="popup-container">
	<div class="popup-msg">
		<div class="popup-sucesso">
			<div class="popup-checkado"><i class="fas fa-check"></i></div>
			<div class="popup-texto">O seu pedido foi enviado com sucesso!</div>
			<div class="popup-fechar"><i class="fas fa-times"></i></div>
		</div>
	</div>
</div>


<script src="scripts/formSubmit.js"></script>
<script src="scripts/axios.min.js"></script>
@endsection
