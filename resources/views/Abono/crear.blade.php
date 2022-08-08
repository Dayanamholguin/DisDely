@extends('layouts.app')

@section('title')
Abonos
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Registrar de abono</strong>
    </div>
    <div class="card-body">
        @include('flash::message')
        @error('idPedido')
        <div class="alert alert-danger" role="alert">
            {{$message}}
        </div>
        @enderror
        @if (count($abonos)==0)
        <p class="text-center p-3">No se ha registrado ningún abono a este pedido</p>
        @endif
        <form id="form" action="/abono/guardar" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="idPedido" value="{{$pedido->id}}">
            <div class="row">
                <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <label for="">Número del pedido</label>
                        <input type="text" value="N° {{$pedido->id}}" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="">Nombre de la persona que hizo el pedido</label>
                        <input type="text" value="{{$nombreCliente}}" class="form-control" id="nombre" name="nombre"
                            readonly>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="">Comprobante de foto (Opcional)</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('img') is-invalid @enderror" name="img"
                                id="img">
                            <label class="custom-file-label" for="customFile">Subir foto de comprobante</label>
                        </div>
                        @error('img')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <label for="">Valor del pedido</label>
                        <input class="form-control" type="text" id="pPrecio" readonly value="{{$pedido->precio}}">
                    </div>
                </div>
                <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <label for="">Valor abonado</label>
                        <input class="form-control" type="text" id="nAbonos" readonly value="{{$nAbonos}}">
                    </div>
                </div>
                <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <label for="">Falta por abonar</label>
                        <input class="form-control" type="text" id="resta" readonly
                            value="{{$resta==0?$pedido->precio:$resta}}">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="">Valor a abonar<b style="color: red" data-toggle="tooltip" data-placement="top"
                                title="Requerido"> *</b></label>
                        <input type="text" value="" class="form-control @error('precioPagar') is-invalid @enderror"
                            id="precio" name="precioPagar" placeholder="Ingrese el valor a abonar al pedido" />
                        @error('precioPagar')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-between align-items-center">
                    @if (strpos(url()->previous(), "/abono/ver/"))
                    <a href="{{url()->previous()}}" class="btn btn-primary tipoletra">Volver</a>
                    @else
                    <a href="/pedido" class="btn btn-primary tipoletra">Volver</a>
                    @endif
                    <button type="submit" class="btn btn-primary tipoletra">Registrar abono</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
function number_format(number, decimals, dec_point, thousands_sep) {
    // Strip all characters but numerical ones.
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}
let nAbonos = $('#nAbonos').val();
$('#nAbonos').val(number_format(nAbonos, 0, '.', '.'));
let pPrecio = $('#pPrecio').val();
$('#pPrecio').val(number_format(pPrecio, 0, '.', '.'));
let resta = $('#resta').val();
$('#resta').val(number_format(resta, 0, '.', '.'));
$("#precio").on({
    "focus": function(event) {
        $(event.target).select();
    },
    "keyup": function(event) {
        $(event.target).val(function(index, value) {
            return value.replace(/\D/g, "")
                .replace(/([0-9])([0-9]{3})$/, '$1.$2')
                .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
        });
    }

});
$(document).ready(function() {

    jQuery.validator.addMethod("cero", function(value, element) {
        return this.optional(element) || parseInt(value) > 0;
    }, "Debe ser mayor a cero");

    $('#form').validate({
        rules: {
            precioPagar: {
                cero: true,
                required: true,
                max: 999999,

            },
        }
    });
});
</script>
@endsection