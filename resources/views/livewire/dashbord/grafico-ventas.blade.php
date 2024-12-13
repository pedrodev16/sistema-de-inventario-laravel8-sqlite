<div class="container mt-5">
    <h2>Estadísticas de Ventas</h2>

    <div class="row">
        <div class="col-md-6">
            <div class="mt-3">
                <div class="card">
                    <div class="card-body" style="border: solid 2px #41c950;
    border-radius: 32px;">
                        <h3>Ventas por Mes</h3>
                        <canvas id="chartVentasPorMes"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mt-3">
                <div class="card">
                    <div class="card-body" style="border: solid 2px #41c950;
    border-radius: 32px;">
                        <h3>Ventas por Año</h3>
                        <canvas id="chartVentasPorAno"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
    <script>
        document.addEventListener('livewire:load', function() {
            var ctxMes = document.getElementById('chartVentasPorMes').getContext('2d');
            var ctxAno = document.getElementById('chartVentasPorAno').getContext('2d');

            var ventasPorMes = @json(array_column($ventasPorMes, 'total'));
            var etiquetasMes = @json(array_column($ventasPorMes, 'mes'));
            var ventasPorAno = @json(array_column($ventasPorAno, 'total'));
            var etiquetasAno = @json(array_column($ventasPorAno, 'ano'));







            // Gráfico de Ventas por Mes
            new Chart(ctxMes, {
                type: 'line',
                data: {
                    labels: etiquetasMes,
                    datasets: [{
                        label: 'Ventas por Mes',
                        data: ventasPorMes,
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderWidth: 2,
                        fill: true,
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Gráfico de Ventas por Año
            new Chart(ctxAno, {
                type: 'line',
                data: {
                    labels: etiquetasAno,
                    datasets: [{
                        label: 'Ventas por Año',
                        data: ventasPorAno,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 2,
                        fill: true,
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });


        });
    </script>
</div>
