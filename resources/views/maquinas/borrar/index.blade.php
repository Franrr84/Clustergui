<!-- Extends indica que va a extender a la plantilla admin, Section que el contenido que esté en esta plantilla se colocará en donde esté @yield('contenido')-->
@extends ('layouts.admin')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Máquinas <a href="maquinas/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('maquinas.search')
	</div>
</div>

<div class = "row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Tipo</th>
					<th>Estado</th>
					
				</thead>
				<!--Implementamos bucle que carge los valores de la tabla, los valores están almacenados en $maquina que es enviada por el Controlador-->
				<tbody>
					@foreach ($maquina as $maq)
					<tr>
						<td>{{$maq->id}}</td>
						<td>{{$maq->nombre}}</td>
						<td>{{$maq->tipo}}</td>
						<td>{{$maq->estado}}</td>
						
						<td>
							<a href="{{URL::action('MaquinaController@edit', $maq->id)}}"><button class="btn btn-info">Editar</button></a>
							<a href="" data-target="#modal-delete-{{$maq->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
						</td>
					</tr>
					@include('maquinas.modal')
					@endforeach
				</tbody>
			</table>
		</div>
		<!--El metodo render nos permite paginar-->
		{{$maquina->render()}}
	</div>
</div>

@endsection