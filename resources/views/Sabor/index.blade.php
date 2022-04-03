@extends('layouts.app')

@section('title')
Gestión de Sabores
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <strong>Registrar Sabor</strong>
        <a href="/sabor/crear" class="btn btn-success">Crear</a>
    </div>
    <div class="card-body">
      
        <table id="sabores" class="table" style="width: 100%;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Editar</th>
                    <th>Cambiar Estado</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>

    </div>
</div>
@endsection

@section("scripts")
<script>
    $(document).ready(function() {
        $('#sabores').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/sabor/listar',
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'nombre',
                    name: 'nombre'
                },
                {
                    data: 'estado',
                    name: 'estado'
                },
                {
                    data: 'editar',
                    name: 'editar',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'cambiar',
                    name: 'cambiar',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });
</script>
@endsection