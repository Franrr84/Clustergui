<!-- CONTENIDO: VISTA DE UNA MAQUINA Y SUS COMPONENTES EN FORMATO CUADRICULA -->
@extends ('layouts.admin')
@section ('contenido')
<div class="container">
    <div class="row" style="margin-bottom: 20px;">
      <div class="col-lg-12 col-md-8 col-sm-8 col-xs-12">
        <h3>{{$maquina->nombre}} <a href="/maquina/itemlist/{{$maquina->id}}"><button class="btn btn-success">Listado</button></a>
        	<a href="/maquina/grid"><button class="btn btn-danger">Volver</button></a></h3>
      </div>
    </div>

 	<div class = "row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        	@foreach ($componentes as $com)
        		<div class="col-lg-3 col-sm-6 portfolio-item" >
              <div class="card h-100">
                @if ($com->estado != "On")
                  <img class="card-img-top" src="{{asset('img/piccomperr.png')}}">
                @else
                  <img class="card-img-top" src="{{asset('img/piccompok.png')}}">
                @endif
                <div class="card-body">
                  <h4 class="card-title">{{$com->nombre}}</h4>
                </div>
              </div>
            </div>
        	@endforeach
        </div>
    </div>
    
</div>
@endsection