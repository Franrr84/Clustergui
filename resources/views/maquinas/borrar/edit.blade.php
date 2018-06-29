@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Máquina</h3>

			<!-- Si hay errores (validaciones de datos) los muestra -->
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
						<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif

			<!-- Al usar la ruta almacen/prueba se llamara a PruebaController y además,
				 al usar el método POST se llamara al metodo 'update' de PruebaController -->
			{!!Form::model($maquina,['method'=>'PATCH','route'=>['maquinas.update', $maquina->id]])!!}
				{{Form::token()}}
				<div class="form-group">
					<label for="nombre">Nombre</label>
					<input type="text" name="nombre" class="form-control" value="{{$maquina->nombre}}" placeholder="Nombre...">
				</div>
				<div class="form-group">
					<label for="tipo">Tipo</label>
					<input type="text" name="tipo" class="form-control" value="{{$maquina->tipo}}" placeholder="Tipo...">
				</div>
				<div class="form-group">
					<label for="estado">Estado</label>
					<input type="text" name="estado" class="form-control" value="{{$maquina->estado}}" placeholder="Estado...">
				</div>

				<div class="form-group">
					<button class="btn btn-primary" type="submit">Guardar</button>
					<button class="btn btn-danger" type="reset">Cancelar</button>
				</div>
			{!!Form::close()!!}
		</div>
	</div>
@endsection