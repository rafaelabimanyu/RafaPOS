@extends('layouts.app')

@section('title', 'Laporan Penjualan & Analitik')

@section('content')
<div class="space-y-8">
    <div class="flex justify-between items-center">
        <h3 class="text-2xl font-bold text-gray-800">Analitik Penjualan</h3>
        <div class="flex gap-4">
            <a href="{{ route('laporan.export') }}" class="bg-white border border-mint-200 text-mint-700 font-bold py-3 px-6 rounded-xl transition hover:bg-mint-50 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Export Excel (CSV)
            </a>
            <a href="{{ route('laporan.print') }}" target="_blank" class="bg-mint-400 hover:bg-mint-500 text-gray-900 font-bold py-3 px-6 rounded-xl transition shadow-lg shadow-mint-100 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Cetak Laporan
            </a>
        </div>
    </div>

    <!-- Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-mint-100">
            <h4 class="font-bold text-gray-800 mb-6">Tren Pendapatan (7 Hari Terakhir)</h4>
            <canvas id="revenueChart" height="250"></canvas>
        </div>
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-mint-100">
            <h4 class="font-bold text-gray-800 mb-6">5 Barang Paling Laris</h4>
            <canvas id="topBarangsChart" height="250"></canvas>
        </div>
    </div>

    <!-- Recent Transactions Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-mint-100 overflow-hidden">
        <div class="p-6 border-b border-mint-100">
            <h3 class="font-bold text-gray-800 text-lg">Riwayat Transaksi Terkini</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-mint-50 text-mint-800 text-sm uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-4 font-bold">Kode</th>
                        <th class="px-6 py-4 font-bold">Petugas</th>
                        <th class="px-6 py-4 font-bold">Total Harga</th>
                        <th class="px-6 py-4 font-bold">Diskon</th>
                        <th class="px-6 py-4 font-bold">Total Akhir</th>
                        <th class="px-6 py-4 font-bold">Waktu</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-mint-50">
                    @foreach($transaksis as $t)
                    <tr class="hover:bg-mint-50/50 transition">
                        <td class="px-6 py-4 font-semibold text-gray-800">{{ $t->kode_transaksi }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $t->user->name }}</td>
                        <td class="px-6 py-4 text-gray-500">Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-red-500 font-medium">-Rp {{ number_format($t->diskon, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 font-bold text-mint-700">Rp {{ number_format($t->total_akhir, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-gray-400 text-sm">{{ $t->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Revenue Trend Chart
        const revCtx = document.getElementById('revenueChart').getContext('2d');
        new Chart(revCtx, {
            type: 'line',
            data: {
                labels: @json($revenueTrend->map(fn($d) => date('d M', strtotime($d->date)))),
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: @json($revenueTrend->pluck('total')),
                    borderColor: '#7ed9b1',
                    backgroundColor: 'rgba(126, 217, 177, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#7ed9b1'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: { 
                        beginAtZero: true,
                        ticks: { callback: (value) => 'Rp ' + value.toLocaleString() }
                    }
                }
            }
        });

        // Top Barangs Chart
        const topCtx = document.getElementById('topBarangsChart').getContext('2d');
        new Chart(topCtx, {
            type: 'doughnut',
            data: {
                labels: @json($topBarangs->pluck('nama')),
                datasets: [{
                    data: @json($topBarangs->pluck('total_qty')),
                    backgroundColor: [
                        '#7ed9b1', '#aaf0d1', '#c6f6d5', '#e0fff0', '#f0fff4'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });
    });
</script>
@endsection
