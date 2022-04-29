@extends('layouts.master')

@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1></h1>
			</div>



			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Gráfico</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->

	@if (session('msg'))
	<h1>{{ session('msg') }}</h1>

	@endif
</section>
<section class="content">
	<div class="row">


		<!-- /.card-header -->

		<!-- /.card-header -->


		<div class="row">

			<div class="col-2">
				<label>De</label>
				<input class="form-control" name="data_inicio" type="date" value="<?php echo date('Y-m-d', strtotime('-1 day')); ?>"
				max="<?php echo date('Y-m-d', strtotime('-2 day')); ?>" min="<?php echo date('Y-m-d', strtotime('-365 day')); ?>">
			</div>
			<div class="col-2">
				<label>Até</label>
				<input class="form-control" name="data_fim" type="date" value="<?php echo date('Y-m-d', strtotime('-7 days')); ?>"
				max="<?php echo date('Y-m-d', strtotime('-1 day')); ?>" min="<?php echo date('Y-m-d', strtotime('-365 day')); ?>">
			</div>
			<div class="col-2">

				<label>Tipo</label>
				<select class="form-select" name="tipo">

					<option value="manutencao"> Abertos </option>
					<option value="morador_manutencao">Em espera </option>
					<option value="reforma"> Finalizado </option>
				</select>
			</div>
			<br><br>
			<div class="col-2">
				<br>
				<input type="submit" class="btn btn-outline-primary" value="Visualizar">
			</div>
		</div>

		<section class="section main-section">

		</br>
	</br>
	<div class="card mb-6">
		<header class="card-header">
			<p class="card-header-title">
				<span class="icon"><i class="mdi mdi-finance"></i></span>
				Gráfico Informativo
			</p>
			<a href="#" class="card-header-icon">
				<span class="icon"><i class="mdi mdi-reload"></i></span>
			</a>
		</header>
		<div class="card-content">
			<div class="chart-area">
				<div class="h-full">
					<div class="chartjs-size-monitor">
						<div class="chartjs-size-monitor-expand">
							<div></div>
						</div>
						<div class="chartjs-size-monitor-shrink">
							<div></div>
						</div>
					</div>
					<canvas id="big-line-chart" width="2992" height="1000" class="chartjs-render-monitor block"
					style="height: 400px; width: 1197px;"></canvas>
				</div>
			</div>
		</div>
	</div>
	<br>
</section>
<br><br>

</section>

@endsection
