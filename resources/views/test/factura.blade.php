<!DOCTYPE html>
<html>
<head>
	<title>Factura</title>
</head>
<body>

	<div class="head">
		<div class="col-head col-head-1"></div>
		<div class="col-head col-head-2"></div>
	</div>

	<div class="sub-head">
		<div class="placeholder fecha"><i>Fecha de emisión:</i> 20/06/2018</div>
		<div class="placeholder nombre"><i>Nombre o Razón Social:</i> Jorge Nuñez</div>
		<div class="placeholder direccion"><i>Dirección:</i> </div>
		<div class="placeholder nota"><i>Nota de remisión N°:</i> 00012329</div>

		<div class="placeholder condicion"><i>Condición de venta: Contado(<span class="contado"></span>)<span class="separator-tag"></span>Crédito(<span class="contado"></span>)</i> </div>
		<div class="placeholder ruc"><i>R.U.C</i> 5075936</div>
		<div class="placeholder telefono"><i>Teléfono:</i> </div>
		<div class="placeholder pedido_nro"><i>Pedido N°:</i> 000154545</div>
		<div class="placeholder fecha_pedido"><i>Fecha Pedido:</i> 20/06/2018</div>
	</div>
	<div class="body">
		<div class="body_separator"></div>
		<div class="table">
			<p class="cod">myg-145</p>
			<p class="cantidad">2</p>
			<p class="producto">ARREGLO COLORIDO</p>
			<p class="precio">250.000</p>
			<p class="exentas">0</p>
			<p class="iva5">0</p>
			<p class="iva10">250.000</p>
		</div>
		<div class="letras">{{ convertir('1200000') }}</div>
		
		{{-- Sub totales --}}
		<div class="exenta_sub_total">0</div>
		<div class="iva5_sub_total">0</div>
		<div class="iva10_sub_total">250.000</div>

		{{-- Fin Sub totales --}}
		<div class="iva5_total">0</div>
		<div class="iva10_total">27.273</div>
		<div class="iva_total">27.273</div>
	</div>
</body>

<style type="text/css">
	@page { size: 643.464566929pt auto; }
	body {
		padding: 0;
		margin: 0;
		font-family: Helvetica;
		font-size: 14px;
	}
	.head {
		position: relative;
		display: block;
		width: 210mm;
		height: 32mm;
		clear: both;
	}
	.col-head {
		position: absolute;
		height: 32mm;
		background: #ccc;
		top: 0;
	}
	.col-head-1 {
		width: 125mm;
		left: 0;
	}
	.col-head-2 {
		width: 82mm;
		left: 128mm;
	}
	.sub-head {
		position: relative;
		display: block;
		width: 210mm;
		height: 32mm;
		clear: both;
		margin-top: 1mm;
	}
	.sub-head .placeholder {
		position: absolute;
		color: #000;
	}
	.sub-head .fecha {
		position: absolute;
		left: 2mm;
		top: 2mm;
	}
	.sub-head .nombre {
		top: 8mm;
		left: 2mm;
	}
	.sub-head .direccion {
		top: 15mm;
		left: 2mm;
	}
	.sub-head .nota {
		top: 25mm;
		left: 2mm;
	}
	.sub-head .condicion {
		top: 2mm;
		left: 120mm;
	}
	.sub-head .ruc {
		top: 8mm;
		left: 147mm;
	}
	.sub-head .telefono {
		top: 15mm;
		left: 147mm;
	}
	.sub-head .pedido_nro {
		top: 25mm;
		left: 108mm;
	}
	.sub-head .fecha_pedido {
		top: 25mm;
		left: 147mm;
	}
	.sub-head .contado, .sub-head .credito {
		display: inline-block;
		width: 6mm;
	}
	.separator-tag {
		display: inline-block;
		width: 4mm;
	}
	i {
		color: #000;
		font-style: normal;
	}
	.body {
		position: relative;
		display: block;
		width: 210mm;
		height: 74mm;
	}
	.table {
		position: relative;
		display: block;
		margin-bottom: 0.5mm;
		height: 10mm;
	}
	.cod, .cantidad, .producto, .precio, .exentas, .iva5, .iva10, .cod {
		position: absolute;
	}
	.cod {
		left: 0;
		width: 13mm;
		text-align: center;
	}
	.cantidad {
		left: 15mm;
		width: 10mm;
		text-align: center;
	}
	.producto {
		left: 30mm;
		width: 80mm;
		text-align: left;
	}
	.precio {
		width: 20mm;
		left: 130mm;
		text-align: center;
	}
	.exentas {
		width: 14mm;
		left: 150mm;
		text-align: center;
	}
	.iva5 {
		width: 10mm;
		left: 170mm;
		text-align: center;
	}
	.iva10 {
		width: 20mm;
		left: 190mm;
		text-align: center;
	}
	.letras {
		position: absolute;
		top: 60mm;
		left: 25mm;
		width: 135mm;
	}
	.exenta_sub_total {
		position: absolute;
		width: 14mm;
		left: 150mm;
		top: 53mm;
		text-align: center;
	}
	.iva5_sub_total {
		position: absolute;
		width: 10mm;
		left: 170mm;
		top: 53mm;
		text-align: center;
	}
	.iva10_sub_total {
		position: absolute;
		width: 20mm;
		left: 190mm;
		top: 53mm;
		text-align: center;
	}
	.iva5_total {
		position: absolute;
		left: 50mm;
		top: 70mm;
	}
	.iva10_total {
		position: absolute;
		left: 100mm;
		top: 70mm;
	}
	.iva_total {
		position: absolute;
		left: 155mm;
		top: 70mm;
	}
	.body_separator {
		display: block;
		height: 6mm;
	}
</style>

</html>