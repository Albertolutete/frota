<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <!--<li class="nav-item">-->
        <!--    <a class="nav-link" data-widget="navbar-search" href="#" role="button">-->
        <!--        <i class="fas fa-search"></i>-->
        <!--    </a>-->
            <!--<div class="navbar-search-block">-->
            <!--    <form class="form-inline">-->
            <!--      @csrf-->
            <!--        <div class="input-group input-group-sm">-->
            <!--            <input class="form-control form-control-navbar" type="search" placeholder="Search"-->
            <!--                aria-label="Search">-->
            <!--            <div class="input-group-append">-->
            <!--                <button class="btn btn-navbar" type="submit">-->
            <!--                    <i class="fas fa-search"></i>-->
            <!--                </button>-->
            <!--                <button class="btn btn-navbar" type="button" data-widget="navbar-search">-->
            <!--                    <i class="fas fa-times"></i>-->
            <!--                </button>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </form>-->
                     
            <!--</div>-->
        <!--</li>-->

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          
    
     <label class="nav-link" data-toggle="dropdown"> {{ ucwords(Auth::user()->email) }}</label>
   
         </li>

        <!-- Notifications Dropdown Menu -->

      
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>

            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                <?php if (App\Previlegio::temPrevilegio("cadastrar_usuario", Auth::user()->id)): ?>
                    <div class="dropdown-divider"></div>
                    <a href="CadastrarUsuario" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> Adicionar Usuario
                        <span class="float-right text-muted text-sm"></span>
                    </a>
                <?php endif ?>
                <div class="dropdown-divider"></div>
                
                <a href="{{ Route('editarSenha') }}" class="dropdown-item">
                  <i class="fas fa-edit mr-2"></i> Editar Perfil
                  <span class="float-right text-muted text-sm"></span>
              </a>
              <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">

                    <i class="fas fa-sign-out-alt m2"> </i> {{ __('Sair') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <!--<li class="nav-item">-->
        <!--    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">-->
        <!--        <i class="fas fa-th-large"></i>-->
        <!--    </a>-->
        <!--</li>-->
    </ul>
</nav>
