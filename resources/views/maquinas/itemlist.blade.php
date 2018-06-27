<!-- Extends indica que va a extender a la plantilla admin, Section que el contenido que esté en esta plantilla se colocará en donde esté @yield('contenido')-->
@extends ('layouts.admin')
@section ('contenido')
<div class="container">
    <div class="row" style="margin-bottom: 20px;">
      <div class="col-lg-12 col-md-8 col-sm-8 col-xs-12">
        <h3>{{$maquina->nombre}} <a href="/maquina/itemgrid/{{$maquina->id}}"><button class="btn btn-success">Vista elementos</button></a>
        	<a href="/maquina/list"><button class="btn btn-danger">Volver</button></a></h3>
      </div>
    </div>

 	<div class = "row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<!--<th>Id</th>-->
						<th>Nombre</th>
						<th>Origen</th>
						<th>Estado</th>
					</thead>
					<!--Implementamos bucle que carge los valores de la tabla, los valores están almacenados en $maquina que es enviada por el Controlador-->
					<tbody>
						@foreach ($componentes as $com)
						<tr>
							<!--<td>{{$com->id}}</td>-->
							<td>{{$com->nombre}}</td>
							<td>{{$com->origen}}</td>
							@if($com->estado == "Off")
								<td style="color: red">{{$com->estado}}</td>
							@else
								<td style="color: green">{{$com->estado}}</td>
							@endif
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<!--El metodo render nos permite paginar-->
			{{$componentes->render()}}
	</div>
</div>
    
</div>
<!-- /.container -->
@endsection