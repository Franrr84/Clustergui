
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
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{asset('img/favicons.ico')}}">
    <link rel="stylesheet" href="{{asset('css/leanxcale.css')}}">
  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        
        <!-- LOGO -->
        <a href="/" class="logo">
          <!--<img src="{{asset('img/logoleanxcale2.png')}}" class="img-responsive" alt="Responsive image" style="margin-top: 7%">-->
          <img src="{{asset('img/logoleanxcale2.png')}}" class="img-responsive" alt="Responsive image">
        </a>

        <!-- BARRA SUPERIOR (ENCIMA DE CONTENIDO) -->
        <nav class="navbar navbar-static-top" role="navigation">
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
        </nav>
      </header>

      <!-- BARRA LATERAL -->
      <aside class="main-sidebar">
        <section class="sidebar">
          <ul class="sidebar-menu">
            <li class="header"></li>

              <!-- VISTAS -->
              <!--<li class="treeview">
                <a href="#">
                  <i class="fa fa-laptop"></i>
                    <span>Vistas</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="/maquina/grid"><i class="fa fa-circle-o"></i> Máquinas</a></li>
                  <li><a href="/componente/grid"><i class="fa fa-circle-o"></i> Componentes</a></li>
                </ul>
              </li>-->

              <li><a href="/"><i class="fa fa-circle-o"></i><span>Inicio</span></a></li>
              <li><a href="/maquina/grid"><i class="fa fa-circle-o"></i><span>Máquinas</span></a></li>
              <li><a href="/componente/grid"><i class="fa fa-circle-o"></i><span>Componentes</span></a></li>

              <!-- CONFIGURACION -->
              <!--<li>
                <a href="#">
                  <i class="fa fa-cog"></i> <span>Configuración</span>
                </a>
              </li>-->            
          </ul>
        </section>
      </aside>

       <!-- CONTENIDO -->
      <div class="content-wrapper">    
        <section class="content">    
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-body">
                  <div class="row">
	                  <div class="col-md-12" id="cont">

		                  <!--Contenido: el contenido dinámico está en esta parte-->
                       @yield('contenido')
		                  <!--Fin Contenido-->

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

      <!-- FOOTER -->

      <!--<footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2015-2018 <a href="www.leanxcale.com">Leanxcale</a>.</strong> All rights reserved.
      </footer>-->

    <!-- jQuery 2.1.4 -->
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>

    <!--
        ACTUALIZADOR DE PANTALLA
        - Cada 5 segundos
        - Reinicia el contado si se pulsa una tecla para evitar refresco mientras se escribe
    -->
    <script>
      var tecladoParado = null;
      var milisegundosLimite = 5000;

      $(document).on('keypress', function() {
        clearTimeout(tecladoParado);

        tecladoParado = setTimeout(function() {
          $( "#cont" ).load( " #cont" );
        }, milisegundosLimite);
      });
    </script>
  </body>
</html>
