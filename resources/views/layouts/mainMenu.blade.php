<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIGRET-go</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="/menus/bootstrap/css/bootstrap.css">
  
  <!-- PAra mensajes con Toastr -->
  <link rel="stylesheet" href="/menus/bootstrap/css/toastr.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="/menus/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="/menus/css/skins/skin-blue.min.css">

  

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini"> 
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="{{ route ('home') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>GO</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>{{ Auth::user()->user_empresa->empresa->name }}</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li role="presentation" >
            <a href="{{ asset('/ayuda.pdf')}}" >
                <i class="glyphicon glyphicon-question-sign" title="AYUDA"></i> 
            </a>
          </li>
          <!-- User Account Menu -->
          <li class="dropdown user user-menu" title="HERRAMIENTAS">
            <!-- Usuario logeado con su imagen  -->
            <a href="#" class="dropdown-toggle" data-toggle="control-sidebar">{{ Auth::user()->user }} ||
              <!-- The user image in the navbar-->

              <img width="100px" src="{{ Storage::url (Auth::user()->foto) }}" class="user-image " alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs fa fa-gears"></span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="">
          <!-- Poner el Logo de la Empresa -->
        
          <img width="300px" src="{{ Storage::url (Auth::user()->user_empresa->empresa->logo) }}" class="center-block img-responsive img-rounded" alt="Responsive image">
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">Utilidades</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="{{ route ('home') }}"><i class="glyphicon glyphicon-home"></i> <span>Inicio</span></a></li>
        @if (Auth::user()->rol() == 6)
        <!-- Menu Auditorias solo auditor -->
        <li class="treeview">
          <a href="#"><i class="glyphicon glyphicon-indent-left"></i> <span>Auditorias</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{ route ('auditoria.empresa') }}">
              <i class="glyphicon glyphicon-book"></i> <span>en Empresa</span></a>
            </li>
            <li class="active"><a href="{{ route ('auditoria.index') }}">
              <i class="glyphicon glyphicon-book"></i> <span>en Movimientos</span></a>
            </li>          
          </ul>
        </li>
        @endif
        @if (Auth::user()->rol() < 3)
        <!-- Menu Reportes solo admin y employ -->
        <li class="treeview">
          <a href="#"><i class="glyphicon glyphicon-list-alt"></i> <span>Reportes</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{ route ('informe.crcf') }}">
              <i class="glyphicon glyphicon-eye-open"></i> 
              <span>Reservas por Canchas</span></a>
            </li>
            <li class="active"><a href="{{ route ('informe.cruf') }}">
              <i class="glyphicon glyphicon-eye-open"></i> 
              <span>Reservas por Usuario</span></a>
            </li>
            <li class="active"><a href="{{ route ('informe.crdf') }}">
              <i class="glyphicon glyphicon-eye-open"></i> 
              <span>Reservas por Dias</span></a>
            </li> 
            <li class="active"><a href="{{ route ('informe.crhf') }}">
              <i class="glyphicon glyphicon-eye-open"></i> 
              <span>Reservas por Horas</span></a>
            </li>
            <li class="active"><a href="{{ route ('informe.crhcf') }}">
              <i class="glyphicon glyphicon-eye-open"></i> 
              <span>Reservas por Horas/Canchas</span></a>
            </li>
            <li class="active"><a href="{{ route ('informe.cso') }}">
              <i class="glyphicon glyphicon-eye-open"></i> 
              <span>Servicios Contratados</span></a>
            </li>                    
          </ul>
        </li>
        @endif
        @if (Auth::user()->rol() < 6)
        <!-- Menu Reservas -->
        <li class="treeview">
          <a href="#"><i class="glyphicon glyphicon-list-alt"></i> <span>Reservas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active">
              <a href="{{ route ('reserva.create') }}"><i class="glyphicon glyphicon-pencil"></i> <span>Nueva Reserva</span></a>
            </li>
            <li class="active">
              <a href="{{ route ('reserva.misReservas') }}"><i class="glyphicon glyphicon-calendar"></i> <span>Mis Reservas</span></a>
            </li>
            @if (Auth::user()->rol() < 4)
              <li class="active">
                <a href="{{ route ('reserva.consultarReservas') }}"><i class="glyphicon glyphicon-search"></i><span>Consultar Reservas</span></a>
              </li>
            @endif
          </ul>
        </li>

        <!-- Menu Juegos -->
        <li class="treeview">
          <a href="#"><i class="glyphicon glyphicon-play"></i> <span>Juegos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active">
              <a href="{{ route ('jugadores.getJuegos') }}"><i class="glyphicon glyphicon-calendar"></i> <span>Mis Juegos</span></a>
            </li>
          </ul>
        </li>
        
        <!-- Menu Ranking -->
        <li class="treeview">
          <a href="#"><i class="glyphicon glyphicon-th-list"></i> <span>Ranking</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">            
            <li class="active"><a href="{{ route ('ranking.index') }}"><i class="glyphicon glyphicon-eye-open"></i>
              <span>Ver Ranking</span></a></li>
          </ul>
        </li>
        
        <!-- Menu Torneos -->
        <li class="treeview">
          <a href="#"><i class="glyphicon glyphicon-text-size"></i> <span>Torneos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">            
            <li class="active"><a href="{{ route('inscripciones.create') }}"><i class="glyphicon glyphicon-text-width"></i>
              <span>Mis Torneos</span></a></li>
            <li class="active"><a href="{{ route('torneo.index') }}"><i class="glyphicon glyphicon-superscript"></i> 
              <span>Torneos Abiertos</span></a></li>
            <li class="active"><a href="{{ route('torneo.finalizados') }}"><i class="glyphicon glyphicon-subscript"></i> 
              <span>Torneos Finalizados</span></a></li>
          @if (Auth::user()->rol() < 4)
            <li class="active"><a href="{{ route('torneo.create') }}"><i class="glyphicon glyphicon-pencil"></i> 
                <span>Crear Nuevo Torneo</span></a></li>
          </ul>
          @endif
        </li>
        @endif
        <!-- Menu Usuario -->
        @if (Auth::user()->rol() < 4)
        <li class="treeview">
          <a href="#"><i class="glyphicon glyphicon-user"></i> <span>Usuarios</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{ route ('users.create') }}"><i class="glyphicon glyphicon-pencil"></i> 
              <span>Nuevo Usuario</span></a></li>
            <li class="active"><a href=" {{route('users.index')}} "><i class="glyphicon glyphicon-search"></i> 
              <span>Consultar Usuarios</span></a></li>
          </ul>
        </li> 
        @endif 

        @if (Auth::user()->rol() < 3)
        <!-- Menu Canchas solo admin -->
        <li class="treeview">
          <a href="#"><i class="glyphicon glyphicon-th"></i> <span>Canchas</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
          </a>
          <ul class="treeview-menu">
            @if (Auth::user()->rol() == 1)
            <li class="active"><a href="{{ route('cancha.create')}}"><i class="glyphicon glyphicon-pencil"></i> 
              <span>Nueva Cancha</span></a></li>
            @endif
            <li class="active"><a href="{{ route('cancha.addService')}}"><i class="glyphicon glyphicon-plus"></i> 
              <span>Asociar Servicios</span></a></li>
            <li class="active"><a href="{{ route('cancha.index')}}"><i class="glyphicon glyphicon-search"></i> 
              <span>Consultar Canchas</span></a></li>
          </ul>
        </li>
        
        
        <!-- Menu Servicios solo admin -->
        <li class="treeview">
          <a href="#"><i class="glyphicon glyphicon-th"></i> <span>Servicios</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{ route('servicio.create')}}"><i class="glyphicon glyphicon-pencil"></i> 
              <span>Nuevo Servicio</span></a></li>
            <li class="active"><a href="{{ route('servicio.index')}}"><i class="glyphicon glyphicon-search"></i> 
              <span>Consultar Servicios</span></a></li>
          </ul>
        </li>
       
  
        <!-- Menu Localidades solo admin y employ -->
        <li class="treeview">
          <a href="#"><i class="glyphicon glyphicon-th"></i> <span>Localidades</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href=" {{ route ('main.indexLocalidades') }} "><i class="glyphicon glyphicon-search"></i> 
              <span>Consultar Localidades</span></a></li>              
            <li class="active"><a href="{{ route ('main.createCiudad') }}"><i class="glyphicon glyphicon-pencil"></i> 
              <span>Nueva Ciudad</span></a></li>
            <li class="active"><a href="{{ route ('main.createProvincia' ) }}"><i class="glyphicon glyphicon-pencil"></i> 
              <span>Nueva Provincia</span></a></li>
            <li class="active"><a href=" {{ route ('main.createPais') }} "><i class="glyphicon glyphicon-pencil"></i> 
              <span>Nuevo Pais</span></a></li>
          </ul>
        </li>
      </ul>
      @endif
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header text-center">
       
    </section>

    <!-- Main content -->
    <section class="content">

      @yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-4 text-rigth">
        <!-- Default to the left -->
        <strong>Copyright &copy; 2018 </strong> 
      </div>
      <div class="col-xs-12 col-sm-12 col-md-4 text-center">
        <div class="text-center">
          Si.G.Re.T "Sistema de Gestion de Reservas y Torneos - GO"
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-4 text-left">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          <span class="fa fa-facebook"></span><a href="https://www.facebook.com/Gono.Go.On">Jose Ariel Perezlindo</a>.
        </div>
      </div>
    </div>
    
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-light">
    <!-- Create the tabs -->

    <!-- Tab panes -->
    <div class="tab-content">
    @if (Auth::user()->rol() == 1)
      <ul class="nav nav-pills nav-stacked">
        <li class="presentation"><a href="{{ route('empresa.edit', Auth::user()->user_empresa->empresa_id) }}">
          <i class="glyphicon glyphicon-edit"></i> 
          <span>Editar Empresa</span></a>
        </li>
        <li class="presentation"><a href="{{ route('empresa.turnos.index') }}">
          <i class="glyphicon glyphicon-edit"></i> 
          <span>Turnos</span></a>
        </li>
      </ul>
    @endif  
      <hr/>
        <ul class="nav nav-pills nav-stacked">
          <li role="presentation" >
            <a href="{{route('users.editProfile', Auth::user()->id)}}" >
                <i class="glyphicon glyphicon-edit"></i> 
                <span>Editar  Mi Perfil</span>
            </a>
          </li>
          @if (Auth::user()->rol() < 6)
          <hr>
          <li role="presentation" >
            <a href="{{ route('equipo.index') }}" >
                <i class="glyphicon glyphicon-edit"></i> 
                <span>Equipos</span>
            </a>
          </li>
          <li role="presentation" >
            <a href="{{ route('miequipo.show', Auth::user()->user_empresa->id ) }}" >
                <i class="glyphicon glyphicon-edit"></i> 
                <span>Mi Equipo</span>
            </a>
          </li>
          <li role="presentation" >
            <a href="{{ route('equipo.create') }}" >
                <i class="glyphicon glyphicon-edit"></i> 
                <span>Crear Mi Equipo</span>
            </a>
          </li>
          @endif
          <hr/>
          <li role="presentation" >
            <a href="{{ route('users.editPass') }}" >
                <i class="glyphicon glyphicon-rub"></i> 
                <span>Cambiar Contraseña</span>
            </a>
          </li>
          <li role="presentation" class="">
            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
              <i class="glyphicon glyphicon-off"></i> <span>Despedirse</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
          </li>
        </ul>
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
  <!-- ./wrapper -->

  <!-- REQUIRED JS SCRIPTS -->
  <script src="{{ asset('/js/jquery-3-3-1.js')}}"></script>
  <!-- jQuery 2.2.3 <script src="/menus/plugins/jQuery/jquery-2.2.3.min.js"></script> -->
  
  <!-- Bootstrap 3.3.6 -->
  <script src="{{ asset('/menus/bootstrap/js/bootstrap.js')}}"></script>
  <!-- Para mesajes toastr -->
  <script src="{{ asset('/js/toastr.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset ('/menus/js/app.min.js') }}"></script>
  <!-- Para la eliminacion por enlace con confirmacion -->
  <script src="{{ asset('/js/laravel.js') }}"></script>

  <script src="{{ asset('js/vue.js')}}"></script>
  <script src="{{ asset('js/axios.js')}}"></script>
  <script src="{{ asset('js/myCodVue.js')}}"></script>
  @include('layouts.toastr')
  @include('layouts.validaciones')
</body>
</html>