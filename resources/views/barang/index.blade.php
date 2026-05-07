@extends('layouts.app')

@section('title', 'Pendataan Barang')

@section('content')
<div x-data="{ openModal: false, editMode: false, currentBarang: {id: '', nama: '', kategori: '', harga_beli: '', harga_jual: ''} }">
    <div class="flex justify-between items-center mb-8">
        <h3 class="text-2xl font-bold text-gray-800">Daftar Barang</h3>
        @if(Auth::user()->role === 'admin')
        <button @click="openModal = true; editMode = false; currentBarang = {id: '', nama: '', kategori: '', harga_beli: '', harga_jual: ''}" class="bg-mint-400 hover:bg-mint-500 text-gray-900 font-bold py-3 px-6 rounded-xl transition shadow-lg shadow-mint-100 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Tambah Barang
        </button>
        @endif
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-mint-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-mint-50 text-mint-800 text-sm uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-4 font-bold">Nama Barang</th>
                        <th class="px-6 py-4 font-bold">Kategori</th>
                        <th class="px-6 py-4 font-bold">Harga Beli</th>
                        <th class="px-6 py-4 font-bold">Harga Jual</th>
                        <th class="px-6 py-4 font-bold">Stok</th>
                        @if(Auth::user()->role === 'admin')
                        <th class="px-6 py-4 font-bold text-center">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-mint-50">
                    @foreach($barangs as $barang)
                    <tr class="hover:bg-mint-50/50 transition">
                        <td class="px-6 py-4 font-semibold text-gray-800">{{ $barang->nama }}</td>
                        <td class="px-6 py-4 text-gray-600"><span class="bg-mint-100 text-mint-700 px-3 py-1 rounded-full text-xs font-bold">{{ $barang->kategori }}</span></td>
                        <td class="px-6 py-4 text-gray-600">Rp {{ number_format($barang->harga_beli, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 font-bold text-mint-700">Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            <span class="font-bold {{ $barang->stok <= 5 ? 'text-red-500' : 'text-gray-800' }}">{{ $barang->stok }}</span>
                        </td>
                        @if(Auth::user()->role === 'admin')
                        <td class="px-6 py-4">
                            <div class="flex justify-center gap-3">
                                <button @click="editMode = true; openModal = true; currentBarang = {id: '{{ $barang->id }}', nama: '{{ $barang->nama }}', kategori: '{{ $barang->kategori }}', harga_beli: '{{ $barang->harga_beli }}', harga_jual: '{{ $barang->harga_jual }}'}" class="text-blue-500 hover:text-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" onsubmit="return confirm('Hapus barang ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Form -->
    <div x-show="openModal" class="fixed inset-0 z-50 flex items-center justify-center p-6 bg-black/50 backdrop-blur-sm" x-cloak x-transition>
        <div class="bg-white rounded-2xl w-full max-w-lg shadow-2xl overflow-hidden" @click.away="openModal = false">
            <div class="bg-mint-400 p-6">
                <h3 class="text-xl font-bold text-gray-900" x-text="editMode ? 'Edit Barang' : 'Tambah Barang Baru'"></h3>
            </div>
            <form :action="editMode ? '{{ url('admin/barang') }}/' + currentBarang.id : '{{ route('barang.store') }}'" method="POST" class="p-8 space-y-6">
                @csrf
                <template x-if="editMode">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Barang</label>
                    <input type="text" name="nama" x-model="currentBarang.nama" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-mint-400 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                    <input type="text" name="kategori" x-model="currentBarang.kategori" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-mint-400 outline-none transition">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Harga Beli</label>
                        <input type="number" name="harga_beli" x-model="currentBarang.harga_beli" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-mint-400 outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Harga Jual</label>
                        <input type="number" name="harga_jual" x-model="currentBarang.harga_jual" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-mint-400 outline-none transition">
                    </div>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="button" @click="openModal = false" class="flex-1 px-6 py-3 rounded-xl border border-gray-200 font-bold text-gray-600 hover:bg-gray-50 transition">Batal</button>
                    <button type="submit" class="flex-1 bg-mint-400 hover:bg-mint-500 text-gray-900 font-bold py-3 rounded-xl transition shadow-lg shadow-mint-100">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
