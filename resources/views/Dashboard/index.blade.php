@extends('layouts.app')

@section('title')
Dashboard
@endsection

@section('content')
<div class="text-center">
    <h3 >Dashboard</h3>
</div>
<hr>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <h6 class="text-center">Estado de cotizaciones</h6>
            <canvas id="myChart" width="100" height="50"></canvas>
        </div>
        <div class="col-md-4 col-sm-12">
            <h6 class="text-center">Estado de pedidos</h6>
            <canvas id="myChart2" width="100" height="50"></canvas>
        </div>
        <div class="col-md-4 col-sm-12">
            <h6 class="text-center">Abonos pagos y no pagos</h6>
            <canvas id="myChart3" width="100" height="50"></canvas>
        </div>
        
        <div class="col-md-6 col-sm-12 mt-5">
            <h6 class="text-center">Productos más cotizados</h6>
            <canvas id="myChart4" width="100" height="50"></canvas>
        </div>
        <div class="col-md-6 col-sm-12 mt-5">
            <h6 class="text-center">Productos más pedidos</h6>
            <canvas id="myChart5" width="100" height="50"></canvas>
        </div>
        <div class="col-md-6 col-sm-12 mt-5">
            <h6 class="text-center">Clientes que más relizan pedidos</h6>
            <canvas id="myChart6" width="100" height="50"></canvas>
        </div>
        <div class="col-md-6 col-sm-12 mt-5">
            <h6 class="text-center">Clientes que más cotizan</h6>
            <canvas id="myChart7" width="100" height="50"></canvas>
        </div>
    </div>
</div>
@endsection

