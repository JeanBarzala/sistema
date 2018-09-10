@if($direcciones)
<option value="" disabled selected>Selecciona una dirección de cobro</option>
@foreach($direcciones as $direccion)
<option value="{{ $direccion->id_direccion }}">{{ makeDireccion($direccion->calle_direccion, $direccion->interseccion1_direccion, $direccion->interseccion2_direccion, $direccion->numero_direccion, $direccion->nombre_barrio, $direccion->nombre_ciudad) }}</option>
@endforeach
@endif