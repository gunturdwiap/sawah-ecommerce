<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Stats Cards -->
                    <section class="grid gap-4 md:grid-cols-4 mb-6">
                        <div class="shadow-md border border-l-4 border-l-blue-600 p-6 rounded-xl">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-semibold">Jumlah User</span>
                            </div>
                            <div class="text-5xl font-bold mt-2">{{ $totals['users'] }}</div>
                        </div>

                        <div class="shadow-md border border-l-4 border-l-yellow-500 p-6 rounded-xl">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-semibold">Jumlah Produk </span>
                            </div>
                            <div class="text-5xl font-bold mt-2">{{ $totals['products'] }}</div>
                        </div>

                        <div class="shadow-md border border-l-4 border-l-green-500 p-6 rounded-xl">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-semibold">Jumlah Kategori</span>
                            </div>
                            <div class="text-5xl font-bold mt-2">{{ $totals['categories'] }}</div>
                        </div>

                        <div class="shadow-md border border-l-4 border-l-red-600 p-6 rounded-xl">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-semibold">Jumlah Order </span>
                            </div>
                            <div class="text-5xl font-bold mt-2">{{ $totals['orders'] }}</div>
                        </div>
                    </section>

                    <!-- Charts and Quota -->
                    <section class="grid md:grid-cols-4 gap-4">
                        <!-- Chart -->
                        <div class="md:col-span-3 shadow-md border bg-white p-6 rounded-xl">
                            <h2 class="text-lg font-semibold mb-4">Laporan Bulanan </h2>
                            <div class="relative h-64">
                                <canvas id="barChart" class="w-full h-full"></canvas>
                            </div>
                        </div>

                        <!-- Kuota -->
                        <div class="bg-white p-6 rounded-xl shadow-md border">
                            <h2 class="text-lg font-semibold mb-4">Jumlah Produk</h2>
                            <div class="space-y-4">
                                <div>
                                    <div class="flex justify-between text-sm">
                                        <span>Produk A</span>
                                        <span>15 / 20</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-blue-500 h-2 rounded-full" style="width: 75%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between text-sm">
                                        <span>Produk B</span>
                                        <span>10 / 10</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-green-500 h-2 rounded-full" style="width: 100%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between text-sm">
                                        <span>Produk C</span>
                                        <span>5 / 20</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-yellow-500 h-2 rounded-full" style="width: 25%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>


                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    const ctx = document.getElementById('barChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: [
                                'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                            ],
                            datasets: [{
                                label: 'Jumlah Order',
                                data: [15, 20, 35, 40, 50, 55, 60, 50, 30, 25, 10, 5],
                                backgroundColor: '#2b7fff',
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { display: false }
                            },
                            scales: {
                                y: { beginAtZero: true }
                            }
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</x-app-layout>