<!-- Extends indica que va a extender a la plantilla admin, Section que el contenido que esté en esta plantilla se colocará en donde esté @yield('contenido')-->
@extends ('layouts.admin')
@section ('contenido')
<div class="container">
<div class="row">
      <div class="col-lg-12 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de Máquinas <a href="/maquina/grid"><button class="btn btn-success">Vista elementos</button></a></h3>
      </div>
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
         @include('maquinas.searchgrid')
      </div>
    </div>

<div class = "row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		@if ($operacion == "OK")
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<!--<th>Id</th>-->
						<th>Nombre</th>
						<th>Tipo</th>
						<th>Estado</th>
					</thead>
					<!--Implementamos bucle que carge los valores de la tabla, los valores están almacenados en $maquina que es enviada por el Controlador-->
					<tbody>
						@foreach ($maquina as $maq)
						<tr>
							<!--<td>{{$maq->id}}</td>-->
							<td><a href="/maquina/itemlist/{{$maq->id}}">{{$maq->nombre}}</a></td>
							<td>{{$maq->tipo}}</td>
							@if($maq->estado == "Off")
								<td style="color: red">{{$maq->estado}}</td>
							@else
								<td style="color: green">{{$maq->estado}}</td>
							@endif
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<!--El metodo render nos permite paginar-->
			{{$maquina->render()}}

		@elseif ($operacion == "ERRORCHECKCLUSTER")
			<h4>Error de inicio: no se ha encontrado el fichero 'checkcluster.out'</h4>
		@elseif ($operacion == "ERRORINVENTORY")
			<h4>Error de inicio: no se ha encontrado el fichero 'inventory'</h4>
		@endif
	</div>
</div>
</div>

@endsection