
@extends('layouts.master')

{{-- @extends('layouts.app') --}}

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Usuários</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Usuários</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<section class="content">
	<div class="row">
        <div class="col-3">
        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-xl">
                  Adicionar Usuário
        </button>
</div>
      
	
	</div>
    <br><br>
	<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Usuário</h3>

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
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Data Registo</th>
                        <th>Opções</th>
                    </tr>
                  </thead>
                  <tbody>

                  @foreach($users as $user)
                    <tr>
                       <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->created_at}}</td>
                        <td><a href="{{route('usuario.funcoes',base64_encode($user->id))}}" class="btn btn-primary">Ver Funções</a></td>
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
