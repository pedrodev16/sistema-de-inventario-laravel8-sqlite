<div class="container mt-5">
    <h2>Estadísticas de Ventas por Día y Método de Pago</h2>

    <div class="row">
        <div class="col-12">
            <div class="mt-3">
                <div class="card">
                    <div class="card-body" style="border: solid 2px #41c950;
    border-radius: 32px;">
                        <canvas id="chartVentasPorDiaMetodo"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('livewire:load', function() {
            var ctxMetodo = document.getElementById('chartVentasPorDiaMetodo').getContext('2d');

            var ventasPorDiaMetodo = @json($ventasPorDiaMetodo);

            var etiquetas = Object.keys(ventasPorDiaMetodo);
            var metodosPago = ['tarjeta', 'paypal', 'transferencia', 'efectivo'];

            var coloresMetodo = {
                'tarjeta': 'rgba(54, 162, 235, 1)',
                'paypal': 'rgba(75, 192, 192, 1)',
                'transferencia': 'rgba(255, 206, 86, 1)',
                'efectivo': 'rgba(153, 102, 255, 1)'
            };

            var backgroundColoresMetodo = {
                'tarjeta': 'rgba(54, 162, 235, 0.2)',
                'paypal': 'rgba(75, 192, 192, 0.2)',
                'transferencia': 'rgba(255, 206, 86, 0.2)',
                'efectivo': 'rgba(153, 102, 255, 0.2)'
            };

            var datasetsMetodo = metodosPago.map(function(metodo) {
                return {
                    label: 'Ventas por ' + metodo.charAt(0).toUpperCase() + metodo.slice(1),
                    data: etiquetas.map(function(dia) {
                        return ventasPorDiaMetodo[dia][metodo] || 0;
                    }),
                    borderColor: coloresMetodo[metodo],
                    backgroundColor: backgroundColoresMetodo[metodo],
                    borderWidth: 2,
                    fill: false,
                };
            });

            new Chart(ctxMetodo, {
                type: 'line',
                data: {
                    labels: etiquetas,
                    datasets: datasetsMetodo
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
