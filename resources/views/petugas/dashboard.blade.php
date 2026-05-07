@extends('layouts.app')

@section('title', 'Petugas Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-mint-100 relative overflow-hidden group">
        <div class="relative z-10">
            <p class="text-gray-500 font-medium mb-1">Penjualan Hari Ini</p>
            <h3 class="text-3xl font-bold text-gray-800">Rp {{ number_format($penjualan_hari_ini, 0, ',', '.') }}</h3>
        </div>
        <div class="absolute right-[-20px] bottom-[-20px] opacity-10 group-hover:opacity-20 transition text-mint-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
    </div>

    <div class="bg-white p-8 rounded-2xl shadow-sm border border-mint-100 relative overflow-hidden group">
        <div class="relative z-10">
            <p class="text-gray-500 font-medium mb-1">Jumlah Transaksi Hari Ini</p>
            <h3 class="text-3xl font-bold text-gray-800">{{ $jumlah_transaksi }} Transaksi</h3>
        </div>
        <div class="absolute right-[-20px] bottom-[-20px] opacity-10 group-hover:opacity-20 transition text-mint-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
            </svg>
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-mint-100 overflow-hidden">
    <div class="p-6 border-b border-mint-100 flex justify-between items-center text-mint-800">
        <h3 class="font-bold text-gray-800 text-lg">Transaksi Anda Terbaru</h3>
        <a href="{{ route('kasir.index') }}" class="bg-mint-400 hover:bg-mint-500 text-gray-900 px-4 py-2 rounded-lg text-sm font-bold transition">Buka Kasir</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-mint-50 text-mint-800 text-sm uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-4 font-bold">Kode</th>
                    <th class="px-6 py-4 font-bold">Total</th>
                    <th class="px-6 py-4 font-bold">Bayar</th>
                    <th class="px-6 py-4 font-bold">Waktu</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-mint-50">
                @forelse($recent_sales as $sale)
                <tr class="hover:bg-mint-50/50 transition">
                    <td class="px-6 py-4 font-semibold text-gray-800">{{ $sale->kode_transaksi }}</td>
                    <td class="px-6 py-4 font-bold text-mint-700">Rp {{ number_format($sale->total_harga, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-gray-600">Rp {{ number_format($sale->bayar, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-gray-500 text-sm">{{ $sale->created_at->diffForHumans() }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-10 text-center text-gray-400 italic">Belum ada transaksi hari ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
