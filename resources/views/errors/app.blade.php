<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Dulce Encanto</title>
        <link rel="icon" type="image/x-icon" href="/img/logo.png" />
        <!-- Custom fonts for this template-->
        <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <!--mis estilos-->
        <link href="/css/style.css" rel="stylesheet">
        <!--datatables-->
        <link href="/css/datatables.min.css" rel="stylesheet">
        <!--plantilla-->
        <link href="/css/sb-admin-2.min.css" rel="stylesheet">
    </head>
    <body id="page-top">
        <div id="contenedor_carga">
            <div id="carga"></div>
        </div>
        <div class="vh-100 row m-0 text-center align-items-center justify-content-center">
            <div class="col-auto">
            <img class="imagen" src="/img/logo.png" width="150px" height="150px" alt="Dulce Encanto">
                <div class="error mx-auto" data-text="@yield('error')">@yield('error')</div>
                    <p class="lead text-gray-800 mb-5">@yield('errorNombre')</p>
                    <p class="text-gray-500 mb-0">Parece que encontraste un error</p>
                    <a href="{{url()->previous()}}" class="alert-link titulo">← Ir a página principal</a>
                </div>
        </div>
        <script src="/js/jquery-3.6.0.min"></script>
        <!-- Bootstrap core JavaScript-->
        <script src="/vendor/jquery/jquery.min.js"></script>
        <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Custom scripts for all pages-->        
        <script src="/js/sb-admin-2.min.js"></script>
        <script src="/js/datatables.min.js"></script>
        <!-- Page level plugins -->
        <script src="/vendor/chart.js/Chart.min.js"></script>
        <!-- Page level custom scripts -->
        <script src="/js/demo/chart-area-demo.js"></script>
        <script src="/js/demo/chart-pie-demo.js"></script>
        <script>
            $(document).ready(function () {
                var contenedor = $('#contenedor_carga');
                contenedor.css('visibility','hidden');
                contenedor.css('opacity','0');
            });
        </script>
    </body>

</html>