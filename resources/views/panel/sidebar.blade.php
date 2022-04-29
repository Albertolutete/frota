<div class="sidebar">

    <!-- Sidebar user panel (optional) -->

    <div class="user-panel mt-3 pb-3 mb-3 d-flex">

        <!--<div class=" img-circle elevation-2" style="width:50px; height:50px; background:#fff; object-fit: cover"  >-->
          
             
            <!--<img style="height:100%; width: 100%; border-radius: inherit" src=" "  alt="User Image" > -->

        <!--</div>-->
 <div class="info">
          <a href="#" class="d-block">{{ ucwords(Auth::user()->name) }}</a>
        </div>
     

    </div>



    <!-- SidebarSearch Form -->



    <!-- Sidebar Menu -->

    <nav class="mt-2">

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <!-- Add icons to the links using the .nav-icon class

               with font-awesome or any other icon font library -->

            <li class="nav-item menu-open">

                <a href="home" class="nav-link active">

                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Painel
                    </p>

                </a>
            </li>
            <li class="nav-item menu-open">

                <a href="projeto" class="nav-link active">

                    <i class="nav-icon fas fa-archive"></i>

                    <p>

                        Documentos
                    </p>

                </a>
            </li>

            <li class="nav-header">Informações Gerais</li>


            <?php if (App\Previlegio::temPrevilegio("listar_funcoes", Auth::user()->id) && 
            App\Previlegio::temPrevilegio("listar_previlegios", Auth::user()->id)): ?>

            <li class="nav-item">

                <a href="#" class="nav-link">

                    <i class="nav-icon fas fa-chart-pie"></i>

                    <p>

                        Previlégios e Funções

                        <i class="right fas fa-angle-left"></i>

                    </p>

                </a>
                <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <a href="{{ route('usuario.listar') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Usuarios</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('funcoes.listar') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Funções</p>
                        </a>
                    </li>


                </ul>

            </li>
            <?php endif ?>

            <li class="nav-item">

                <a href="#" class="nav-link">

                    <i class="nav-icon fas fa-chart-pie"></i>

                    <p>

                        Gerais

                        <i class="right fas fa-angle-left"></i>

                    </p>

                </a>

                <ul class="nav nav-treeview">

                    <li class="nav-item">

                        <a href="Rankings" class="nav-link">

                            <i class="far fa-circle nav-icon"></i>

                            <p>Rankings</p>

                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">

                    <li class="nav-item">

                        <a href="Graficos" class="nav-link">

                            <i class="far fa-circle nav-icon"></i>

                            <p>Graficos</p>

                        </a>
                    </li>
                </ul>

            </li>

            <li class="nav-item">

                <a href="#" class="nav-link">

                    <i class="nav-icon fas fa-tools"></i>

                    <p>

                        Manutenções

                        <i class="fas fa-angle-left right"></i>

                    </p>

                </a>

                <ul class="nav nav-treeview">

                    <li class="nav-item">

                        <a href="manutencao?tipo=preventivo" class="nav-link">

                            <i class="far fa-circle nav-icon"></i>

                            <p>Preventiva</p>

                        </a>

                    </li>

                    <li class="nav-item">

                        <a href="manutencao?tipo=corretivo" class="nav-link">

                            <i class="far fa-circle nav-icon"></i>

                            <p>Corretiva</p>

                        </a>

                    </li>



                </ul>

            </li>

            <li class="nav-item">

                <a href="#" class="nav-link">

                    <i class="nav-icon fas fa-exclamation-circle"></i>

                    <p>

                        Criticidade

                        <i class="fas fa-angle-left right"></i>

                    </p>

                </a>

                <ul class="nav nav-treeview">

                    <li class="nav-item">

                        <a href="CriticoEquipamento" class="nav-link">

                            <i class="far fa-circle nav-icon"></i>

                            <p>Veiculo</p>

                        </a>

                    </li>

                    <li class="nav-item">

                        <a href="CriticoManutencao" class="nav-link">

                            <i class="far fa-circle nav-icon"></i>

                            <p>Manutencões</p>

                        </a>

                    </li>



                </ul>

            </li>

            <li class="nav-header">Administração</li>

            <li class="nav-item">

                <a href="calendario" class="nav-link">

                    <i class="nav-icon far fa-calendar-alt"></i>

                    <p>

                        Agendamento

                        <span class="badge badge-info right"></span>

                    </p>

                </a>

            </li>

            <li class="nav-item">

                <a href="#" class="nav-link">

                    <i class="nav-icon fas fa-user-cog"></i>

                    <p>

                        Gerenciar

                        <i class="fas fa-angle-left right"></i>

                    </p>

                </a>

                <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <a href="{{ route('tecnico.listar') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Tecnicos</p>
                        </a>
                    </li>

                    <li class="nav-item">

                        <a href="equipamento" class="nav-link">

                            <i class="far fa-circle nav-icon"></i>

                            <p>Frota</p>

                        </a>

                    </li>

                    <?php if (App\Previlegio::temPrevilegio("listar_empresas", Auth::user()->id)): ?>
                    <li class="nav-item">

                        <a href="Empresas" class="nav-link">

                            <i class="far fa-circle nav-icon"></i>

                            <p>Empresas</p>

                        </a>

                    </li>


                    <?php endif ?>

                </ul>

            </li>


        </ul>

    </nav>

    <!-- /.sidebar-menu -->

</div>
