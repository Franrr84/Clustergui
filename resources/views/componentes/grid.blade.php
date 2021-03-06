<!-- CONTENIDO: VISTA DE COMPONENTES EN FORMATO CUADRICULA -->

@extends ('layouts.admin')
@section ('contenido')
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de Componentes <a href="/componente/list"><button class="btn btn-primary">Listado</button></a></h3>
      </div>
      <!-- BARRA BUSCAR-->
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        @include('componentes.searchgrid')
      </div>
    </div>

    @if ($operacion == "OK") <!-- OK: si se ha encontrado y leido el fichero de maquinas-->
      <div class = "row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          @foreach ($componente as $com)
            <div class="col-lg-3 col-sm-6 portfolio-item" >
              <div class="card h-100">
                <!-- COMPONENTE APAGADO -->
                @if ($com->estado != "On")
                  <a href="#"><img class="card-img-top" src="{{asset('img/piccomperr.png')}}"></a>
                <!-- COMPONENTE ENCENDIDO -->
                @else
                  <a href="#"><img class="card-img-top" src="{{asset('img/piccompok.png')}}"></a>
                @endif
                <div class="card-body">
                  <h4 class="card-title">{{$com->nombre}}</h4>
                  @if ($maquinas->getOrigenId($com->origen) != -1)
                    <p class="card-text"><a href="/maquina/itemgrid/{{$maquinas->getOrigenId($com->origen)}}">{{$com->origen}}</a><p>
                  @else
                    <p class="card-text">{{$com->origen}}<p>
                  @endif
                  @if ($com->estado != "On")
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <a href="/componente/componentegridturnon/{{$com->id}}"><button class="btn btn-default btn-block">Encender</button></a>
                    </div>
                  @else
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <a href="/componente/componentegridturnoff/{{$com->id}}"><button class="btn btn-default btn-block">Apagar</button></a>
                    </div>
                  @endif
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
      {{$componente->render()}}
      
    @elseif ($operacion == "ERRORCHECKCLUSTER")
      <h4>Error al cargar los componentes: no se ha encontrado el fichero 'checkcluster.out'</h4>
    @elseif ($operacion == "ERRORINVENTORY")
      <h4>Error al cargar los componentes: no se ha encontrado el fichero 'inventory'</h4>
    @endif
  </div>
</div>

@endsection
