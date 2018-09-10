<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistema') }}</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ url('css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/font-awesome.css') }}">
    {{--<link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">--}}
    <link rel="stylesheet" href="{{ url('plugins/datetimepicker/css/bootstrap-datetimepicker.css') }}">

    
    <link rel="stylesheet" type="text/css" href="{{ url('css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('plugins/bootstrap-select-master/css/bootstrap-select.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="{{ url('plugins/fastselect/fastselect.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/estilos.css') }}">
    <!--<link href="/css/app.css" rel="stylesheet">-->
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="{{ url('js/wow.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>

    @hasSection ('header')
    @yield('header')
    @endif
    <!-- Scripts -->
    <script>
        new WOW().init();
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
    </script>

</head>
<body>
    <div id="app" class="{{ Request::is('/') ? 'home' : 'page-inner' }}">
        @include('partials.navigation')
        @yield('content')
        <div class="reports" style="display: none;">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <p></p>
              </div>
            </div>
          </div>
          <div class="close"><i class="fa fa-times" aria-hidden="true"></i></div>
        </div>
    </div>
    
    <!-- Scripts -->
    <script src="{{ url('/js/bootstrap.min.js') }}"></script>
    <!--<script src="/js/app.js"></script>-->
    <script src="{{ url('/js/megamenu.js') }}"></script>

    <script src="{{ url('/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ url('js/bootstrap-notify.min.js') }}"></script>
    <script src="{{ url('plugins/bootstrap-select-master/js/bootstrap-select.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment-with-locales.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/locale/es.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="{{ url('js/cart/shoppingCart.js') }}"></script>
    
    <script src="{{ url('plugins/fastselect/fastselect.standalone.js') }}"></script>
    <script src="{{ url('plugins/number/jquery.number.js') }}"></script>
    <script src="{{ url('js/script.js') }}"></script>

    <script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
        //var $select = $('select');

        // Run, fire and forget
        /*$select.fastselect({
            placeholder: 'Selecciona una opción',
            searchPlaceholder: 'Buscar',
            noResultsText: 'No hay resultados',
            userOptionPrefix: 'Agregar '
        });*/
    });
    </script>

    @hasSection ('script')
    @yield('script')
    @endif
    @hasSection ('footer')
    @yield('footer')
    @endif
    

</body>
</html>
