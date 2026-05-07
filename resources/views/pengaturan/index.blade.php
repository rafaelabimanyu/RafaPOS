@extends('layouts.app')

@section('title', 'Pengaturan Toko')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-mint-100 overflow-hidden">
        <div class="bg-mint-400 p-8 flex items-center gap-4">
            <div class="bg-white/20 p-3 rounded-xl backdrop-blur-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-900">Identitas Toko</h3>
                <p class="text-gray-800 text-sm">Informasi ini akan muncul pada struk belanja dan laporan.</p>
            </div>
        </div>

        <form action="{{ route('pengaturan.update') }}" method="POST" class="p-8 space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Toko</label>
                    <input type="text" name="nama_toko" value="{{ $pengaturan->nama_toko }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-mint-400 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">No. Telepon</label>
                    <input type="text" name="telepon" value="{{ $pengaturan->telepon }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-mint-400 outline-none transition">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Lengkap</label>
                <textarea name="alamat" rows="3" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-mint-400 outline-none transition">{{ $pengaturan->alamat }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan Footer Struk</label>
                <input type="text" name="footer_struk" value="{{ $pengaturan->footer_struk }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-mint-400 outline-none transition" placeholder="Contoh: Barang yang sudah dibeli tidak dapat ditukar.">
            </div>

            <div class="pt-4 border-t border-mint-50">
                <button type="submit" class="w-full bg-mint-400 hover:bg-mint-500 text-gray-900 font-bold py-4 rounded-xl transition shadow-lg shadow-mint-100 flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
