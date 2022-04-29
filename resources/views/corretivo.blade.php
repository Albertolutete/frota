@extends('layouts.mainForm')



@section('title', 'Corretivo')



@section('content')



<!-- abrir uma manutencao preventiva caso nao exista uma aberta-->

@php

// receber as informacoes vindos do qrCode
$equipamento_id = filter_input(INPUT_GET, 'id');
$tecnico_id = base64_decode(filter_input(INPUT_GET, 'tecnico_id'));

if (isset($equipamento_id)):
$equipamento_id = base64_decode($equipamento_id);
$equipamento = App\Equipamento::find($equipamento_id);
endif;
//verificar manutencao aberto ou criar caso nao tenha uma aberta
$manutencao = App\Manutencoe::getManutencao($equipamento_id, 'c', $tecnico_id);

if (!empty($manutencao)) {
	//pegar o id da manutencao
	// $manutencao = App\Manutencoe::where("status", "a")->where("tipo", "c")->get(['id', 'chamado_id', 'tecnico_id'])->last();
	$manutencao_id = $manutencao['id'];
	// $chamado_id = $manutencao['chamado_id'];
	$tecnico_id = $manutencao['tecnico_id'];
}

$equipamento_nome = $equipamento->nome;

@endphp





<div class="row Conteudo">

	<div class="LEFT col-xs-2"></div>

	<div class="card">

		<div class="card-body">

			<div class="CENTER col-xs-8">





				<form name="SIM_Predial" enctype="multipart/form-data" id="manutencao_corretiva" novalidate
				onsubmit="return validarCorretiva()">

				@csrf

				<input type="hidden" name="manutencao_id" class="manutencao_id" value=<?= $manutencao_id ?>>

			</br>



			<div class="border p-3 mb-3">

				<div class="row">

					<div class="parent-tab">
						<h1 style="text-align: center; text-transform: uppercase">{{ $equipamento_nome }}</h1>
						<div class="equipamento">

							<div class="form-input">
								<span>Modelo</span>
								<input type="text" name="modelo" readonly id="modelo_id"
								value=<?= $equipamento->modelo ?> >
							</div>
							<div class="form-input">
								<span>Numero de Série</span>
								<input type="text" name="num_serie" readonly id="num_serie_id"
								value=<?= $equipamento->numeroSerie ?>>
							</div>
							<div class="form-input fabricante">
								<span>Fabricante</span>
								<input type="text" name="fabricante" readonly id="frabricante_id"
								value=<?= $equipamento->fabricante ?>>
							</div>

							<div class="form-input marca">
								<span>Marca</span>
								<input type="text" name="marca" readonly id="frabricante_id"
								value=<?= $equipamento->marca ?>>
							</div>

						</div>
					</div>

				</div>

			</br>

			<label>Material Aplicado</label>

			<div class="form-floating">

				<textarea maxlength="120" name="material" class="form-control"
				placeholder="Deixe uma Observação" id="floatingTextarea" REQUIRED></textarea>

				<label for="floatingTextarea">Se necessário</label>

			</div>


		</br>

		<div class="mb-3">

			<label>Situação Final do Equipamento</label>

			<div class="form-check">

				<input id="exampleRadios1" class="form-check-input" type="radio" name="situacao"
				value="Equipamento em operação, em perfeitas condições" required>

				<label class="form-check-label" for="exampleRadios1">

				Veiculo em operação, em perfeitas condições

				</label>

			</div>

			<div class="form-check">

				<input id="exampleRadios2" class="form-check-input" type="radio" name="situacao"
				value="Equipamento em operação, com ressalvas" required>

				<label class="form-check-label" for="exampleRadios2">

					Veiculo em operação, com ressalvas

				</label>

			</div>

			<div class="form-check">

				<input id="exampleRadios3" class="form-check-input" type="radio" name="situacao"
				value="Equipamento fora de operação" required>

				<label class="form-check-label" for="exampleRadios3">

					Veiculo fora de operação

				</label>

			</div>

		</div>

	</br>

</div>

<h6>Informações Adicionais</h6>

<div class="border p-3">

	<label>Observações</label>

	<div class="form-floating">

		<textarea maxlength="60" name="observacoes" class="form-control"
		placeholder="Deixe uma Observação" id="floatingTextarea"></textarea>

		<label for="floatingTextarea">Se necessário</label>

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
		value="<?php echo date('H:i'); ?>" readonly>

	</div>

</div>

</div>

<h5>Selecione a foto da O.S</h5>

<div class="mb-3">

	<input class="form-control" type="file" name="tec_manutencao"
	accept=".png, .jpg, .jpeg, .bmp" id="tec_manutencao">

	<small id="passwordHelpBlock" class="form-text text-muted">Extensões aceitas: PNG, JPG,

		JPEG, BMP </small>

	</div>

</div>

</br>
<div style="background-color: rgb(243, 242, 242); margin-bottom:20px">



	<div class="parent-tab">



		<div id="signature-pad" class="signature-pad pad-corretiva">

			{{-- <h6>Técnico Responsável pela Manutenção</h6> --}}

			{{-- <h3>Assinatura digital campo tipo foto</h3> --}}

			<h1 align=center>Assinatura do Técnico <i class="fa fa-check"
				style="color: rgb(8, 102, 71); font-size:22px;"></i></h1>

				<div class="signature-pad--body">

					<canvas></canvas>

				</div>

				<div class="signature-pad--footer">

					<div class="description">Digite a sua assinatura por cima</div>



					<div class="signature-pad--actions">

						<div>

							<button type="button" class="button clear"
							data-action="clear">Refazer</button>

						</div>

						<div>

							{{-- <button type="button" id="back_0" class="button">Cancelar</button> --}}

							<button type="button" id="save_admin" class="button save"
							data-action="save-png" style="display: none;">Salvar</button>

							<button type="button" id="avancar_admin" class="button save"
							data-action="save-png" style="display: none;">Avançar</button>

							<!-- <button type="button" class="button save" data-action="save-jpg">Save as JPG</button> -->

						</div>

					</div>

				</div>

			</div>



			<div id="signature-pad-client" class="signature-pad-client pad-corretiva">

				<h1 align=center class=" bg-gray">Assinatura do cliente <i class="fa fa-check"
					style="color: rgb(8, 102, 71); font-size:22px;"></i></h1>

					{{-- <h3>Assinatura digital campo tipo foto</h3> --}}

					<div class="signature-pad--body">

						<canvas id="client-pad"></canvas>

					</div>

					<div class="signature-pad--footer">

						<div class="description">Digite a sua assinatura por cima</div>



						<div class="signature-pad--actions">

							<div>

								<button type="button" class="button clear_1"
								data-action="clear_1">Refazer</button>

							</div>

							<div>

								{{-- <button type="button" id="back_1" class="button">Voltar</button> --}}

								<button type="button" id="save_client" class="button save_1"
								data-action="save_1-png" style="display: none">Salvar</button>

								<!-- <button type="button" class="button save" data-action="save-jpg">Save as JPG</button> -->

							</div>

						</div>

					</div>

				</div>

			</div>



		</div>
	</br>
	{{-- Controlls --}}
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

			<div class="popup-texto">Manutenção finalizada com sucesso!</div>

			<div class="popup-fechar" style="visibility: hidden"><i class="fas fa-times"></i></div>

		</div>

	</div>

</div>

<div class="row Footer">

	<div class="col-xs-12"></div>
	
</div>



@endsection
