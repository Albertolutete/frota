@extends('layouts.main')

@section('title', 'Pagina Inicial')

@section('content')


<?php
//pegar o id proveniente do qrCode
$equipamento_id = trim(filter_input(INPUT_GET, 'id'));
if (!empty($equipamento_id)):
	$equipamento_id = base64_decode($equipamento_id);
	$equipamento = App\Equipamento::find($equipamento_id);
else:
	header("location:/Elevador?sms=nok");
	exit();
endif;

// $equipamento_id = 1;
$equipamento_nome = $equipamento->nome ;

?>
{{-- <h1>{{ $equipamento_id }}</h1> --}}
<div class="col-4">

	<?php $parametros = [base64_encode($equipamento_id), 'corretivo']; ?>
	<a href="{{ route('tecnico.apresentar', $parametros) }}"
	class="icon text-shadow-l icon-xxl rounded-xl gradient-blue1"><i
	class="fas fa-tools text-shadow-l font-30"></i></a>
	<p class="men">Corretivo</p>
</div>
<div class="col-4">
	<?php $parametros = [base64_encode($equipamento_id), 'preventivo']; ?>
	<a href="{{ route('tecnico.apresentar', $parametros) }}"
	class="icon text-shadow-l icon-xxl rounded-xl gradient-blue1"><i
	class="fas fa-tools text-shadow-l font-30"></i></a>
	<p class="men">Preventivo</p>
</div>
<!-- <div class="col-4">-->

<!--    <a href=""-->
<!--        class="icon text-shadow-l icon-xxl rounded-xl gradient-blue1"><i-->
<!--            class="fas fa-tools text-shadow-l font-30"></i></a>-->
<!--    <p class="men">Plataforma Hidraulica de doca</p>-->
<!--</div>-->
<!-- <div class="col-4">-->

<!--    <a href=""-->
<!--        class="icon text-shadow-l icon-xxl rounded-xl gradient-blue1"><i-->
<!--            class="fas fa-tools text-shadow-l font-30"></i></a>-->
<!--    <p class="men">Escada rolante</p>-->
<!--</div>-->
<!--     <div class="col-4">-->

<!--    <a href=""-->
<!--        class="icon text-shadow-l icon-xxl rounded-xl gradient-blue1"><i-->
<!--            class="fas fa-tools text-shadow-l font-30"></i></a>-->
<!--    <p class="men">Esteira rolante</p>-->
<!--</div>-->
<!--<div class="col-4">-->

<!--    <a href=""-->
<!--        class="icon text-shadow-l icon-xxl rounded-xl gradient-blue1"><i-->
<!--            class="fas fa-tools text-shadow-l font-30"></i></a>-->
<!--    <p class="men">Plataforma Manual de doca</p>-->
<!--</div>-->


<div class="col-4">
	<a href="/SIM_Frota" class="icon text-shadow-l icon-xxl rounded-xl gradient-cyan1"><i
		class="fas fa-arrow-left text-shadow-l font-30"></i></a>
		<p class="men">Voltar</p>
	</div>
	@endsection
