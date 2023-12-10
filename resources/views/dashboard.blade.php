<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="p-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-950">
                <canvas id="graficoCadastroUsuario" height="80px"></canvas>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('graficoCadastroUsuario').getContext('2d');

        var meuGrafico = new Chart(ctx, {
            type: 'line',
            data: {
                datasets: [{
                    label: 'Cadastros de Usuários',
                    data: @json($dadosGrafico),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {}
        });
    });
</script>
