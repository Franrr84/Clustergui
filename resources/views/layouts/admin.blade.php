<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>LeanXcale | www.leanxcale.com</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{asset('img/favicons.ico')}}">

    <link rel="stylesheet" href="{{asset('css/leanxcale.css')}}">

    <script type="text/javascript">
      function contenido(){
        $( "#cont" ).load( " #cont" );
      }
    </script>

  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="/" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <!--<span class="logo-mini"><b>AD</b>V</span>-->
          <!-- logo for regular state and mobile devices -->
          <!--<span class="logo-lg"><b>ADVentas</b></span>-->
          <img src="{{asset('img/logoleanxcale2.png')}}" class="img-responsive" alt="Responsive image" style="margin-top: 7%">
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
        </nav>
      </header>

      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->        
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-laptop"></i>
                    <span>Vistas</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="/maquina/grid"><i class="fa fa-circle-o"></i> Máquinas</a></li>
                  <li><a href="/componente/grid"><i class="fa fa-circle-o"></i> Componentes</a></li>
                </ul>
              </li>
              <li>
                <a href="#">
                  <i class="fa fa-cog"></i> <span>Configuración</span>
                  <!--<small class="label pull-right bg-yellow">IT</small>-->
                </a>
              </li>            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

       <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">    
        <!-- Main content -->
        <section class="content">    
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-body">
                  <div class="row">
	                  <div class="col-md-12" id="cont">
		                  <!--Contenido: el contenido dinámico está en esta parte-->
                       @yield('contenido')
                       <!--<label for="contador">Contador:</label><input type="text" id="contador">-->
		                  <!--Fin Contenido-->
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->

      <!--<footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2015-2020 <a href="www.incanatoit.com">IncanatoIT</a>.</strong> All rights reserved.
      </footer>-->

    <!-- jQuery 2.1.4 -->
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>

    <body onLoad="setInterval('contenido()',10000);">
    <!--<script>
      var ratonParado = null;
      var milisegundosLimite = 5000;

      $(document).on('mousemove', function() {
        clearTimeout(ratonParado);

        ratonParado = setTimeout(function() {
        //location.reload(true);
        // aqui lanzarias la ventana
        $("#contenido").load(" #contenido");
        }, milisegundosLimite);
      });
    </script>-->
  </body>
</html>
