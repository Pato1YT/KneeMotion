<!-- <x-filament-widgets::widget>
    <x-filament::section>
    <div>
            <h3 class="text-lg font-semibold mb-4">📈 Evolución del ángulo en esta sesión</h3>

            {{-- Cargar Chart.js de forma segura --}}
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <div
                x-data="{
                    datos: @js($datos),
                    renderGrafica() {
                        const labels = this.datos.map(d => d.momento);
                        const data = this.datos.map(d => d.angulo);

                        new Chart(this.$refs.canvas.getContext('2d'), {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Ángulo (°)',
                                    data: data,
                                    borderColor: '#00bfa5',
                                    backgroundColor: 'rgba(0,191,165,0.2)',
                                    fill: true,
                                    tension: 0.3
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        max: 140
                                    }
                                }
                            }
                        });
                    }
                }"
                x-init="setTimeout(() => renderGrafica(), 300)" {{-- retrasa para evitar conflicto con render Livewire --}}
            >
                <canvas x-ref="canvas" class="w-full max-h-96"></canvas>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget> -->

<x-filament::widget>
    <x-filament::card>
        <div>
            <h3 class="text-lg font-semibold mb-4">📈 Evolución del ángulo en esta sesión</h3>

            <pre class="text-sm text-gray-400">@json($datos)</pre>

            {{-- Cargar Chart.js de forma segura --}}
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <div
                x-data="{
                    datos: @js($datos),
                    renderGrafica() {
                        const labels = this.datos.map(d => d.momento);
                        const data = this.datos.map(d => d.angulo);

                        new Chart(this.$refs.canvas.getContext('2d'), {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Ángulo (°)',
                                    data: data,
                                    borderColor: '#00bfa5',
                                    backgroundColor: 'rgba(0,191,165,0.2)',
                                    fill: true,
                                    tension: 0.3
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        max: 140
                                    }
                                }
                            }
                        });
                    }
                }"
                x-init="setTimeout(() => renderGrafica(), 300)" {{-- retrasa para evitar conflicto con render Livewire --}}
            >
                <canvas x-ref="canvas" class="w-full max-h-96"></canvas>
            </div>
        </div>
    </x-filament::card>
</x-filament::widget>
