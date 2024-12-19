<div class="container mt-5">
    <h2 class="mb-4">Metodos de pago hoy</h2>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <canvas id="metodosPagoChart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('livewire:load', function() {
            const ctx = document.getElementById('metodosPagoChart').getContext('2d');
            const metodosPagoChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [
                        'Pago Móvil',
                        'Punto de Venta',
                        'Transferencias',
                        'Efectivo USD',
                        'Efectivo BS',
                        'Paypal',
                        'Zelle'
                    ],
                    datasets: [{
                        label: 'Montos por Método de Pago',
                        data: [
                            @this.montosPorMetodo.pagomovil,
                            @this.montosPorMetodo.punto_de_venta,
                            @this.montosPorMetodo.transferencias,
                            @this.montosPorMetodo.efectivousd,
                            @this.montosPorMetodo.efectivobs,
                            @this.montosPorMetodo.paypal,
                            @this.montosPorMetodo.zelle
                        ],
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
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

            Livewire.on('refreshChart', () => {
                metodosPagoChart.data.datasets[0].data = [
                    @this.montosPorMetodo.pagomovil,
                    @this.montosPorMetodo.punto_de_venta,
                    @this.montosPorMetodo.transferencias,
                    @this.montosPorMetodo.efectivousd,
                    @this.montosPorMetodo.efectivobs,
                    @this.montosPorMetodo.paypal,
                    @this.montosPorMetodo.zelle
                ];
                metodosPagoChart.update();
            });
        });
    </script>
</div>
