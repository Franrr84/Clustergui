<!-- Extends indica que va a extender a la plantilla admin, Section que el contenido que esté en esta plantilla se colocará en donde esté @yield('contenido')-->
@extends ('layouts.admin')
@section ('contenido')
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de Máquinas <a href="/maquina/list"><button class="btn btn-success">Listado</button></a></h3>
      </div>
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
         @include('maquinas.searchgrid')
      </div>
    </div>

    @if ($operacion == "OK")
      <div class = "row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          @foreach ($maquina as $maq)
            <div class="col-lg-3 col-sm-6 portfolio-item" >
              <div class="card h-100"> 
                @if ($maq->estado != "On")
                  @if ($maq->tipo == "Datastores")
                    <a href="/maquina/itemgrid/{{$maq->id}}"><img class="card-img-top" src="{{asset('img/picdataerr.png')}}"></a>
                  @else
                    <a href="/maquina/itemgrid/{{$maq->id}}"><img class="card-img-top" src="{{asset('img/picmetaerr.png')}}"></a>
                  @endif

                @else
                  @if ($maq->tipo == "Datastores")
                    @if($maquinas->getEstadoComponentes($maq->id-1,$componentes) == "TRUE")
                      <a href="/maquina/itemgrid/{{$maq->id}}"><img class="card-img-top" src="{{asset('img/picdataok.png')}}"></a>
                    @else
                      <a href="/maquina/itemgrid/{{$maq->id}}"><img class="card-img-top" src="{{asset('img/picdatawar.png')}}"></a>
                    @endif
                  @else
                    @if($maquinas->getEstadoComponentes($maq->id-1,$componentes) == "TRUE")
                      <a href="/maquina/itemgrid/{{$maq->id}}"><img class="card-img-top" src="{{asset('img/picmetaok.png')}}"></a>
                    @else
                      <a href="/maquina/itemgrid/{{$maq->id}}"><img class="card-img-top" src="{{asset('img/picmetawar.png')}}"></a>
                    @endif
                  @endif
                @endif
                
                <div class="card-body">
                  <h4 class="card-title">{{$maq->nombre}}</h4>
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


