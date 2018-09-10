<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('cms.owner_name') }} - Página no encontrada</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: Helvetica;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 210px;
                font-weight: 900;
                text-shadow: 4px 4px 0 #fff, 6px 6px 0 #343a40;
                line-height: 210px;
                color: #4080ff;
			}

            .links > a {
                
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .btn {
                color: #fff;
                background-color: #4080ff;
                border-color: #4080ff;
                padding: 8px 12px;
                border-radius: 3px;
                text-decoration: none;
            }
            h2 {
                margin-top: 0;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="title">
                    404
                </div>
                <h2>Página no encontrada</h2>

                <h5>Estas aquí debido a que estas intentando ingresar a una página que no existe.<br>Por favor ponte en contacto con el administrador,<br> también puedes informarte más sobre este error haciendo click <a href="#">aquí.</a></h5>
                <h5>O simplemente puedes volver al inicio haciendo click en el siguiente botón.</h5>

                <div class="links">
                    <a href="{{ url('/') }}" class="btn btn-primary">Volver al inicio</a>
                </div>
            </div>
        </div>
    </body>
</html>
