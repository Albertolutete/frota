
@extends('layouts.master')

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Funções </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Funções</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<section class="content">
	<div class="row">
        <div class="col-3">
        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-xl">
                  Adicionar Função
        </button>
</div>
      
	
	</div>
    <br><br>
	<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Funções</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" >
                    <form method="post" name="frmEquipamento" action ="">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-3"></div>
                        <div class="col-md-10">
                           <input type="text" name="parametro" class="form-control float-right" placeholder="Equipamento">
                        </div>

                        <div class="col-md-1">
                          <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                          </button>
                        </div>
                 </form>
                 <br><br>
                </div>
</div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                        <th>Descrição</th>
                        <th>Data criação</th>
                        <th>Opções</th>
                    </tr>
                  </thead>
                  <tbody>

                  @foreach($funcoes as $funcao)
                    <tr>
                        <td>{{$funcao->descricao}}</td>
                        <td>{{$funcao->created_at}}</td>
                        <td><a href="{{route('previlegio.listar',base64_encode($funcao->id))}}" class="btn btn-primary">Ver Previlégis</a></td>
                       
                    </tr>
                    <!-- fim modal componente --> 
                   @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

</section>
@endsection
