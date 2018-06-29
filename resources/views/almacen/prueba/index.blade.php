<!-- Extends indica que va a extender a la plantilla admin, Section que el contenido que esté en esta plantilla se colocará en donde esté @yield('contenido')-->
@extends ('layouts.admin')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Prueba <a href="prueba/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('almacen.prueba.search')
	</div>
</div>

<div class = "row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Campo1</th>
					<th>Campo2</th>
					<th>Campo3</th>
					<th>Nombre</th>
					<th>Opciones</th>
				</thead>
				<!--Implementamos bucle que carge los valores de la tabla, los valores están almacenados en $prueba que es enviada por el Controlador-->
				<tbody>
					@foreach ($prueba as $pru)
					<tr>
						<td>{{$pru->id}}</td>
						<td>{{$pru->campo1}}</td>
						<td>{{$pru->campo2}}</td>
						<td>{{$pru->campo3}}</td>
						<td>{{$pru->nombre}}</td>

						<td>
							<a href="{{URL::action('PruebaController@edit', $pru->id)}}"><button class="btn btn-info">Editar</button></a>
							<a href="" data-target="#modal-delete-{{$pru->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
						</td>
					</tr>
					@include('almacen.prueba.modal')
					@endforeach
				</tbody>
			</table>
		</div>
		<!--El metodo render nos permite paginar-->
		{{$prueba->render()}}
	</div>
</div>

@endsection