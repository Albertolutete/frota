@extends('layouts.mainForm')
@section('title', 'Preventivo')

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
$manutencao = App\Manutencoe::getManutencao($equipamento_id, 'p', $tecnico_id);

if (!empty($manutencao)) {
	//pegar o id da manutencao
	// $manutencao = App\Manutencoe::where("status", "a")->where("tipo", "p")->get(['id', 'chamado_id', 'tecnico_id'])->last();
	$manutencao_id = $manutencao['id'];
	// $chamado_id = $manutencao['chamado_id'];
	$tecnico_id = $manutencao['tecnico_id'];
}

$equipamento_nome = $equipamento->nome;

@endphp

<div class="wrapper">
	<div>
		<div class="parent-tab">
			<h1 style="text-align: center; text-transform: uppercase">{{ $equipamento_nome }}</h1>
			<div class="equipamento">

				<div class="form-input">
					<span>Modelo</span>
					<input type="text" name="modelo" id="modelo_id"  readonly value=<?= $equipamento->modelo ?>>
				</div>
				<div class="form-input">
					<span>Número de Série</span>
					<input type="text" name="num_serie" id="num_serie_id"  readonly value=<?= $equipamento->numeroSerie ?>>
				</div>
				<div class="form-input fabricante">
					<span>Fabricante</span>
					<input type="text" name="fabricante" id="frabricante_id"  readonly value=<?= $equipamento->fabricante ?>>
				</div>

				<div class="form-input marca">
					<span>Marca</span>
					<input type="text" name="marca" id="frabricante_id"  readonly value=<?= $equipamento->marca ?>>
				</div>

			</div>
		</div>

		<!-- Accordion Heading One -->
		@foreach ($equipamento->componentes as $componente)

		<div class="parent-tab tab-3">
			<input class="hide" type="radio" name="tab" id="{{ $componente->id }}">
			<label class="accordion-label" for="{{ $componente->id }}">
				<div class="heading">
					<div class="icon-check">
						<i class="fa fa-check" style="color: rgb(25, 194, 137);"></i>
					</div>
					<span>{{ $componente->nome }}</span>
				</div>
				<div class="icon">
					<i class="fas fa-plus"></i>
					<i class="fas fa-minus"></i>
				</div>
			</label>
			<div class="content ">

				<!-- Sub Heading One -->
				@foreach ($componente->subcomponentes as $subcomponente)

				<div class="child-tab">
					<input class="hide" type="radio" name="sub-tab" id="tab-11">
					<label for="tab-11">
						<div class="heading">
							<div class="icon-check">
								<i class="fa fa-check" style="color:
								aquamarine;"></i>
							</div>
							<span>{{ $subcomponente->nome }}</span>
						</div>
						<div class="icon">
							<i class="fas fa-plus"></i>
							<i class="fas fa-minus"></i>
						</div>
					</label>
					<div class="sub-content">
						<form class="form-tab-1">
							@csrf
							<input type="hidden" name="manutencao_id" class="manutencao_id"
							value=<?= $manutencao_id ?>>
							<div class="form-input">
								<span>Foto/Imagem</span> <i
								class="fa fa-check" style="color: rgb(25, 194, 137);"></i>
								<input class="foto-input" type="file" name="foto" id="foto_id"
								onchange="return verificar(this)">

							</div>

							<div class="form-input">
								<p>
									<span>Status</span> <i class="fa fa-check"
									style="color: rgb(25, 194, 137);"></i>
								</p>
								<select class="status-input" name="status_select" id="status_id"
								onchange="return verificar(this)">

								<option value="conforme">
									Conforme</option>
									<option value="não conforme">
										Não Conforme
									</option>
									<option value="Não se aplica">
										Não se aplica
									</option>
								</select>
							</div>

							<div class="form-input">
								<p>
									<span>Observações</span> <i class="fa fa-check" style="color: rgb(25, 194,
										137);"></i>
									</p>
									<textarea class="obs-input" onchange="return verificar(this)"
									placeholder="Digite algumas observações" name="observacoes"
									id="obs_id"></textarea>
								</div>

								<div class="submitBtn">
									<input type="submit" value="Salvar" onclick="return verificar(this)">
								</div>

							</form>
						</div>
					</div>
					@endforeach


				</div>
			</div>
			@endforeach

			<div class="parent-tab" id="assinatura">
				{{-- <div id="modalClose">
					<i class="fas fa-times"></i>
				</div> --}}

				<div id="signature-pad" class="signature-pad">
					<h1 align=center>Assinatura do Técnico <i class="fa fa-check"
						style="color: rgb(8, 102, 71); font-size:22px;"></i></h1>
						<div class="signature-pad--body">
							<canvas></canvas>
						</div>
						<div class="signature-pad--footer">
							<div class="description"></div>

							<div class="signature-pad--actions">
								<div>
									<button type="button" class="button clear" data-action="clear">Refazer</button>
								</div>
								<div>
									{{-- <button type="button" id="back_0" class="button">Cancelar</button> --}}
									<button type="button" id="save_admin" class="button save"
									data-action="save-png" style="display: none;">Salvar</button>
									{{-- <button type="button" id="avancar_admin" class="button save" data-action="save-png"
									style="display: none;">Avançar</button> --}}
									<!-- <button type="button" class="button save" data-action="save-jpg">Save as JPG</button> -->
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="parent-tab">
					<div id="signature-pad-client" class="signature-pad-client">
						<h1 align=center>Assinatura do Cliente <i class="fa fa-check"
							style="color: rgb(8, 102, 71); font-size:22px;"></i></h1>
						</h1>
						<div class="signature-pad--body">
							<canvas id="client-pad"></canvas>
						</div>
						<div class="signature-pad--footer">
							<div class="description"></div>

							<div class="signature-pad--actions">
								<div>
									<button type="button" class="button clear_1" data-action="clear_1">Refazer</button>
								</div>
								<div>
									{{-- <button type="button" id="back_1" class="button">Voltar</button> --}}
									<button type="button" id="save_client" class="button save_1"
									data-action="save_1-png" style="display: none;">Salvar</button>
									<!-- <button type="button" class="button save" data-action="save-jpg">Save as JPG</button> -->
								</div>
							</div>
						</div>
					</div>
				</div>

				{{-- Date --}}
				<div class="parent-tab">
					<div class="row">
						<?php  ?>
						<div class="col">
							<input class="form-control" id="horaentrada" name="horaentrada" type="time"
							value="<?php echo date('H:i'); ?>" readonly>
						</div>
						<div class="col">
							<input class="form-control" id="dataentrada" name="dataentrada" type="date"
							value="<?php echo date('Y-m-d') ?>" readonly>
						</div>

					</div>
				</div>

				<div class="submitBtn-all">
					<a class="form-cancel" href="FinalizarChamado">Voltar</a>
					<input id="enviar-form" class="enviar-form" type="button" value="Finalizar Manutenção">
				</div>

			</form>

			<div class="popup-container">
				<div class="popup-msg">
					<div class="popup-sucesso">
						<div class="popup-checkado"><i class="fas fa-check"></i></div>
						<div class="popup-texto">Manutencao finalizada com sucesso!</div>
						<div class="popup-fechar"><i class="fas fa-times"></i></div>
					</div>
				</div>
			</div>



		</div>
	</div>



	@endsection
