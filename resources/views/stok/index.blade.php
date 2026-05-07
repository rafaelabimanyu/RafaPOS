@extends('layouts.app')

@section('title', 'Manajemen Stok')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Form Update Stok (Hanya Petugas atau Admin juga boleh?) User minta Petugas bisa update stok barang masuk -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl shadow-sm border border-mint-100 overflow-hidden sticky top-8">
            <div class="bg-mint-400 p-6">
                <h3 class="font-bold text-gray-900 text-lg">Catat Riwayat Stok</h3>
                <p class="text-xs text-gray-800 mt-1">Gunakan form ini untuk barang masuk atau penyesuaian stok.</p>
            </div>
            <form action="{{ Auth::user()->role === 'admin' ? '#' : route('petugas.stok.store') }}" method="POST" class="p-6 space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Barang</label>
                    <select name="barang_id" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-mint-400 outline-none transition">
                        <option value="">Pilih Barang</option>
                        @foreach($barangs as $barang)
                            <option value="{{ $barang->id }}">{{ $barang->nama }} (Stok: {{ $barang->stok }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tipe</label>
                    <div class="flex gap-4">
                        <label class="flex-1 cursor-pointer">
                            <input type="radio" name="tipe" value="masuk" checked class="hidden peer">
                            <div class="text-center py-2 rounded-lg border border-gray-200 peer-checked:bg-mint-100 peer-checked:border-mint-400 font-bold text-gray-600 peer-checked:text-mint-700">Masuk</div>
                        </label>
                        <label class="flex-1 cursor-pointer">
                            <input type="radio" name="tipe" value="keluar" class="hidden peer">
                            <div class="text-center py-2 rounded-lg border border-gray-200 peer-checked:bg-red-100 peer-checked:border-red-400 font-bold text-gray-600 peer-checked:text-red-700">Keluar</div>
                        </label>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah</label>
                    <input type="number" name="jumlah" required min="1" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-mint-400 outline-none transition" placeholder="0">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Keterangan</label>
                    <textarea name="keterangan" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-mint-400 outline-none transition" rows="3" placeholder="Contoh: Barang datang dari supplier"></textarea>
                </div>

                <button type="submit" class="w-full bg-mint-400 hover:bg-mint-500 text-gray-900 font-bold py-3 rounded-xl transition shadow-lg shadow-mint-100" {{ Auth::user()->role === 'admin' ? 'disabled' : '' }}>
                    {{ Auth::user()->role === 'admin' ? 'Admin Hanya Lihat History' : 'Simpan Riwayat' }}
                </button>
            </form>
        </div>
    </div>

    <!-- Riwayat Tabel -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-sm border border-mint-100 overflow-hidden">
            <div class="p-6 border-b border-mint-100">
                <h3 class="font-bold text-gray-800 text-lg">Riwayat Stok Terkini</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-mint-50 text-mint-800 text-sm uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-4 font-bold">Barang</th>
                            <th class="px-6 py-4 font-bold">Tipe</th>
                            <th class="px-6 py-4 font-bold">Jumlah</th>
                            <th class="px-6 py-4 font-bold">Keterangan</th>
                            <th class="px-6 py-4 font-bold">Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-mint-50">
                        @foreach($stoks as $stok)
                        <tr class="hover:bg-mint-50/50 transition">
                            <td class="px-6 py-4 font-semibold text-gray-800">{{ $stok->barang->nama }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $stok->tipe === 'masuk' ? 'bg-mint-100 text-mint-700' : 'bg-red-100 text-red-700' }}">
                                    {{ strtoupper($stok->tipe) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-bold {{ $stok->tipe === 'masuk' ? 'text-mint-700' : 'text-red-600' }}">
                                {{ $stok->tipe === 'masuk' ? '+' : '-' }}{{ $stok->jumlah }}
                            </td>
                            <td class="px-6 py-4 text-gray-500 text-sm">{{ $stok->keterangan ?? '-' }}</td>
                            <td class="px-6 py-4 text-gray-500 text-sm">{{ $stok->created_at->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
