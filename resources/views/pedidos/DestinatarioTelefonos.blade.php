@if($telefonos)
<option value="" disabled selected>Selecciona un teléfono</option>
@foreach($telefonos as $telefono)
<option value="{{ $telefono->numero_telefono }}">{{ $telefono->numero_telefono }}</option>
@endforeach
@endif