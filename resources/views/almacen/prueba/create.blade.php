@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Prueba</h3>

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
				 al usar el método POST se llamara al metodo 'store' de PruebaController -->
			{!!Form::open(array('url'=>'almacen/prueba','method'=>'POST','autocomplete'=>'off'))!!}
				{{Form::token()}}
				<div class="form-group">
					<label for="nombre">Nombre</label>
					<input type="text" name="nombre" class="form-control" placeholder="Nombre...">
				</div>
				<div class="form-group">
					<label for="campo1">Campo 1</label>
					<input type="number" name="campo1" class="form-control">
				</div>
				<div class="form-group">
					<label for="campo2">Campo 2</label>
					<input type="number" name="campo2" class="form-control">
				</div>
				<div class="form-group">
					<label for="campo3">Campo 3</label>
					<input type="number" name="campo3" class="form-control">
				</div>
				<div class="form-group">
					<button class="btn btn-primary" type="submit">Guardar</button>
					<button class="btn btn-danger" type="reset">Cancelar</button>
				</div>
			{!!Form::close()!!}
		</div>
	</div>
@endsection