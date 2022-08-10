@extends('layouts.app')

@section('title')
Roles
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Crear Rol</strong>
    </div>
    <div class="card-body">
        <div class="container mt-1">
            <div class="row justify-content-center">
                <div class="col-auto">
                    @include('flash::message')
                </div>
            </div>
        </div>
        <form id="form" action="/rol/guardar" method="post">
            @csrf
            <div class="container mt-1">
                <div class="row ">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Nombre<b style="color: red" data-toggle="tooltip" data-placement="top"
                                    title="Requerido"> *</b></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                value="{{old('name')}}" id="name" name="name" placeholder="Ingrese nombre del rol"
                                required>
                            @error('name')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        {{-- <div class="col-md-12 mb-2"> 
                            <a href="javascript:void(0)" class="alert-link titulo"  onclick="mostrarVentana()" data-toggle="tooltip" data-placement="right" title="Clic aquí para seleccionar rol por módulo">Necesito ayuda</a>
                        </div> --}}
                        <div class="col-md-12 mt-3"> 
                            <div class="row">
                                <div class="col-md-3">
                                    <label> 
                                        <input type="checkbox" id="moduloRoles" value="" class="mr-1">
                                        Módulo Roles
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <label> 
                                        <input type="checkbox" id="moduloUsuarios" value="" class="mr-1">
                                        Módulo Usuarios
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <label> 
                                        <input type="checkbox" id="moduloSabores"  value="" class="mr-1">
                                        Módulo Sabores
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <label> 
                                        <input type="checkbox" id="1001"  value="" class="mr-1">
                                        Módulo Categorías
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3"> 
                            <div class="row">
                                <div class="col-md-3">
                                    <label> 
                                        <input type="checkbox" id="1001" onclick="mostrarVentana()"  value="" class="mr-1">
                                        Módulo Productos
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <label> 
                                        <input type="checkbox" id="1001"  value="" class="mr-1">
                                        Módulo Pedidos
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <label> 
                                        <input type="checkbox" id="1001"  value="" class="mr-1">
                                        Módulo Abonos
                                    </label>
                                </div>
                            </div>
                        </div>
                        <br>
                        {{-- <div class="col-md-12 p-3" id="verProducto" style="display: none;"> 
                            <div class="row">
                                <div class="col-md-12">
                                    <p>Módulo de productos</p>
                                </div>
                                <div class="col-md-2">
                                    <label> 
                                        <input type="checkbox" id="crearProducto" class="mr-1">
                                        Crear producto
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <label> 
                                        <input type="checkbox" id="editarProducto" class="mr-1">
                                        Editar producto
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <label> 
                                        <input type="checkbox" id="" class="mr-1">
                                        Listar producto
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <label> 
                                        <input type="checkbox" id="" class="mr-1">
                                        Ver producto
                                    </label>
                                </div>
                                <div class="col-md-4">
                                    <label> 
                                        <input type="checkbox" id="" class="mr-1">
                                        Cambiar estado de producto
                                    </label>
                                </div>
                            </div>
                        </div> --}}
                        <div class="form-group container ">
                            <h5 class="text-center mb-3">Lista de Permisos<b style="color: red" data-toggle="tooltip" data-placement="top"
                                    title="Requerido"> *</b></h5>
                            <div class="row">
                                @foreach ($permissions as $permission)
                                <div class="col-4">
                                    <label>
                                        <input type="checkbox" name="permissions[]" id="{{$permission->id}}"
                                            value="{{$permission->id}}" class="mr-1">
                                        {{$permission->description}}
                                    </label>
                                </div>

                                @endforeach
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-between align-items-center">
                            <a href="/rol" class="btn btn-primary tipoletra">Volver</a>
                            <button type="submit" class="btn btn-primary tipoletra">Crear</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')

<script>
//-------------------------------ROLES
function mostrarVentana(id){
    $('#verProducto').toggle();
}