@section("scripts")
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            var cData = <?php echo json_encode($data)?>;
            // console.log(cData);
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'polarArea',
                data: {
                    labels: cData.estado,
                    datasets: [{
                        label: 'Estado de cotizaciones',
                        data: cData.data,
                        backgroundColor: [
                            '#6c757d',
                            '#17a2b8',
                            '#28a745'
                            // 'rgba(255, 99, 132, 0.2)',
                            // 'rgba(54, 162, 235, 0.2)',
                            // 'rgba(255, 206, 86, 0.2)',
                            // 'rgba(75, 192, 192, 0.2)',
                            // 'rgba(153, 102, 255, 0.2)',
                            // 'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            '#6c757d',
                            '#17a2b8',
                            '#28a745'
                            // 'rgba(255, 99, 132, 1)',
                            // 'rgba(54, 162, 235, 1)',
                            // 'rgba(255, 206, 86, 1)',
                            // 'rgba(75, 192, 192, 1)',
                            // 'rgba(153, 102, 255, 1)',
                            // 'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    // scales: {
                    //     y: {
                    //         beginAtZero: true
                    //     }
                    // }
                }
            });

            var cDataP = <?php echo json_encode($dataPedido)?>;
            const ctx2 = document.getElementById('myChart2').getContext('2d');
            const myChart2 = new Chart(ctx2, {
                type: 'pie',
                data: {
                    labels: cDataP.estado,
                    datasets: [{
                        label: 'Estado de pedidos',
                        data: cDataP.data,
                        backgroundColor: [
                            '#6c757d',
                            '#ffc107',
                            '#dc3545',
                            '#35b706'
                            // 'rgba(255, 99, 132, 0.2)',
                            // 'rgba(54, 162, 235, 0.2)',
                            // 'rgba(255, 206, 86, 0.2)',
                            // 'rgba(75, 192, 192, 0.2)',
                            // 'rgba(153, 102, 255, 0.2)',
                            // 'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            '#6c757d',
                            '#ffc107',
                            '#dc3545',
                            '#35b706'
                            // 'rgba(255, 99, 132, 1)',
                            // 'rgba(54, 162, 235, 1)',
                            // 'rgba(255, 206, 86, 1)',
                            // 'rgba(75, 192, 192, 1)',
                            // 'rgba(153, 102, 255, 1)',
                            // 'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    // scales: {
                    //     y: {
                    //         beginAtZero: true
                    //     }
                    // }
                }
            });

            var cDataAbo = <?php echo json_encode($dataPago)?>;
            const ctx3 = document.getElementById('myChart3').getContext('2d');
            const myChart3 = new Chart(ctx3, {
                type: 'pie',
                data: {
                    labels: cDataAbo.nombre,
                    datasets: [{
                        label: 'Abonos pagos y no pagos',
                        data: cDataAbo.data,
                        backgroundColor: [
                            '#7F8C8D',
                            '#212F3D'
                            // 'rgba(255, 99, 132, 0.2)',
                            // 'rgba(54, 162, 235, 0.2)',
                            // 'rgba(255, 206, 86, 0.2)',
                            // 'rgba(75, 192, 192, 0.2)',
                            // 'rgba(153, 102, 255, 0.2)',
                            // 'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            '#7F8C8D',
                            '#212F3D'
                            // 'rgba(255, 99, 132, 1)',
                            // 'rgba(54, 162, 235, 1)',
                            // 'rgba(255, 206, 86, 1)',
                            // 'rgba(75, 192, 192, 1)',
                            // 'rgba(153, 102, 255, 1)',
                            // 'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    // scales: {
                    //     y: {
                    //         beginAtZero: true
                    //     }
                    // }
                }
            });

            var productoCotizacion = <?php echo json_encode($datosProductoCotizacion)?>;
            const ctx4 = document.getElementById('myChart4').getContext('2d');
            const myChart4 = new Chart(ctx4, {
                type: 'bar',
                data: {
                    labels: productoCotizacion.nombre,
                    datasets: [{
                        label: 'Cantidad del producto',
                        data: productoCotizacion.data,
                        backgroundColor: [
                            '#A9DFBF',
                            // 'rgba(40, 167, 69, 0.2)',
                            '#F9E79F'
                            // 'rgba(54, 162, 235, 0.2)',
                            // 'rgba(255, 206, 86, 0.2)',
                            // 'rgba(75, 192, 192, 0.2)',
                            // 'rgba(153, 102, 255, 0.2)',
                            // 'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            '#A9DFBF',
                            // 'rgba(40, 167, 69, 0.2)',
                            '#F9E79F'
                            // 'rgba(255, 99, 132, 1)',
                            // 'rgba(54, 162, 235, 1)',
                            // 'rgba(255, 206, 86, 1)',
                            // 'rgba(75, 192, 192, 1)',
                            // 'rgba(153, 102, 255, 1)',
                            // 'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                }
            });

            var productoPedido = <?php echo json_encode($datosProductoPedido)?>;
            const ctx5 = document.getElementById('myChart5').getContext('2d');
            const myChart5 = new Chart(ctx5, {
                type: 'bar',
                data: {
                    labels: productoPedido.nombre,
                    datasets: [{
                        label: 'Cantidad del producto',
                        data: productoPedido.data,
                        backgroundColor: [
                            '#DAF7A6',
                            // 'rgba(40, 167, 69, 0.2)',
                            '#FFC300'
                            // 'rgba(54, 162, 235, 0.2)',
                            // 'rgba(255, 206, 86, 0.2)',
                            // 'rgba(75, 192, 192, 0.2)',
                            // 'rgba(153, 102, 255, 0.2)',
                            // 'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            '#DAF7A6',
                            // 'rgba(40, 167, 69, 0.2)',
                            '#FFC300'
                            // 'rgba(255, 99, 132, 1)',
                            // 'rgba(54, 162, 235, 1)',
                            // 'rgba(255, 206, 86, 1)',
                            // 'rgba(75, 192, 192, 1)',
                            // 'rgba(153, 102, 255, 1)',
                            // 'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                }
            });

            var cliente = <?php echo json_encode($clientes)?>;
            const ctx6 = document.getElementById('myChart6').getContext('2d');
            const myChart6 = new Chart(ctx6, {
                type: 'bar',
                data: {
                    labels: cliente.nombre,
                    datasets: [{
                        label: 'Pedidos realizados',
                        data: cliente.data,
                        backgroundColor: [
                            '#C70039',
                            // 'rgba(40, 167, 69, 0.2)',
                            '#FF5733'
                            // 'rgba(54, 162, 235, 0.2)',
                            // 'rgba(255, 206, 86, 0.2)',
                            // 'rgba(75, 192, 192, 0.2)',
                            // 'rgba(153, 102, 255, 0.2)',
                            // 'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            '#C70039',
                            // 'rgba(40, 167, 69, 0.2)',
                            '#FF5733'
                            // 'rgba(255, 99, 132, 1)',
                            // 'rgba(54, 162, 235, 1)',
                            // 'rgba(255, 206, 86, 1)',
                            // 'rgba(75, 192, 192, 1)',
                            // 'rgba(153, 102, 255, 1)',
                            // 'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                }
            });

            var clienteC = <?php echo json_encode($clientesCotizacion)?>;
            const ctx7 = document.getElementById('myChart7').getContext('2d');
            const myChart7 = new Chart(ctx7, {
                type: 'bar',
                data: {
                    labels: clienteC.nombre,
                    datasets: [{
                        label: 'Cotizaciones realizadas',
                        data: clienteC.data,
                        backgroundColor: [
                            '#581845',
                            // 'rgba(40, 167, 69, 0.2)',
                            '#900C3F'
                            // 'rgba(54, 162, 235, 0.2)',
                            // 'rgba(255, 206, 86, 0.2)',
                            // 'rgba(75, 192, 192, 0.2)',
                            // 'rgba(153, 102, 255, 0.2)',
                            // 'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            '#581845',
                            // 'rgba(40, 167, 69, 0.2)',
                            '#900C3F'
                            // 'rgba(255, 99, 132, 1)',
                            // 'rgba(54, 162, 235, 1)',
                            // 'rgba(255, 206, 86, 1)',
                            // 'rgba(75, 192, 192, 1)',
                            // 'rgba(153, 102, 255, 1)',
                            // 'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                }
            });
        })
    </script>
@endsection