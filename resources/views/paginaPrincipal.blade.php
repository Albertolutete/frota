@extends('layouts.main')

@section('title', 'Pagina Inicial')

@section('content')

<?php
//pegar o id proveniente do qrCode
$equipamento_id = filter_input(INPUT_GET, 'id');
$sms = filter_input(INPUT_GET, 'sms');

if (!empty($sms)) {
	echo "<h6 id='sms' style='text-align: center; display:inline'></h6>";
}

if (!empty($equipamento_id)):
	$equipamento_id = base64_decode($equipamento_id);
endif;

?>
{{-- <h1>{{$equipamento_id}}</h1> --}}
<h6 id='sms' style='text-align: center; display:inline'></h6>
<div class="col-4" id="finalizarChamado">
	<a href="FinalizarChamado?id=<?php echo base64_encode($equipamento_id); ?>" class="icon text-shadow-l icon-xxl rounded-xl gradient-blue1"><i
		class="fas fa-tools text-shadow-l font-30"></i></a>
		<p class="men">Manutenções</p>
	</div>
	<!--<div class="col-4">
	<a href="Form/Orcamento/"
	class="icon text-shadow-l icon-xxl rounded-xl gradient-blue1"><i
	class="fas fa-tools text-shadow-l font-30"></i></a>
	<p class="men">Enviar Orçamento</p>
</div>
<div class="col-4">
<a href="Form/Pecas/"
class="icon text-shadow-l icon-xxl rounded-xl gradient-blue1"><i
class="fas fa-tools text-shadow-l font-30"></i></a>
<p class="men">Informar espera de Peças</p>
</div> -->
<div class="col-4" id="abrirChamado">
	<a href="AbrirChamado?id=<?php echo base64_encode($equipamento_id); ?>" class="icon text-shadow-l icon-xxl rounded-xl gradient-blue1"><i
		class="fas fa-headset text-shadow-l font-30"></i></a>
		<p class="men">Abrir Chamado</p>
	</div>
	<!--
	<div class="col-4">
	fas  fa-file-chart-column
	<a href="Form/Prorrogacao/"
	class="icon text-shadow-l icon-xxl rounded-xl gradient-blue1"><i
	class="fas fa-tools text-shadow-l font-30"></i></a>
	<p class="men">Prorrogar Manutenção</p>
</div>-->
<div class="col-4">

	<a href="" class="icon text-shadow-l icon-xxl rounded-xl gradient-Blue"><i
		class="fas fa-file text-shadow-l font-30"></i></a>
		<p class="men">Relatorio do Carro</p>
	</div>
	<div class="col-4">

		<a href="login" class="icon text-shadow-l icon-xxl rounded-xl gradient-red1"><i
			class="fas  fa-user-shield text-shadow-l font-30"></i></a>
			<p class="men">Administrador</p>
		</div>


		@php
		$chamado = App\chamado::where('equipamento_id', $equipamento_id)
		->where('status', 'a')
		->count();
		
		$hasEquipId = filter_input(INPUT_GET, "id");
		if (!$hasEquipId) {
			echo "
			<script>
			window.onload = () => {
				setInterval(() => {
					var sms = document.getElementById('sms');

					if (sms.textContent.length > 0) {
						sms.innerHTML = '<br>';

					} else {
						sms.innerHTML = 'Por favor, efetue a leitura de um QRCode<br>';
						// alert('Nao vazio');

					}
				}, 700);
			}
			var fzcmd = document.getElementById('finalizarChamado');
			//    var abcmd = document.getElementById('abrirChamado');
			// fzcmd.style.opacity = '.5';
			//    abcmd.style.opacity = '.5';
			// fzcmd.style.pointerEvents = 'none';
			//    abcmd.style.pointerEvents = 'none';
			</script>
			";
		}
		@endphp


		@endsection