$('#moduloRoles').change(function() {
    if ($(this).prop("checked")) {
        $('#1').prop('checked', true);
        $('#2').prop('checked', true);
        $('#3').prop('checked', true);
        $('#4').prop('checked', true);
        $('#5').prop('checked', true);
        return;
    } else {
        $('#1').prop('checked', false);
        $('#2').prop('checked', false);
        $('#3').prop('checked', false);
        $('#4').prop('checked', false);
        $('#5').prop('checked', false);
    }
});

$('#moduloUsuarios').change(function() {
    if ($(this).prop("checked")) {
        $('#23').prop('checked', true);
        $('#24').prop('checked', true);
        $('#25').prop('checked', true);
        $('#26').prop('checked', true);
        $('#27').prop('checked', true);
        $('#28').prop('checked', true);
        return;
    } else {
        $('#23').prop('checked', false);
        $('#24').prop('checked', false);
        $('#25').prop('checked', false);
        $('#26').prop('checked', false);
        $('#27').prop('checked', false);
        $('#28').prop('checked', false);
    }
});

$('#moduloSabores').change(function() {
    if ($(this).prop("checked")) {
        $('#6').prop('checked', true);
        $('#7').prop('checked', true);
        $('#8').prop('checked', true);
        $('#9').prop('checked', true);
        $('#10').prop('checked', true);
        return;
    } else {
        $('#6').prop('checked', false);
        $('#7').prop('checked', false);
        $('#8').prop('checked', false);
        $('#9').prop('checked', false);
        $('#10').prop('checked', false);
    }
});
/*
$('#1').change(function() {
    if ($(this).prop("checked")) {
        $('#2').prop('checked', true);
        $('#3').prop('checked', true);
        $('#4').prop('checked', true);
        $('#5').prop('checked', true);
        $('#6').prop('checked', true);
        return;
    } else {
        $('#2').prop('checked', false);
        $('#3').prop('checked', false);
        $('#4').prop('checked', false);
        $('#5').prop('checked', false);
        $('#6').prop('checked', false);
    }
});

$('#2').change(function() {
    if ($(this).prop("checked")) {
        $('#1').prop('checked', true);
        return;
    } else {
        $('#1').prop('checked', false);
    }
});

$('#3').change(function() {
    if ($(this).prop("checked")) {
        $('#1').prop('checked', true);
        return;
    } else {
        $('#1').prop('checked', false);
    }
});

$('#4').change(function() {
    if ($(this).prop("checked")) {
        $('#1').prop('checked', true);
        $('#2').prop('checked', true);
        return;
    } else {
        $('#1').prop('checked', false);
        $('#2').prop('checked', false);
    }
});

$('#5').change(function() {
    if ($(this).prop("checked")) {
        $('#1').prop('checked', true);
        $('#2').prop('checked', true);
        return;
    } else {
        $('#1').prop('checked', false);
        $('#2').prop('checked', false);
    }
});

$('#6').change(function() {
    if ($(this).prop("checked")) {
        $('#1').prop('checked', true);
        $('#2').prop('checked', true);
        return;
    } else {
        $('#1').prop('checked', false);
        $('#2').prop('checked', false);
    }
});

//------------------------------------SABORES
$('#7').change(function() {
    if ($(this).prop("checked")) {
        $('#8').prop('checked', true);
        $('#9').prop('checked', true);
        $('#10').prop('checked', true);
        $('#11').prop('checked', true);
        $('#17').prop('checked', true);
        return;
    } else {
        $('#8').prop('checked', false);
        $('#9').prop('checked', false);
        $('#10').prop('checked', false);
        $('#11').prop('checked', false);
        $('#17').prop('checked', false);
    }
});

$('#8').change(function() {
    if ($(this).prop("checked")) {
        $('#7').prop('checked', true);
        $('#17').prop('checked', true);
        return;
    } else {
        $('#7').prop('checked', false);
        $('#17').prop('checked', false);
    }
});

$('#9').change(function() {
    if ($(this).prop("checked")) {
        $('#7').prop('checked', true);
        $('#17').prop('checked', true);
        return;
    } else {
        $('#7').prop('checked', false);
        $('#17').prop('checked', false);
    }
});

$('#10').change(function() {
    if ($(this).prop("checked")) {
        $('#7').prop('checked', true);
        $('#8').prop('checked', true);
        $('#17').prop('checked', true);
        return;
    } else {
        $('#7').prop('checked', false);
        $('#8').prop('checked', false);
        $('#17').prop('checked', false);
    }
});

$('#11').change(function() {
    if ($(this).prop("checked")) {
        $('#7').prop('checked', true);
        $('#8').prop('checked', true);
        $('#17').prop('checked', true);
        return;
    } else {
        $('#7').prop('checked', false);
        $('#8').prop('checked', false);
        $('#17').prop('checked', true);
    }
});

//---------------------------CATEGORIAS
$('#12').change(function() {
    if ($(this).prop("checked")) {
        $('#13').prop('checked', true);
        $('#14').prop('checked', true);
        $('#15').prop('checked', true);
        $('#16').prop('checked', true);
        $('#17').prop('checked', true);
        return;
    } else {
        $('#13').prop('checked', false);
        $('#14').prop('checked', false);
        $('#15').prop('checked', false);
        $('#16').prop('checked', false);
        $('#17').prop('checked', false);
    }
});

$('#13').change(function() {
    if ($(this).prop("checked")) {
        $('#12').prop('checked', true);
        $('#17').prop('checked', true);
        return;
    } else {
        $('#12').prop('checked', false);
        $('#17').prop('checked', false);
    }
});

$('#14').change(function() {
    if ($(this).prop("checked")) {
        $('#12').prop('checked', true);
        $('#17').prop('checked', true);
        return;
    } else {
        $('#12').prop('checked', false);
        $('#17').prop('checked', false);
    }
});

$('#15').change(function() {
    if ($(this).prop("checked")) {
        $('#12').prop('checked', true);
        $('#13').prop('checked', true);
        $('#17').prop('checked', true);
        return;
    } else {
        $('#12').prop('checked', false);
        $('#13').prop('checked', false);
        $('#17').prop('checked', false);
    }
});

$('#16').change(function() {
    if ($(this).prop("checked")) {
        $('#12').prop('checked', true);
        $('#13').prop('checked', true);
        $('#17').prop('checked', true);
        return;
    } else {
        $('#12').prop('checked', false);
        $('#13').prop('checked', false);
        $('#17').prop('checked', false);
    }
});

//---------------------------------PRODUCTO
$('#17').change(function() {
    if ($(this).prop("checked")) {
        $('#18').prop('checked', true);
        $('#19').prop('checked', true);
        $('#20').prop('checked', true);
        $('#21').prop('checked', true);
        $('#22').prop('checked', true);
        $('#23').prop('checked', true);
        return;
    } else {
        $('#18').prop('checked', false);
        $('#19').prop('checked', false);
        $('#20').prop('checked', false);
        $('#21').prop('checked', false);
        $('#22').prop('checked', false);
        $('#23').prop('checked', false);
        return;
    }
});

$('#18').change(function() {
    if ($(this).prop("checked")) {
        $('#17').prop('checked', true);
        return;
    } else {
        $('#17').prop('checked', false);
    }
});

$('#19').change(function() {
    if ($(this).prop("checked")) {
        $('#17').prop('checked', true);
        return;
    } else {
        $('#17').prop('checked', false);
    }
});

$('#20').change(function() {
    if ($(this).prop("checked")) {
        $('#17').prop('checked', true);
        $('#18').prop('checked', true);
        return;
    } else {
        $('#17').prop('checked', false);
        $('#18').prop('checked', false);
    }
});

$('#21').change(function() {
    if ($(this).prop("checked")) {
        $('#17').prop('checked', true);
        $('#18').prop('checked', true);
        return;
    } else {
        $('#17').prop('checked', false);
        $('#18').prop('checked', false);
    }
});

$('#22').change(function() {
    if ($(this).prop("checked")) {
        $('#21').prop('checked', true);
        $('#17').prop('checked', true);
        return;
    } else {
        $('#21').prop('checked', false);
        $('#17').prop('checked', false);
    }
});

$('#23').change(function() {
    if ($(this).prop("checked")) {
        $('#18').prop('checked', true);
        $('#17').prop('checked', true);

        return;
    } else {
        $('#18').prop('checked', false);
        $('#17').prop('checked', false);
        return;
    }
});

//--------------------------USUARIO
$('#24').change(function() {
    if ($(this).prop("checked")) {
        $('#25').prop('checked', true);
        $('#26').prop('checked', true);
        $('#27').prop('checked', true);
        $('#28').prop('checked', true);
        $('#29').prop('checked', true);
        return;
    } else {
        $('#25').prop('checked', false);
        $('#26').prop('checked', false);
        $('#27').prop('checked', false);
        $('#28').prop('checked', false);
        $('#29').prop('checked', false);
    }
});

$('#25').change(function() {
    if ($(this).prop("checked")) {
        $('#24').prop('checked', true);
        return;
    } else {
        $('#24').prop('checked', false);
    }
});

$('#26').change(function() {
    if ($(this).prop("checked")) {
        $('#24').prop('checked', true);
        return;
    } else {
        $('#24').prop('checked', false);
    }
});

$('#27').change(function() {
    if ($(this).prop("checked")) {
        $('#24').prop('checked', true);
        $('#25').prop('checked', true);
        return;
    } else {
        $('#24').prop('checked', false);
        $('#25').prop('checked', false);
    }
});

$('#28').change(function() {
    if ($(this).prop("checked")) {
        $('#24').prop('checked', true);
        $('#25').prop('checked', true);
        return;
    } else {
        $('#24').prop('checked', false);
        $('#25').prop('checked', false);
    }
});

$('#29').change(function() {
    if ($(this).prop("checked")) {
        $('#24').prop('checked', true);
        $('#25').prop('checked', true);
        return;
    } else {
        $('#24').prop('checked', false);
        $('#25').prop('checked', false);
    }
});

//------------------------CARRITO
// $('#30').change(function () {
//     if ($(this).prop("checked")) {
//         $('#25').prop('checked', true);
//         $('#26').prop('checked', true);
//         $('#27').prop('checked', true);
//         $('#28').prop('checked', true);
//         $('#29').prop('checked', true);
//         return;
//     }else {
//         $('#25').prop('checked', false);
//         $('#26').prop('checked', false);
//         $('#27').prop('checked', false);
//         $('#28').prop('checked', false);
//         $('#29').prop('checked', false);
//     }
// });

//------------------------------COTIZACIONES
$('#36').change(function() {
    if ($(this).prop("checked")) {
        $('#35').prop('checked', true);
        $('#37').prop('checked', true);
        $('#38').prop('checked', true);
        $('#39').prop('checked', true);
        $('#40').prop('checked', true);
        $('#41').prop('checked', true);
        $('#42').prop('checked', true);
        $('#30').prop('checked', true);
        return;
    } else {
        $('#35').prop('checked', false);
        $('#37').prop('checked', false);
        $('#38').prop('checked', false);
        $('#39').prop('checked', false);
        $('#40').prop('checked', false);
        $('#41').prop('checked', false);
        $('#42').prop('checked', false);
        $('#30').prop('checked', false);
    }
});

$('#37').change(function() {
    if ($(this).prop("checked")) {
        $('#35').prop('checked', true);
        $('#36').prop('checked', true);
        return;
    } else {
        $('#35').prop('checked', false);
        $('#36').prop('checked', false);
    }
});

$('#38').change(function() {
    if ($(this).prop("checked")) {
        $('#35').prop('checked', true);
        $('#30').prop('checked', true);
        $('#39').prop('checked', true);
        return;
    } else {
        $('#35').prop('checked', false);
        $('#30').prop('checked', false);
        $('#39').prop('checked', false);
    }
});

$('#39').change(function() {
    if ($(this).prop("checked")) {
        $('#35').prop('checked', true);
        $('#30').prop('checked', true);
        $('#38').prop('checked', true);
        return;
    } else {
        $('#35').prop('checked', false);
        $('#30').prop('checked', false);
        $('#38').prop('checked', false);
    }
});

$('#40').change(function() {
    if ($(this).prop("checked")) {
        $('#35').prop('checked', true);
        $('#36').prop('checked', true);
        $('#37').prop('checked', true);
        $('#30').prop('checked', true);
        $('#31').prop('checked', true);
        $('#39').prop('checked', true);
        $('#41').prop('checked', true);
        return;
    } else {
        $('#35').prop('checked', false);
        $('#36').prop('checked', false);
        $('#37').prop('checked', false);
        $('#30').prop('checked', false);
        $('#31').prop('checked', false);
        $('#39').prop('checked', false);
        $('#41').prop('checked', false);
    }
});

$('#41').change(function() {
    if ($(this).prop("checked")) {
        $('#35').prop('checked', true);
        $('#36').prop('checked', true);
        $('#37').prop('checked', true);
        $('#30').prop('checked', true);
        $('#31').prop('checked', true);
        $('#39').prop('checked', true);
        $('#40').prop('checked', true);
        return;
    } else {
        $('#35').prop('checked', false);
        $('#36').prop('checked', false);
        $('#37').prop('checked', false);
        $('#30').prop('checked', false);
        $('#31').prop('checked', false);
        $('#39').prop('checked', false);
        $('#40').prop('checked', false);
    }
});

$('#42').change(function() {
    if ($(this).prop("checked")) {
        $('#35').prop('checked', true);
        $('#36').prop('checked', true);
        $('#37').prop('checked', true);
        return;
    } else {
        $('#35').prop('checked', false);
        $('#36').prop('checked', false);
        $('#37').prop('checked', false);
    }
});

//--------------------------PEDIDO
$('#43').change(function() {
    if ($(this).prop("checked")) {
        $('#44').prop('checked', true);
        $('#46').prop('checked', true);
        $('#58').prop('checked', true);
        $('#59').prop('checked', true);
        $('#53').prop('checked', true);
        $('#49').prop('checked', true);
        $('#52').prop('checked', true);
        $('#54').prop('checked', true);
        $('#45').prop('checked', true);
        $('#55').prop('checked', true);
        $('#35').prop('checked', true);
        $('#48').prop('checked', true);
        $('#50').prop('checked', true);
        $('#51').prop('checked', true);
        $('#47').prop('checked', true);
        return;
    } else {
        $('#44').prop('checked', false);
        $('#46').prop('checked', false);
        $('#47').prop('checked', false);
        $('#58').prop('checked', false);
        $('#59').prop('checked', false);
        $('#53').prop('checked', false);
        $('#49').prop('checked', false);
        $('#52').prop('checked', false);
        $('#54').prop('checked', false);
        $('#45').prop('checked', false);
        $('#55').prop('checked', false);
        $('#35').prop('checked', false);
        $('#48').prop('checked', false);
        $('#50').prop('checked', false);
        $('#51').prop('checked', false);
    }
});

//-------------------------PEDIDO LISTAR
$('#44').change(function() {
    if ($(this).prop("checked")) {
        $('#43').prop('checked', true);
        $('#35').prop('checked', true);
    } else {
        $('#43').prop('checked', false);
        $('#35').prop('checked', false);
    }
});

//---------------------PEDIDO CREAR
$('#45').change(function() {
    if ($(this).prop("checked")) {
        $('#46').prop('checked', true);
        $('#50').prop('checked', true);
        $('#52').prop('checked', true);
        $('#43').prop('checked', true);
        $('#51').prop('checked', true);
        $('#55').prop('checked', true);
        $('#54').prop('checked', true);
        $('#35').prop('checked', true);
        return;
    } else {
        $('#46').prop('checked', false);
        $('#50').prop('checked', false);
        $('#52').prop('checked', false);
        $('#43').prop('checked', false);
        $('#51').prop('checked', false);
        $('#55').prop('checked', false);
        $('#54').prop('checked', false);
        $('#35').prop('checked', false);
    }
});

//-----------------------------CARRITO PEDIDO
$('#46').change(function() {
    if ($(this).prop("checked")) {
        $('#43').prop('checked', true);
        $('#44').prop('checked', true);
        $('#45').prop('checked', true);
        $('#47').prop('checked', true);
        $('#48').prop('checked', true);
        $('#49').prop('checked', true);
        $('#50').prop('checked', true);
        $('#35').prop('checked', true);
    } else {
        $('#43').prop('checked', false);
        $('#44').prop('checked', false);
        $('#45').prop('checked', false);
        $('#47').prop('checked', false);
        $('#48').prop('checked', false);
        $('#49').prop('checked', false);
        $('#50').prop('checked', false);
        $('#35').prop('checked', false);
    }
});

//----------------------------------PEDIDO VER INFORMACIÓN
$('#47').change(function() {
    if ($(this).prop("checked")) {
        $('#43').prop('checked', true);
        $('#44').prop('checked', true);
        $('#35').prop('checked', true);
    } else {
        $('#43').prop('checked', false);
        $('#44').prop('checked', false);
        $('#35').prop('checked', false);
    }
});

//----------------------------------EDITAR PEDIDO
$('#48').change(function() {
    if ($(this).prop("checked")) {
        $('#43').prop('checked', true);
        $('#44').prop('checked', true);
        $('#46').prop('checked', true);
        $('#54').prop('checked', true);
        $('#51').prop('checked', true);
        $('#53').prop('checked', true);
        $('#45').prop('checked', true);
        $('#49').prop('checked', true);
        $('#55').prop('checked', true);
        $('#35').prop('checked', true);
    } else {
        $('#43').prop('checked', false);
        $('#44').prop('checked', false);
        $('#46').prop('checked', false);
        $('#54').prop('checked', false);
        $('#51').prop('checked', false);
        $('#53').prop('checked', false);
        $('#45').prop('checked', false);
        $('#49').prop('checked', false);
        $('#55').prop('checked', false);
        $('#35').prop('checked', false);
    }
});

//--------------------------------PEDIDO CANCELAR
$('#49').change(function() {
    if ($(this).prop("checked")) {
        $('#44').prop('checked', true);
        $('#53').prop('checked', true);
        $('#43').prop('checked', true);
        $('#52').prop('checked', true);
        $('#54').prop('checked', true);
        $('#45').prop('checked', true);
        $('#55').prop('checked', true);
        $('#35').prop('checked', true);
        $('#48').prop('checked', true);
        $('#50').prop('checked', true);
        $('#51').prop('checked', true);
        $('#47').prop('checked', true);
        return;
    } else {
        $('#44').prop('checked', false);
        $('#47').prop('checked', false);
        $('#53').prop('checked', false);
        $('#43').prop('checked', false);
        $('#52').prop('checked', false);
        $('#54').prop('checked', false);
        $('#45').prop('checked', false);
        $('#55').prop('checked', false);
        $('#35').prop('checked', false);
        $('#48').prop('checked', false);
        $('#50').prop('checked', false);
        $('#51').prop('checked', false);
    }
});

//--------------------------PEDIDO LIMPIAR CARRITO
$('#50').change(function() {
    if ($(this).prop("checked")) {
        $('#44').prop('checked', true);
        $('#53').prop('checked', true);
        $('#49').prop('checked', true);
        $('#43').prop('checked', true);
        $('#54').prop('checked', true);
        $('#45').prop('checked', true);
        $('#55').prop('checked', true);
        $('#35').prop('checked', true);
        $('#48').prop('checked', true);
        $('#52').prop('checked', true);
        $('#51').prop('checked', true);
        $('#47').prop('checked', true);
        $('#46').prop('checked', true);
        return;
    } else {
        $('#44').prop('checked', false);
        $('#47').prop('checked', false);
        $('#53').prop('checked', false);
        $('#49').prop('checked', false);
        $('#43').prop('checked', false);
        $('#54').prop('checked', false);
        $('#45').prop('checked', false);
        $('#55').prop('checked', false);
        $('#35').prop('checked', false);
        $('#48').prop('checked', false);
        $('#52').prop('checked', false);
        $('#51').prop('checked', false);
        $('#46').prop('checked', false);
    }
});

//-------------------------- QUITAR PRODUCTO PEDIDO
$('#51').change(function() {
    if ($(this).prop("checked")) {
        $('#44').prop('checked', true);
        $('#53').prop('checked', true);
        $('#49').prop('checked', true);
        $('#43').prop('checked', true);
        $('#54').prop('checked', true);
        $('#45').prop('checked', true);
        $('#55').prop('checked', true);
        $('#35').prop('checked', true);
        $('#48').prop('checked', true);
        $('#52').prop('checked', true);
        $('#50').prop('checked', true);
        $('#47').prop('checked', true);
        $('#46').prop('checked', true);
        return;
    } else {
        $('#44').prop('checked', false);
        $('#47').prop('checked', false);
        $('#53').prop('checked', false);
        $('#49').prop('checked', false);
        $('#43').prop('checked', false);
        $('#54').prop('checked', false);
        $('#45').prop('checked', false);
        $('#55').prop('checked', false);
        $('#35').prop('checked', false);
        $('#48').prop('checked', false);
        $('#52').prop('checked', false);
        $('#50').prop('checked', false);
        $('#46').prop('checked', false);
    }
});

//--------------------------ACTUALIZAR PRODUCTO ANTES DE
$('#52').change(function() {
    if ($(this).prop("checked")) {
        $('#44').prop('checked', true);
        $('#53').prop('checked', true);
        $('#49').prop('checked', true);
        $('#43').prop('checked', true);
        $('#54').prop('checked', true);
        $('#45').prop('checked', true);
        $('#55').prop('checked', true);
        $('#35').prop('checked', true);
        $('#48').prop('checked', true);
        $('#50').prop('checked', true);
        $('#51').prop('checked', true);
        $('#47').prop('checked', true);
        return;
    } else {
        $('#44').prop('checked', false);
        $('#47').prop('checked', false);
        $('#53').prop('checked', false);
        $('#49').prop('checked', false);
        $('#43').prop('checked', false);
        $('#54').prop('checked', false);
        $('#45').prop('checked', false);
        $('#55').prop('checked', false);
        $('#35').prop('checked', false);
        $('#48').prop('checked', false);
        $('#50').prop('checked', false);
        $('#51').prop('checked', false);
    }
});

//----------------------------EDITAR PEDIDO
$('#53').change(function() {
    if ($(this).prop("checked")) {
        $('#48').prop('checked', true);
        $('#53').prop('checked', true);
        $('#43').prop('checked', true);
        $('#44').prop('checked', true);
        $('#35').prop('checked', true);
    } else {
        $('#53').prop('checked', false);
        $('#48').prop('checked', false);
        $('#43').prop('checked', false);
        $('#44').prop('checked', false);
        $('#35').prop('checked', false);
    }
});

//--------------------------------PEDIDO PRODUCTO REALIZADO
$('#54').change(function() {
    if ($(this).prop("checked")) {
        $('#44').prop('checked', true);
        $('#46').prop('checked', true);
        $('#55').prop('checked', true);
        $('#53').prop('checked', true);
        $('#49').prop('checked', true);
        $('#52').prop('checked', true);
        $('#45').prop('checked', true);
        $('#35').prop('checked', true);
        $('#48').prop('checked', true);
        $('#50').prop('checked', true);
        $('#51').prop('checked', true);
        $('#47').prop('checked', true);
        $('#43').prop('checked', true);
        return;
    } else {
        $('#44').prop('checked', false);
        $('#47').prop('checked', false);
        $('#53').prop('checked', false);
        $('#49').prop('checked', false);
        $('#52').prop('checked', false);
        $('#45').prop('checked', false);
        $('#55').prop('checked', false);
        $('#46').prop('checked', false);
        $('#35').prop('checked', false);
        $('#48').prop('checked', false);
        $('#50').prop('checked', false);
        $('#51').prop('checked', false);
        $('#43').prop('checked', false);
    }
});

//------------------------------------PEDIDO PRODUCTO
$('#55').change(function() {
    if ($(this).prop("checked")) {
        $('#44').prop('checked', true);
        $('#46').prop('checked', true);
        $('#54').prop('checked', true);
        $('#53').prop('checked', true);
        $('#49').prop('checked', true);
        $('#52').prop('checked', true);
        $('#45').prop('checked', true);
        $('#35').prop('checked', true);
        $('#48').prop('checked', true);
        $('#50').prop('checked', true);
        $('#51').prop('checked', true);
        $('#47').prop('checked', true);
        $('#43').prop('checked', true);
        return;
    } else {
        $('#44').prop('checked', false);
        $('#53').prop('checked', false);
        $('#49').prop('checked', false);
        $('#52').prop('checked', false);
        $('#45').prop('checked', false);
        $('#35').prop('checked', false);
        $('#54').prop('checked', false);
        $('#47').prop('checked', false);
        $('#46').prop('checked', false);
        $('#48').prop('checked', false);
        $('#50').prop('checked', false);
        $('#51').prop('checked', false);
        $('#47').prop('checked', true);
        $('#43').prop('checked', false);
    }
});

//----------------------------ABONO
$('#56').change(function() {
    if ($(this).prop("checked")) {
        $('#34').prop('checked', true);
        $('#35').prop('checked', true);
        $('#57').prop('checked', true);
        $('#58').prop('checked', true);
        $('#59').prop('checked', true);
        $('#60').prop('checked', true);
        return;
    } else {
        $('#34').prop('checked', false);
        $('#35').prop('checked', false);
        $('#57').prop('checked', false);
        $('#58').prop('checked', false);
        $('#59').prop('checked', false);
        $('#60').prop('checked', false);
    }
});

$('#57').change(function() {
    if ($(this).prop("checked")) {
        $('#34').prop('checked', true);
        $('#35').prop('checked', true);
        $('#56').prop('checked', true);
        $('#57').prop('checked', true);
        return;
    } else {
        $('#34').prop('checked', false);
        $('#35').prop('checked', false);
        $('#56').prop('checked', false);
        $('#57').prop('checked', false);
    }
});

$('#58').change(function() {
    if ($(this).prop("checked")) {
        $('#34').prop('checked', true);
        $('#35').prop('checked', true);
        $('#56').prop('checked', true);
        return;
    } else {
        $('#34').prop('checked', false);
        $('#35').prop('checked', false);
        $('#56').prop('checked', false);
    }
});

$('#59').change(function() {
    if ($(this).prop("checked")) {
        $('#34').prop('checked', true);
        $('#35').prop('checked', true);
        $('#56').prop('checked', true);
        $('#57').prop('checked', true);
        return;
    } else {
        $('#34').prop('checked', false);
        $('#35').prop('checked', false);
        $('#56').prop('checked', false);
        $('#57').prop('checked', false);
    }
});

$('#60').change(function() {
    if ($(this).prop("checked")) {
        $('#34').prop('checked', true);
        $('#35').prop('checked', true);
        $('#56').prop('checked', true);
        $('#57').prop('checked', true);
        return;
    } else {
        $('#34').prop('checked', false);
        $('#35').prop('checked', false);
        $('#56').prop('checked', false);
        $('#57').prop('checked', false);
    }
});*/
</script>
<script>
$(document).ready(function() {
    $.validator.addMethod("letras", function(value, element) {
        var pattern = /^[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\s]+$/g;
        return this.optional(element) || pattern.test(value);
    }, "No se admite caracteres especiales ni espacios vacíos ni al inicio ni al final");
    jQuery.validator.addMethod("espaciosycaracteres", function(value, element) {
        return this.optional(element) || (((value).trim().length > 0) && (value).length > 3);
    }, "No dejar espacios vacíos en el campo y mayor a 3 caracteres");

    $('#form').validate({
        rules: {
            name: {
                // espaciosycaracteres:true,
                letras: true,
                required: true,
                maxlength: 100
            },
        }
    });
});
</script>
@endsection