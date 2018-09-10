<!DOCTYPE html>
<html>
<head>
	<title>{{ env('APP_NAME') }} - Nota de pedido</title>
</head>

<link href="{{ url('css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all" />
<style type="text/css">
/*tbody:nth-child(odd) { background: #f5f5f5;  border: solid 1px #ddd; }
tbody:nth-child(even) { background: #e5e5e5;  border: solid 1px #ddd; }*/
body {
	font-size: 16px;
}
.second-tr {
	background-color: #f2f2f2;
}
.content {
	position: relative;
}
.section {
	display: block;
	width: 100%;
	height: 130mm;
	border: solid 1px #ccc;
	clear: both;
}
.separator {
	display: block;
	width: 100%;
	margin-top: 2.5mm;
	margin-bottom: 2.5mm;
	background: #ccc;
	clear: both;
	border: solid 1px #ccc;
}
</style>
<body>
	<div class="section"></div>
	<div class="separator"></div>
	<div class="section"></div>
	
</body>
</html>