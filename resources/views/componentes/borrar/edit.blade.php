@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Componente</h3>

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
			{!!Form::model($componente,['method'=>'PATCH','route'=>['componentes.update', $componente->id]])!!}
				{{Form::token()}}
				<div class="form-group">
					<label for="nombre">Nombre</label>
					<input type="text" name="nombre" class="form-control" value="{{$componente->nombre}}" placeholder="Nombre...">
				</div>
				<div class="form-group">
					<label for="origen">Origen</label>
					<input type="text" name="origen" class="form-control" value="{{$componente->origen}}" placeholder="Origen...">
				</div>
				<div class="form-group">
					<label for="estado">Estado</label>
					<input type="text" name="estado" class="form-control" value="{{$componente->estado}}" placeholder="Estado...">
				</div>

				<div class="form-group">
					<button class="btn btn-primary" type="submit">Guardar</button>
					<button class="btn btn-danger" type="reset">Cancelar</button>
				</div>
			{!!Form::close()!!}
		</div>
	</div>
@endsection