@extends('layouts.app')

@section('content')
<div class="header-page">
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <h3>Productos</h3>
        </div>
        <div class="col-lg-8">
            <ul class="nav-nav navbar-right">
                <!--<li>
                    <div class="search-input">
                        <i class="fa fa-search" aria-hidden="true"></i>
                        <input type="text" name="b" placeholder="Buscar">
                    </div>
                </li>-->
                <li><a href="{{ url('/productos') }}" class="btn btn-primary">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                </a></li>
            </ul>
        </div>
    </div>
</div>
</div>
<div class="container">

    <div class="panel panel-default panel-content">

        <div class="panel-body">
            <div class="row">
        
                <div class="col-lg-12">

                    <form method="post" action="{{ url('/productos') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="row">

                            <div class="col-lg-4">
                                <label>Imagen actual</label>
                                <img src="{{ url('upload/') . '/' .$productos->img }}" class="img-responsive center-block">

                            </div>
                            <div class="col-lg-8">
                                <div class="row">
                                    
                                
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Unidad de medida</label>
                                            <select name="familia" class="form-control " >


                                                @foreach ($familias as $familia)
                                                <option value="{{ $familia->id }}" {{ $productos->familiaId == $familia->id ? 'selected="selected"' : '' }}>{{ $familia->nombre }} - {{ $familia->descripcion }}</option>
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Codigo</label>
                                            <input type="text" name="codigo" class="form-control" value="{{ $productos->codigo }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Nombre</label>
                                            <input type="text" name="nombre" class="form-control" value="{{ $productos->nombre }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Descripcion</label>
                                            <input type="text" name="descripcion" class="form-control" value="{{ $productos->descripcion }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Stock minimo</label>
                                            <input type="text" name="stockmin" class="form-control" value="{{ $productos->stockmin }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Precio de compra</label>
                                            <input type="text" name="precioc" class="form-control" value="{{ number_format($productos->precioc, '0', ',', '.') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Precio de venta</label>
                                            <input type="text" name="preciov" class="form-control" value="{{ number_format($productos->preciov, '0', ',', '.') }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Unidad de medida</label>
                                            <select name="unidadmedida" class="form-control " >


                                                @foreach ($medidas as $medida)
                                                <option value="{{ $medida->id }}" {{ $productos->unidadmedidaId == $medida->id ? 'selected="selected"' : '' }}>{{ $medida->nombre }} - {{ $medida->descripcion }}</option>
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Imagen</label>
                                            <input type="file" name="img" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Estado</label>
                                            <select class="form-control" name="estado">
                                                <option value="1">Activo</option>
                                                <option value="0">Inactivo</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        
                            

                        </div>

                    
                    

                </div>

            </div>
            
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <button class="btn btn-primary">Actualizar</button>
                </div>
            </div>
        </div>
        </form>

    </div>

</div>


@endsection
