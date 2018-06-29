<!-- Extends indica que va a extender a la plantilla admin, Section que el contenido que esté en esta plantilla se colocará en donde esté @yield('contenido')-->
@extends ('layouts.admin')
@section ('contenido')
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de Componentes <a href="/componente/list"><button class="btn btn-success">Listado</button></a></h3>
      </div>
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        @include('componentes.searchgrid')
      </div>
    </div>

    @if ($operacion == "OK")
      <div class = "row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          @foreach ($componente as $com)
            <div class="col-lg-3 col-sm-6 portfolio-item" >
              <div class="card h-100">
                @if ($com->estado != "On")
                  <a href="#"><img class="card-img-top" src="{{asset('img/piccomperr.png')}}"></a>
                @else
                  <a href="#"><img class="card-img-top" src="{{asset('img/piccompok.png')}}"></a>
                @endif
                <div class="card-body">
                  <h4 class="card-title">{{$com->nombre}}</h4>
                  <!--<p class="card-text">{{$com->origen}}</p>-->
                  @if ($maquinas->getOrigenId($com->origen) != -1)
                    <p class="card-text"><a href="/maquina/itemgrid/{{$maquinas->getOrigenId($com->origen)}}">{{$com->origen}}</a><p>
                  @else
                    <td>{{$com->origen}}</td>
                  @endif
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
      {{$componente->render()}}
    @elseif ($operacion == "ERRORCHECKCLUSTER")
      <h4>Error de inicio: no se ha encontrado el fichero 'checkcluster.out'</h4>
    @elseif ($operacion == "ERRORINVENTORY")
      <h4>Error de inicio: no se ha encontrado el fichero 'inventory'</h4>
    @endif
  </div>
  <!-- /.container -->
</div>

@endsection
