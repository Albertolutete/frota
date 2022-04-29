<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>

</head>
<body>
	@php
	$equipamento_id = base64_decode(filter_input(INPUT_GET, "id"));
	$chamado = App\chamado::where("equipamento_id",  $equipamento_id )->get()->last();

	@endphp

	<section class="content">

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h1 class="card-title">Informações do chamado</h1>
					</div>


					<!-- /.card-header -->
					<div class="card-body table-responsive p-0" style="height: 300px;">
						<table class="table table-striped table-bordered text-nowrap">

							<thead>
								
								<tr>

									<th>Equipamento</th>
									<th>Responsável</th>
									<th>Empresa</th>
									<th>Cargo</th>
									<th>Tipo de chamado</th>
									<th>Telefone</th>
									<th>Motivo</th>
									<th>Foto</th>
									<th>Detalhes</th>
									<th>Opções</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>{{ $chamado->equipamento->nome }}</td>
									<td>{{ $chamado->nome }}</td>
									<td>{{ $chamado->empresa_id }}</td>
									<td>{{ $chamado->cargo }}</td>
									<td><?php if($chamado->tipo =="p"): echo "Preventivo";else: echo "Corretivo";endif;?>
									</td>
									<td>{{ $chamado->cargo }}</td>
									<td>{{ $chamado->motivo }}</td>
									<td>Foto</td>
									<td>{{ $chamado->detalhes }}</td>
								</tr>
							</tbody>

						</table>
						<br><br>
						<a href="https://www.gruposipar.com/Elevador" style="padding:10px; background-color:yellow; margin-top:20px;">Efectuar Login</a>
					</div>


					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>
		</div>

	</section>


</body>
</html>
