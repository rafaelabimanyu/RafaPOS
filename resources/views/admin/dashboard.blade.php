@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-mint-100 relative overflow-hidden group">
        <div class="relative z-10">
            <p class="text-gray-500 font-medium mb-1">Total Pendapatan</p>
            <h3 class="text-3xl font-bold text-gray-800">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</h3>
        </div>
        <div class="absolute right-[-20px] bottom-[-20px] opacity-10 group-hover:opacity-20 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
    </div>

    <div class="bg-white p-8 rounded-2xl shadow-sm border border-mint-100 relative overflow-hidden group">
        <div class="relative z-10">
            <p class="text-gray-500 font-medium mb-1">Jumlah Barang</p>
            <h3 class="text-3xl font-bold text-gray-800">{{ $jumlah_barang }} Item</h3>
        </div>
        <div class="absolute right-[-20px] bottom-[-20px] opacity-10 group-hover:opacity-20 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
        </div>
    </div>

    <div class="bg-white p-8 rounded-2xl shadow-sm border border-mint-100 relative overflow-hidden group">
        <div class="relative z-10">
            <p class="text-gray-500 font-medium mb-1">Total Petugas</p>
            <h3 class="text-3xl font-bold text-gray-800">{{ $total_petugas }} Orang</h3>
        </div>
        <div class="absolute right-[-20px] bottom-[-20px] opacity-10 group-hover:opacity-20 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-mint-100 overflow-hidden">
    <div class="p-6 border-b border-mint-100 flex justify-between items-center">
        <h3 class="font-bold text-gray-800 text-lg">Transaksi Terbaru</h3>
        <a href="#" class="text-mint-700 font-semibold text-sm hover:underline">Lihat Semua</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-mint-50 text-mint-800 text-sm uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-4 font-bold">Kode</th>
                    <th class="px-6 py-4 font-bold">Petugas</th>
                    <th class="px-6 py-4 font-bold">Total</th>
                    <th class="px-6 py-4 font-bold">Waktu</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-mint-50">
                @foreach($recent_sales as $sale)
                <tr class="hover:bg-mint-50/50 transition">
                    <td class="px-6 py-4 font-semibold text-gray-800">{{ $sale->kode_transaksi }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $sale->user->name }}</td>
                    <td class="px-6 py-4 font-bold text-mint-700">Rp {{ number_format($sale->total_harga, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-gray-500 text-sm">{{ $sale->created_at->diffForHumans() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
