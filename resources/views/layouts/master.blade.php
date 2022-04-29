<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
    <!-- bootstrap atual -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="styles/estilos.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admTL/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admTL/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admTL/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- All min fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href=" https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admTL/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('admTL/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('admTL/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('admTL/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admTL/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admTL/dist/css/min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('admTL/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('admTL/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('admTL/plugins/summernote/summernote-bs4.min.css') }}">
    
   
     <!--script do calendario-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    
    <!--<script src='scripts/fullcalendar.js'></script>-->
    <script src="scripts/pt-br.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    

    
    <!-- Popover status -->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>-->
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />-->

 <!-- Start of Async Drift Code -->
<!--<script>-->
<!--"use strict";-->

<!--!function() {-->
<!--  var t = window.driftt = window.drift = window.driftt || [];-->
<!--  if (!t.init) {-->
<!--    if (t.invoked) return void (window.console && console.error && console.error("Drift snippet included twice."));-->
<!--    t.invoked = !0, t.methods = [ "identify", "config", "track", "reset", "debug", "show", "ping", "page", "hide", "off", "on" ], -->
<!--    t.factory = function(e) {-->
<!--      return function() {-->
<!--        var n = Array.prototype.slice.call(arguments);-->
<!--        return n.unshift(e), t.push(n), t;-->
<!--      };-->
<!--    }, t.methods.forEach(function(e) {-->
<!--      t[e] = t.factory(e);-->
<!--    }), t.load = function(t) {-->
<!--      var e = 3e5, n = Math.ceil(new Date() / e) * e, o = document.createElement("script");-->
<!--      o.type = "text/javascript", o.async = !0, o.crossorigin = "anonymous", o.src = "https://js.driftt.com/include/" + n + "/" + t + ".js";-->
<!--      var i = document.getElementsByTagName("script")[0];-->
<!--      i.parentNode.insertBefore(o, i);-->
<!--    };-->
<!--  }-->
<!--}();-->
<!--drift.SNIPPET_VERSION = '0.3.1';-->
<!--drift.load('efepniim7kar');-->
<!--</script>-->
<!-- End of Async Drift Code -->
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    
    
        <!-- Preloader -->
        <!--<div class="preloader flex-column justify-content-center align-items-center">-->
            <!-- <img class="animation__shake" src="" alt="SIM ELEVADORES" height="60" width="60"> -->
        <!--    <h1>SIM ELEVADORES</h1>-->
        <!--</div>-->

        <!-- Navbar -->
        @include('panel.header')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <!--<a href="index3.html" class="brand-link">-->
                <!-- <img src="{{ 'admTL/dist/img/AdminLTELogo.png' }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
            <!--    <span class="brand-text font-weight-light">SIM ELEVADOR</span>-->
            <!--</a>-->

            <!-- Sidebar -->
            @include('panel.sidebar')
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->

        <div class="content-wrapper">

            <!-- Content Header (Page header) -->

            @yield('content')
            <!--<div style="  position:obsolute ; margin-left:850px; "><iframe width="350" height="430" style=" border-radius: 10px 5% / 20px 30px;" allow="microphone;" src="https://console.dialogflow.com/api-client/demo/embedded/4aba6f90-e719-43b6-9b3e-681383001e65"></iframe></div>-->            
            
        </div>
        <!-- /.content-wrapper -->
        @include('panel.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- Agenda-->
     <!--<script src="{{ asset('scripts/agenda.js') }}"></script>-->
     <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>-->
      
    <!-- ./wrapper -->
    @include('panel.javascript')
</body>

</html>
