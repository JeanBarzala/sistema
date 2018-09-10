@extends('layouts.app')

@section('content')
<div class="header-page">
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <h3>Registar un nuevo producto</h3>
        </div>
        <div class="col-lg-8">
            <ul class="nav-nav navbar-right">
                <li>
                    <a href="{{ url('/productos') }}" class="btn btn-primary">
                        <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    </a>
                </li>
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
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Imagen</label>
                                            <input type="file" name="img" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="row">
                                    

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Categoria</label>
                                            <select name="categoria" class="form-control">
                                                <option value="0" selected="" disabled="">Seleccion una categoría</option>
                                                @foreach ($categorias as $categoria)
                                                <option value="{{ $categoria->id_agrupador }}">{{ titleCase($categoria->nombre_agrupador) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Código</label>
                                            <input type="text" name="codigo" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Nombre</label>
                                            <input type="text" name="nombre" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Descripción</label>
                                            <input type="text" name="descripcion" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Stock minimo</label>
                                            <input type="text" name="stockmin" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Precio de compra</label>
                                            <input type="text" name="precioc" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Precio de venta</label>
                                            <input type="text" name="preciov" class="form-control">
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
                    <button class="btn btn-primary">Registrar</button>
                </div>
            </div>
        </div>
        </form>

    </div>

</div>



@endsection
