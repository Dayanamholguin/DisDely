@extends('layouts.app')

@section('title')
Gestión de Categorías
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <strong>Registrar Categoría</strong>
        <a href="/categoria/crear" class="btn btn-success">Crear</a>
    </div>
    <div class="card-body">
      
        <table id="categorias" class="table" style="width: 100%;">
            <thead>
                <tr>
                    <th>Imagen</th>
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
        $('#categorias').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/categoria/listar',
            columns: [{
                    data: 'nombre',
                    name: 'nombre'
                },
                {
                    data: 'imagen',
                    name: 'imagen'
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