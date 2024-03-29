<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--<title>{{ config('app.name', 'Dulce Encanto') }}</title>-->
    <title>Dulce Encanto</title>
    <link rel="icon" type="image/x-icon" href="/img/logo.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <!-- Custom fonts for this template-->
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.6.0/dt-1.11.5/datatables.min.css" />
    <!-- Custom styles for this template-->
    <link href="/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="/css/sb-admin-2.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
    <!--datatables-->
    <link href="/css/datatables.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.2/css/fixedHeader.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @yield('css')
</head>

<body id="page-top">
    <div id="contenedor_carga">
        <div id="carga"></div>
    </div>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/home">
                <div class="sidebar-brand-icon">
                    <img src="/../img/logo.png" width="50px" height="50px">
                </div>
                <div class="sidebar-brand-text mx-3 tipoletra" style="color: white;">
                    <h6><strong>Dulce Encanto</strong></h6>
                </div>
            </a>
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            @if (Auth()->user()->hasRole('Admin'))
            <li class="nav-item active">
                <a class="nav-link" href="/dashobard">
                    <i class="fas fa-home tipoletra"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @else
            <li class="nav-item active">
                <a class="nav-link" href="/home">
                    <i class="fas fa-home tipoletra"></i>
                    <span>Inicio</span>
                </a>
            </li>
            @endif

            @can('configuracion/editar')
                <li class="nav-item active">
                    <a class="nav-link" href="/configuracion/editar">
                        <i class="fas fa-cog tipoletra"></i>
                        <span>Configuración</span>
                    </a>
                </li>
            @endcan

            
            @if (Auth()->user()->can('/rol') || Auth()->user()->can('/usuario') || Auth()->user()->can('/producto') || Auth()->user()->can('/venta'))
            <hr class="sidebar-divider">
            <div class="sidebar-heading tipoletra">
                Módulos
            </div>
            @endif
            
            
            <!--Roles-->
            @can('/rol')
            <li class="nav-item">
                <a class="nav-link tipoletra" data-toggle="tooltip" data-placement="right" title="En este módulo aquí podrás consultar y crear los roles del aplicativo, así como también asignar permisos a los roles existentes en el módulo" href="/rol">
                    <i class="fas fa-fw fa-cog"></i>
                    <span> Gestión de Roles</span>
                </a>
            </li>
            @endcan

            <!--Usuarios-->
            @can('/usuario')
            <li class="nav-item">
                <a class="nav-link" data-toggle="tooltip" data-placement="right" title="Este módulo, se encarga de gestionar la información personal y de contacto de cada cliente, registrado en el sistema" href="/usuario">
                    <i class="fas fa-user"></i>
                    <span>Gestión de Usuarios</span>
                </a>
            </li>
            @endcan
            <!--Productos-->
            @can('/producto')
            <li class="nav-item">
                <a class="nav-link tipoletra collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-birthday-cake"></i>
                    <span>Gestión de Productos</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @can('/sabor')
                        <a class="collapse-item tipoletra" data-toggle="tooltip" data-placement="top" title="Este módulo, se encarga de crear, visualizar, inhabilitar y editar los sabores que serán asignados al producto" href="/sabor">Sabores</a>
                        @endcan

                        @can('/categoria')
                        <a class="collapse-item tipoletra" data-toggle="tooltip" data-placement="top" title="Este módulo, se encarga de crear, visualizar, inhabilitar y editar las categorias que serán asignados al producto" href="/categoria">Categorías</a>
                        @endcan

                        

                        {{-- @can('producto/crear') --}}
                        
                        @if(Auth()->user()->can('producto/listar') && Auth()->user()->can('/producto'))
                            @can('producto/listar')
                            <a class="collapse-item tipoletra" data-toggle="tooltip" data-placement="top" title="Este módulo, se encarga de gestionar la información de los diferentes productos que se venden en el negocio" href="/producto">Productos</a>
                            @endcan
                        @elseif(Auth()->user()->can('producto/crear'))
                        <a class="collapse-item tipoletra" data-toggle="tooltip" data-placement="top" title="Clic para crear productos" href="/producto/crear">Crear producto</a>
                        @endif

                        @if (Auth()->user()->hasRole('Admin')==false)
                        @can('producto/verProductoCatalogo')
                        <a class="collapse-item tipoletra" data-toggle="tooltip" data-placement="top" title="Podrá visualizar todos los productos añadidos al catálogo" href="/producto/catalogo">Catálogo</a>
                        @endcan
                        @endif
                    </div>
                </div>
            </li>
            @endcan

            <!--Ventas-->
            @can('/venta')
            <li class="nav-item">
                <a class="nav-link tipoletra collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span> Gestión de Ventas</span>
                </a>
                <div id="collapsePages" class="collapse tipoletra" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @can('/cotizacion')
                        <a class="collapse-item tipoletra" data-toggle="tooltip" data-placement="top" title="Este módulo nos permite tener un registro de las cotizaciones, llevar un seguimiento, de acuerdo al estado en que se encuentre cada una: pendiente, rechazada o aprobada" href="/cotizacion">Cotizaciones</a>
                        @endcan

                        @can('/pedido')
                        <a class="collapse-item tipoletra" data-toggle="tooltip" data-placement="top" title="Este módulo nos permite hacer un seguimiento de los pedidos, teniendo así la posibilidad de hacer el registro de los pedidos que se hagan tanto en el aplicativo, como externamente" href="/pedido">Pedidos</a>
                        @endcan

                        @can('/abono')
                        <a class="collapse-item tipoletra" data-toggle="tooltip" data-placement="top" title="Este módulo nos permite hacer seguimiento de los abonos realizados a los pedidos" href="/abono">Abonos</a>
                        @endcan
                        <div class="collapse-divider"></div>
                    </div>
                </div>
            </li>
            @endcan

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        
                        @yield('car')
                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small tipoletra">{{ Auth::user()->nombre}}</span>
                                    <img class="img-profile rounded-circle" src="/../img/{{Auth::user()->foto}}">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item tipoletra" href="/">
                                        <i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Ir a página principal
                                    </a>
                                    <a class="dropdown-item tipoletra" href="/perfil/{{Auth::user()->id}}">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Editar perfil
                                    </a>
                                    <a class="dropdown-item tipoletra" href="/perfil/cambiar/{{Auth::user()->id}}">
                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Cambiar contraseña
                                    </a>
                                    <!--<a class="dropdown-item" href="#">
                                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Activity Log
                                    </a>-->
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item tipoletra" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Cerrar sesión
                                    </a>
                                </div>
                            </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- End of Main Content -->
            </div>
            <!-- Footer -->
            <!-- <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright&copy; DisDely 2022</span>
                    </div>
                </div>
            </footer> -->
        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cerrar sesión</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">¿Está seguro que desea cerrar sesión?</div>
                    <div class="modal-footer d-flex justify-content-between align-items-center">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>

                        <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Cerrar sesión') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"> -->
    <!-- </script> -->

    <!-- Para borrar porque no da el menú -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>

    <!-- Bootstrap core JavaScript-->

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js" integrity="sha512-XZEy8UQ9rngkxQVugAdOuBRDmJ5N4vCuNXCh8KlniZgDKTvf7zl75QBtaVG1lEhMFe2a2DuA22nZYY+qsI2/xA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/localization/messages_es.min.js" integrity="sha512-Ou4GV0BYVfilQlKiSHUNrsoL1nznkcZ0ljccGeWYSaK2CaVzof2XaZ5VEm5/yE/2hkzjxZngQHVwNUiIRE8yLw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/js/sb-admin-2.min.js"></script>
    <script src="/js/datatables.min.js"></script>
    

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.6.0/dt-1.11.5/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.2/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js"></script>

    <!--Iconos-->
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" integrity="sha384-SlE991lGASHoBfWbelyBPLsUlwY1GwNDJo3jSJO04KZ33K2bwfV9YBauFfnzvynJ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script>
        $(document).ready(function() {
            var contenedor = $('#contenedor_carga');
            contenedor.css('visibility', 'hidden');
            contenedor.css('opacity', '0');
        });

        $(document).ready(function() {
            $('select').select2();
        });

        // $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
        $('div.alert').delay(10000).fadeOut(350);
        // function ucfirst(str,force)
        // { 
        //     str=force ? str.toLowerCase() : str; 
        //     return str.replace(/(\b)([a-zA-Z])/, 
        //     function(firstLetter)
        //     { 
        //         return firstLetter.toUpperCase(); 
        //     }); 
        // }

        // $('input[type="text"]').keyup(function(evt){ 
        //     // force: true to lower case all letter except first 
        //     var cp_value= ucfirst($(this).val(),true) ; 
        //     // to capitalize all words 
        //     //var cp_value= ucwords($(this).val(),true) ; 
        //     $(this).val(cp_value ); });
            
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    @yield('scripts')
</body>

</html>