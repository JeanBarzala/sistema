<div class="row">
	<div class="col-lg-4">
		<div class="form-group">
			<label>Tipo</label>
			<select name="tipo_telefono" class="form-control">
				<option value="F" {{ $telefono->tipo_telefono == 'F' ? 'selected' : '' }}>Fijo</option>
				<option value="M" {{ $telefono->tipo_telefono == 'M' ? 'selected' : '' }}>Móvil</option>
			</select>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="form-group">
			<label>Local</label>
			<select name="local_telefono" class="form-control">
				<option value="P" {{ $telefono->local_telefono == 'P' ? 'selected' : '' }}>Particular</option>
				<option value="L" {{ $telefono->local_telefono == 'L' ? 'selected' : '' }}>Laboral</option>
			</select>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="form-group">
			<label>Número de teléfono</label>
			<input type="text" name="numero_telefono" class="form-control" value="{{ $telefono->numero_telefono }}" autocomplete="off">
		</div>
	</div>

</div>