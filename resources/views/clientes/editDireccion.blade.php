<div class="row">
	<div class="col-lg-4">
		<div class="form-group">
			<label>Ciudad</label>
			<select name="ciudad" class="form-control select-ciudad">
				{{--
				@if(count($ciudades))
				@foreach($ciudades as $ciudad)
				<option value="{{ $ciudad->id_ciudad }}" {{ $ciudad->id_ciudad == $direccion->id_ciudad ? 'selected' : '' }}>{{ $ciudad->nombre_ciudad }}</option>
				@endforeach
				@endif
				--}}
				<option value="{{ $direccion->ciudades->id_ciudad }}">{{ $direccion->ciudades->nombre_ciudad }}</option>
			</select>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="form-group">
			<label>Barrio</label>
			<select name="ciudad" class="form-control select-barrio">
				{{--
				@if(count($barrios))
				@foreach($barrios as $barrio)
				<option value="{{ $barrio->id_barrio }}" {{ $barrio->id_barrio == $direccion->id_barrio ? 'selected' : '' }}>{{ $barrio->nombre_barrio }}</option>
				@endforeach
				@endif
				--}}
				<option value="{{ $direccion->barrios->id_barrio }}">{{ $direccion->barrios->nombre_barrio }}</option>				
			</select>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="form-group">
			<label>Calle principal</label>
			<input type="text" name="calle_direccion" class="form-control" value="{{ $direccion->calle_direccion }}" autocomplete="off">
		</div>
	</div>
	<div class="col-lg-4">
		<div class="form-group">
			<label>N° de casa</label>
			<input type="text" name="numero_direccion" class="form-control" value="{{ $direccion->numero_direccion }}" autocomplete="off">
		</div>
	</div>
	<div class="col-lg-4">
		<div class="form-group">
			<label>Complemento</label>
			<input type="text" name="complemento_direccion" class="form-control" value="{{ $direccion->complemento_direccion }}" autocomplete="off">
		</div>
	</div>
	<div class="col-lg-4">
		<div class="form-group">
			<label>Intersección 1</label>
			<input type="text" name="interseccion1_direccion" class="form-control" value="{{ $direccion->interseccion1_direccion }}" autocomplete="off">
		</div>
	</div>
	<div class="col-lg-4">
		<div class="form-group">
			<label>Intersección 2</label>
			<input type="text" name="interseccion2_direccion" class="form-control" value="{{ $direccion->interseccion2_direccion }}" autocomplete="off">
		</div>
	</div>
	<div class="col-lg-4">
		<div class="form-group">
			<label>Barrio dirección</label>
			<input type="text" name="barrio_direccion" class="form-control" value="{{ $direccion->barrio_direccion }}" autocomplete="off">
		</div>
	</div>
	<div class="col-lg-4">
		<div class="form-group">
			<label>Referencia</label>
			<input type="text" name="referencia_direccion" class="form-control" value="{{ $direccion->referencia_direccion }}" autocomplete="off">
		</div>
	</div>
	<div class="col-lg-4">
		<div class="form-group">
			<label>Observaciones</label>
			<input type="text" name="observaciones_direccion" class="form-control" value="{{ $direccion->observaciones_direccion }}" autocomplete="off">
		</div>
	</div>

</div>