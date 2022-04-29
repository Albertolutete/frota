
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
              <li class="breadcrumb-item active">Previlégios</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<section class="content">
	<div class="row">
        <div class="col-3">
        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-xl">
                  Adicionar Previlégios
        </button>
</div>
      
	
	</div>
    <br><br>
	<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Previlégios</h3>

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

                  @foreach ($funcao->previlegios as $previlegio)
                    <tr>
                       
                        <td>{{str_replace("_"," ",$previlegio->descricao)}}</td>
                        <td>{{$previlegio->created_at}}</td>
                        <td>
                            <?php $array = array(base64_encode($previlegio->id), base64_encode($funcao->id));?>
                            <a class="dropdown-item" href="{{route('previlegio.remover',$array)}}">Remover Previlégio</a> </td>
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





