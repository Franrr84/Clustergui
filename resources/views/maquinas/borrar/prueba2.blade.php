<!-- Extends indica que va a extender a la plantilla admin, Section que el contenido que esté en esta plantilla se colocará en donde esté @yield('contenido')-->
@extends ('layouts.admin')
@section ('contenido')
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de Máquinas <a href="/maquina/list"><button class="btn btn-success">Listado</button></a></h3>
        @include('maquinas.search')
      </div>
    </div>

    @if ($operacion == "OK")
      <div class = "row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          @foreach ($maquina as $maq)
            <div class="col-lg-3 col-sm-6 portfolio-item" >
                
                @if ($maq->estado != "On")
                  <div class="card h-100" style="border: 2px solid #ff0000;">
                @else
                  <div class="card h-100" style="border: 2px solid #33cc33;">
                @endif
                
                
                <!--<a href="#"><img class="card-img-top" src="https://support.kickofflabs.com/wp-content/uploads/2016/06/300x150.png"></a>-->
                @if ($maq->tipo == "Datastores")
                  <a href="#"><img class="card-img-top" src="{{asset('img/picdata.png')}}"></a>
                @else
                  <a href="#"><img class="card-img-top" src="{{asset('img/picmeta.png')}}"></a>
                @endif
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="#">{{$maq->nombre}}</a>
                  </h4>
                  <!--<p class="card-text">{{$maq->tipo}}</p>-->
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
      {{$maquina->render()}}
    @elseif ($operacion == "ERRORCHECKCLUSTER")
      <h4>Error de inicio: no se ha encontrado el fichero 'checkcluster.out'</h4>
    @elseif ($operacion == "ERRORINVENTORY")
      <h4>Error de inicio: no se ha encontrado el fichero 'inventory'</h4>
    @endif
  </div>
  <!-- /.container -->
</div>

@endsection


