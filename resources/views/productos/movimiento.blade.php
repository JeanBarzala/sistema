
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
                <li>
                  <a href="{{ url('/productos') }}" class="btn btn-primary" title="Volver atrás">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                  </a>
                </li>
            </ul>
        </div>
    </div>
</div>
</div>

<div class="container m_top_30 productosList" id="productosList">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body ">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Buscar un producto</label>
                                <input type="text" class="form-control buscador" name="q" placeholder="Buscar por nombre, descripción, codigo o precio">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row " style="position: relative; min-height: 50vh;">
        <div class="col-lg-12">
            <div class="row result-content">
                @include('productos.productos')
            </div>
        </div>
        
    </div>
    
    
    
</div>





<script type="text/javascript">
$('.modal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('detail') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)

    $.ajax({
        method: "POST",
        url: recipient,
        dataType:  'html',
        beforeSend: function(){
              //imagen de carga
              //$(".modal-body .loader").html("<div class='carga'><img src='{{ url('img/loader.gif') }}' /></div>");
        },
        success : function(data) {
            console.log(recipient);
            $('.modal-body').html(data);
        }
    })
  
})  


        


</script>







@endsection
