@extends('layouts.app')

@section('title')
Pedidos
@endsection

@section('content')
<div class="card">
    <div class="card-header text-center">
        <strong>Requisitos para el pedido</strong> 
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 text-center">
                <p>Para que puedas registrar un pedido necesitamos que llenes los siguientes campos.</p>
            </div>   
        </div>
        @include('flash::message')
        <form id="form" action="/pedido/crear" method="post">
            @csrf
            <div class="row mt-3">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="">Seleccione cómo quiere el cliente para realizar el pedido<strong style="color: red"> *</strong></label>
                        <select name="cliente" class="form-control @error('cliente') is-invalid @enderror" onchange="mostrarUsuarios(this.value);">
                            <option value="">Seleccione</option>
                            <option value="1" {{old('cliente' ) == 1 ? 'selected' : ''}}>Cliente genérico</option>
                            <option value="2" {{old('cliente' ) == 2 ? 'selected' : ''}}>Cliente registrado en el sistema</option>
                        </select>
                        @error('cliente')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="">Seleccione cómo quiere hacer el pedido<strong style="color: red"> *</strong></label>
                        <select name="producto" class="form-control @error('producto') is-invalid @enderror">
                            <option value="" >Seleccione</option>
                            <option value="1" {{old('producto' ) == 1 ? 'selected' : ''}}>Producto personalizado</option>
                            <option value="2" {{old('producto' ) == 2 ? 'selected' : ''}}>Producto registrado en el sistema</option>
                        </select>
                        @error('producto')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12 col-sm-12" id="clientes" style="display: none;">
                    <div class="form-group">
                        <label for="">Seleccione el usuario al cual le hará el pedido<strong style="color: red"> *</strong></label>
                        <select name="todosClientes" id="todosClientes" class="form-control @error('todosClientes') is-invalid @enderror">

                        </select>
                        @error('todosClientes')
                            <div class="alert alert-danger" role="alert">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="card-body d-flex justify-content-start">
                    <a href="/pedido" class="btn btn-primary mr-3">Volver</a>
                </div>
                <div class="card-body d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Siguiente</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function mostrarUsuarios(id) {
        const clientes = $('#todosClientes');
        if (id==2) {
            $("#clientes").show();
            $.ajax({
                url: `/pedido/buscarUsuarios`,
                type: "GET",
                success: function (res) {
                    clientes.append($("<option>", {
                            value: '',
                            text: res.length>0?'Seleccione':'No se encontraron clientes'
                    }));
                    res.forEach(function(cliente) {
                        clientes.append($("<option>", {
                            value: cliente.id, 
                            text: cliente.nombre + " " + cliente.apellido + " - " + cliente.email
                        }));
                    });
                },
            });
        } else if (id==1) {
            $("#clientes").hide();
            clientes.empty();
        }
        
    }
</script>

@endsection