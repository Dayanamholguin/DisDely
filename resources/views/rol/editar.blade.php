@extends('layouts.app')

@section('title')
Roles
@endsection

@section('content')
<div class="card">      
    <div class="card-header text-center">
        <strong>Editar Rol</strong>
    </div>
    <div class="card-body">
        @include('flash::message')
        <form id="form1" action="/rol/actualizar" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$rol->id}}" />
            <div class="container mt-1">
                <div class="row ">
                    <div class="col-auto">
                        <div class="form-group">
                            <label for="">Nombre<strong style="color: red"> *</strong></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{$rol->name}}" required">
                            
                            @error('name')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <br>
                        <div class="form-group">
                            <h5>Lista de permisos<strong style="color: red"> *</strong></h5>
                            <div class="row">
                                @foreach ($permisos as $value)
                                    <div class="col-4">
                                        <label>
                                            <input type="checkbox"
                                            @foreach($rolPermisos as $rolPermiso)
                                                @if ($value->id == $rolPermiso->permission_id)
                                                    {{'checked'}}
                                                @endif 
                                            @endforeach
                                            name="permisos[]" value="{{$value->id}}" id="{{$value->id}}"  class="mr-1 ">
                                                {{$value->description}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-12 centrado">
                            <button type="submit" class="btn btn-primary tipoletra">Editar</button>
                            <a href="/rol" class="btn btn-primary tipoletra">Volver</a>
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
$(document).ready(function() {
    $("#name").focusout(function(event) {
        console.log();
        if($(this).val().length > 0){
            // $(this).addClass("is-valid").removeClass("is-invalid");
            $(this).rules('remove');
        } 
        else {
            $(this).valid();
            $(this).addClass("is-invalid").removeClass("is-valid");
        }
    });
    $('#form').validate({
        rules: {
            name: {
                mouseout: true,
                required: true,
            }
        },
    });
});
</script>
<script>
    //-------------------------------ROLES
    $('#1').change(function () {
        if ($(this).prop("checked")) {
            $('#2').prop('checked', true);
            $('#3').prop('checked', true);
            $('#4').prop('checked', true);
            $('#5').prop('checked', true);
            $('#6').prop('checked', true);
            return;
        }else {
            $('#2').prop('checked', false);
            $('#3').prop('checked', false);
            $('#4').prop('checked', false);
            $('#5').prop('checked', false);
            $('#6').prop('checked', false);
        }
    });

    $('#2').change(function () {
        if ($(this).prop("checked")) {
            $('#1').prop('checked', true);
            return;
        }else {
            $('#1').prop('checked', false);
        }
    });

    $('#3').change(function () {
        if ($(this).prop("checked")) {
            $('#1').prop('checked', true);
            return;
        }else {
            $('#1').prop('checked', false);
        }
    });

    $('#4').change(function () {
        if ($(this).prop("checked")) {
            $('#1').prop('checked', true);
            $('#2').prop('checked', true);
            return;
        }else {
            $('#1').prop('checked', false);
            $('#2').prop('checked', false);
        }
    });

    $('#5').change(function () {
        if ($(this).prop("checked")) {
            $('#1').prop('checked', true);
            $('#2').prop('checked', true);
            return;
        }else {
            $('#1').prop('checked', false);
            $('#2').prop('checked', false);
        }
    });

    $('#6').change(function () {
        if ($(this).prop("checked")) {
            $('#1').prop('checked', true);
            $('#2').prop('checked', true);
            return;
        }else {
            $('#1').prop('checked', false);
            $('#2').prop('checked', false);
        }
    });

    //------------------------------------SABORES
    $('#7').change(function () {
        if ($(this).prop("checked")) {
            $('#8').prop('checked', true);
            $('#9').prop('checked', true);
            $('#10').prop('checked', true);
            $('#11').prop('checked', true);
            $('#17').prop('checked', true);
            return;
        }else {
            $('#8').prop('checked', false);
            $('#9').prop('checked', false);
            $('#10').prop('checked', false);
            $('#11').prop('checked', false);
            $('#17').prop('checked', false);
        }
    });

    $('#8').change(function () {
        if ($(this).prop("checked")) {
            $('#7').prop('checked', true);
            $('#17').prop('checked', true);
            return;
        }else {
            $('#7').prop('checked', false);
            $('#17').prop('checked', false);
        }
    });

    $('#9').change(function () {
        if ($(this).prop("checked")) {
            $('#7').prop('checked', true);
            $('#17').prop('checked', true);
            return;
        }else {
            $('#7').prop('checked', false);
            $('#17').prop('checked', false);
        }
    });

    $('#10').change(function () {
        if ($(this).prop("checked")) {
            $('#7').prop('checked', true);
            $('#8').prop('checked', true);
            $('#17').prop('checked', true);
            return;
        }else {
            $('#7').prop('checked', false);
            $('#8').prop('checked', false);
            $('#17').prop('checked', false);
        }
    });

    $('#11').change(function () {
        if ($(this).prop("checked")) {
            $('#7').prop('checked', true);
            $('#8').prop('checked', true);
            $('#17').prop('checked', true);
            return;
        }else {
            $('#7').prop('checked', false);
            $('#8').prop('checked', false);
            $('#17').prop('checked', true);
        }
    });

    //---------------------------CATEGORIAS
    $('#12').change(function () {
        if ($(this).prop("checked")) {
            $('#13').prop('checked', true);
            $('#14').prop('checked', true);
            $('#15').prop('checked', true);
            $('#16').prop('checked', true);
            $('#17').prop('checked', true);
            return;
        }else {
            $('#13').prop('checked', false);
            $('#14').prop('checked', false);
            $('#15').prop('checked', false);
            $('#16').prop('checked', false);
            $('#17').prop('checked', false);
        }
    });

    $('#13').change(function () {
        if ($(this).prop("checked")) {
            $('#12').prop('checked', true);
            $('#17').prop('checked', true);
            return;
        }else {
            $('#12').prop('checked', false);
            $('#17').prop('checked', false);
        }
    });

    $('#14').change(function () {
        if ($(this).prop("checked")) {
            $('#12').prop('checked', true);
            $('#17').prop('checked', true);
            return;
        }else {
            $('#12').prop('checked', false);
            $('#17').prop('checked', false);
        }
    });

    $('#15').change(function () {
        if ($(this).prop("checked")) {
            $('#12').prop('checked', true);
            $('#13').prop('checked', true);
            $('#17').prop('checked', true);
            return;
        }else {
            $('#12').prop('checked', false);
            $('#13').prop('checked', false);
            $('#17').prop('checked', false);
        }
    });

    $('#16').change(function () {
        if ($(this).prop("checked")) {
            $('#12').prop('checked', true);
            $('#13').prop('checked', true);
            $('#17').prop('checked', true);
            return;
        }else {
            $('#12').prop('checked', false);
            $('#13').prop('checked', false);
            $('#17').prop('checked', false);
        }
    });

    //---------------------------------PRODUCTO
    $('#17').change(function () {
        if ($(this).prop("checked")) {
            $('#18').prop('checked', true);
            $('#19').prop('checked', true);
            $('#20').prop('checked', true);
            $('#21').prop('checked', true);
            $('#22').prop('ckecked', true);
            return;
        }else {
            $('#18').prop('checked', false);
            $('#19').prop('checked', false);
            $('#20').prop('checked', false);
            $('#21').prop('checked', false);
            $('#22').prop('checked', false);
        }
    });

    $('#18').change(function () {
        if ($(this).prop("checked")) {
            $('#17').prop('checked', true);
            return;
        }else {
            $('#17').prop('checked', false);
        }
    });

    $('#19').change(function () {
        if ($(this).prop("checked")) {
            $('#17').prop('checked', true);
            return;
        }else {
            $('#17').prop('checked', false);
        }
    });

    $('#20').change(function () {
        if ($(this).prop("checked")) {
            $('#17').prop('checked', true);
            $('#18').prop('checked', true);
            return;
        }else {
            $('#17').prop('checked', false);
            $('#18').prop('checked', false);
        }
    });

    $('#21').change(function () {
        if ($(this).prop("checked")) {
            $('#17').prop('checked', true);
            $('#18').prop('checked', true);
            return;
        }else {
            $('#17').prop('checked', false);
            $('#18').prop('checked', false);
        }
    });

    $('#22').change(function () {
        if ($(this).prop("checked")) {
            $('#21').prop('checked', true);
            $('#17').prop('ckecked', true);
            return;
        }else {
            $('#21').prop('checked', false);
            $('#17').prop('checked', false);
        }
    });

    $('#23').change(function () {
        if ($(this).prop("checked")) {
            $('#18').prop('checked', true);
            $('#17').prop('ckecked', true);
            return;
        }else {
            $('#18').prop('checked', false);
            $('#17').prop('checked', false);
        }
    });

    //--------------------------USUARIO
    $('#24').change(function () {
        if ($(this).prop("checked")) {
            $('#25').prop('checked', true);
            $('#26').prop('ckecked', true);
            $('#27').prop('checked', true);
            $('#28').prop('checked', true);
            $('#29').prop('checked', true);
            return;
        }else {
            $('#25').prop('checked', false);
            $('#26').prop('ckecked', false);
            $('#27').prop('checked', false);
            $('#28').prop('checked', false);
            $('#29').prop('checked', false);
        }
    });

    $('#25').change(function () {
        if ($(this).prop("checked")) {
            $('#24').prop('checked', true);
            return;
        }else {
            $('#24').prop('checked', false);
        }
    });

    $('#26').change(function () {
        if ($(this).prop("checked")) {
            $('#24').prop('checked', true);
            return;
        }else {
            $('#24').prop('checked', false);
        }
    });

    $('#27').change(function () {
        if ($(this).prop("checked")) {
            $('#24').prop('checked', true);
            $('#25').prop('ckecked', true);
            return;
        }else {
            $('#24').prop('checked', false);
            $('#25').prop('ckecked', false);
        }
    });

    $('#28').change(function () {
        if ($(this).prop("checked")) {
            $('#24').prop('checked', true);
            $('#25').prop('ckecked', true);
            return;
        }else {
            $('#24').prop('checked', false);
            $('#25').prop('ckecked', false);
        }
    });

    $('#29').change(function () {
        if ($(this).prop("checked")) {
            $('#24').prop('checked', true);
            $('#25').prop('ckecked', true);
            return;
        }else {
            $('#24').prop('checked', false);
            $('#25').prop('ckecked', false);
        }
    });

    //------------------------CARRITO
    // $('#30').change(function () {
    //     if ($(this).prop("checked")) {
    //         $('#25').prop('checked', true);
    //         $('#26').prop('ckecked', true);
    //         $('#27').prop('checked', true);
    //         $('#28').prop('checked', true);
    //         $('#29').prop('checked', true);
    //         return;
    //     }else {
    //         $('#25').prop('checked', false);
    //         $('#26').prop('ckecked', false);
    //         $('#27').prop('checked', false);
    //         $('#28').prop('checked', false);
    //         $('#29').prop('checked', false);
    //     }
    // });

    //------------------------------COTIZACIONES
    $('#36').change(function () {
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
        }else {
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

    $('#37').change(function () {
        if ($(this).prop("checked")) {
            $('#35').prop('checked', true);
            $('#36').prop('checked', true);
            return;
        }else {
            $('#35').prop('checked', false);
            $('#36').prop('checked', false);
        }
    });

    $('#38').change(function () {
        if ($(this).prop("checked")) {
            $('#35').prop('checked', true);
            $('#30').prop('checked', true);
            $('#39').prop('checked', true);
            return;
        }else {
            $('#35').prop('checked', false);
            $('#30').prop('checked', false);
            $('#39').prop('checked', false);
        }
    });

    $('#39').change(function () {
        if ($(this).prop("checked")) {
            $('#35').prop('checked', true);
            $('#30').prop('checked', true);
            $('#38').prop('checked', true);
            return;
        }else {
            $('#35').prop('checked', false);
            $('#30').prop('checked', false);
            $('#38').prop('checked', false);
        }
    });

    $('#40').change(function () {
        if ($(this).prop("checked")) {
            $('#35').prop('checked', true);
            $('#36').prop('checked', true);
            $('#37').prop('checked', true);
            $('#30').prop('checked', true);
            $('#31').prop('checked', true);
            $('#39').prop('checked', true);
            $('#41').prop('checked', true);
            return;
        }else {
            $('#35').prop('checked', false);
            $('#36').prop('checked', false);
            $('#37').prop('checked', false);
            $('#30').prop('checked', false);
            $('#31').prop('checked', false);
            $('#39').prop('checked', false);
            $('#41').prop('checked', false);
        }
    });

    $('#41').change(function () {
        if ($(this).prop("checked")) {
            $('#35').prop('checked', true);
            $('#36').prop('checked', true);
            $('#37').prop('checked', true);
            $('#30').prop('checked', true);
            $('#31').prop('checked', true);
            $('#39').prop('checked', true);
            $('#40').prop('checked', true);
            return;
        }else {
            $('#35').prop('checked', false);
            $('#36').prop('checked', false);
            $('#37').prop('checked', false);
            $('#30').prop('checked', false);
            $('#31').prop('checked', false);
            $('#39').prop('checked', false);
            $('#40').prop('checked', false);
        }
    });

    $('#42').change(function () {
        if ($(this).prop("checked")) {
            $('#35').prop('checked', true);
            $('#36').prop('checked', true);
            $('#37').prop('checked', true);
            return;
        }else {
            $('#35').prop('checked', false);
            $('#36').prop('checked', false);
            $('#37').prop('checked', false);
        }
    });

    //--------------------------PEDIDO
    $('#43').change(function () {
        if ($(this).prop("checked")) {
            $('#44').prop('checked', true);
            $('#58').prop('checked', true); 
            $('#46').prop('checked', true);
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
        }else {
            $('#44').prop('checked', false);
            $('#47').prop('checked', false);
            $('#46').prop('checked', false);
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
    $('#44').change(function () {
        if ($(this).prop("checked")) {
            $('#43').prop('checked', true);
            $('#35').prop('checked', true);
        }else {
            $('#43').prop('checked', false);
            $('#35').prop('checked', false);
        }
    });

    //---------------------PEDIDO CREAR
    $('#45').change(function () {
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
        }else {
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
    $('#46').change(function () {
        if ($(this).prop("checked")) {
            $('#43').prop('checked', true);
            $('#44').prop('checked', true);
            $('#45').prop('checked', true);
            $('#47').prop('checked', true);
            $('#48').prop('checked', true);
            $('#49').prop('checked', true);
            $('#50').prop('checked', true);
            $('#35').prop('checked', true);
        }else {
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
    $('#47').change(function () {
        if ($(this).prop("checked")) {
            $('#43').prop('checked', true);
            $('#44').prop('checked', true);
            $('#35').prop('checked', true);
        }else {
            $('#43').prop('checked', false);
            $('#44').prop('checked', false);
            $('#35').prop('checked', false);
        }
    });

    //----------------------------------EDITAR PEDIDO
    $('#48').change(function () {
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
        }else {
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
    $('#49').change(function () {
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
        }else {
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
    $('#50').change(function () {
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
        }else {
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
    $('#51').change(function () {
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
        }else {
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
    $('#52').change(function () {
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
        }else {
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
    $('#53').change(function () {
        if ($(this).prop("checked")) {
            $('#48').prop('checked', true);
            $('#53').prop('checked', true);
            $('#43').prop('checked', true);
            $('#44').prop('checked', true);
            $('#35').prop('checked', true);
        }else {
            $('#53').prop('checked', false);
            $('#48').prop('checked', false);
            $('#43').prop('checked', false);
            $('#44').prop('checked', false);
            $('#35').prop('checked', false);
        }
    });

    //--------------------------------PEDIDO PRODUCTO REALIZADO
    $('#54').change(function () {
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
        }else {
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
    $('#55').change(function () {
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
        }else {
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
    $('#56').change(function () {
        if ($(this).prop("checked")) {
            $('#35').prop('checked', true);
            $('#57').prop('checked', true);
            $('#58').prop('checked', true);
            $('#59').prop('checked', true);
            $('#60').prop('checked', true);
            return;
        }else {
            $('#35').prop('checked', false);
            $('#57').prop('checked', false);
            $('#58').prop('checked', false);
            $('#59').prop('checked', false);
            $('#60').prop('checked', false);
        }
    });

    $('#57').change(function () {
        if ($(this).prop("checked")) {
            $('#35').prop('checked', true);
            $('#56').prop('checked', true);
            $('#57').prop('checked', true);
            return;
        }else {
            $('#35').prop('checked', false);
            $('#56').prop('checked', false);
            $('#57').prop('checked', false);
        }
    });

    $('#58').change(function () {
        if ($(this).prop("checked")) {
            $('#35').prop('checked', true);
            $('#56').prop('checked', true);
            return;
        }else {
            $('#35').prop('checked', false);
            $('#56').prop('checked', false);
        }
    });

    $('#59').change(function () {
        if ($(this).prop("checked")) {
            $('#35').prop('checked', true);
            $('#56').prop('checked', true);
            $('#57').prop('checked', true);
            return;
        }else {
            $('#35').prop('checked', false);
            $('#56').prop('checked', false);
            $('#57').prop('checked', false);
        }
    });    

    $('#60').change(function () {
        if ($(this).prop("checked")) {
            $('#35').prop('checked', true);
            $('#56').prop('checked', true);
            $('#57').prop('checked', true);
            return;
        }else {
            $('#35').prop('checked', false);
            $('#56').prop('checked', false);
            $('#57').prop('checked', false);
        }
    });  
</script>
@endsection