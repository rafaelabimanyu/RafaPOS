@extends('layouts.app')

@section('title', 'Manajemen Kategori')

@section('content')
<div x-data="{ openModal: false, editMode: false, currentKategori: {id: '', nama: ''} }">
    <div class="flex justify-between items-center mb-8">
        <h3 class="text-2xl font-bold text-gray-800">Daftar Kategori</h3>
        <button @click="openModal = true; editMode = false; currentKategori = {id: '', nama: ''}" class="bg-mint-400 hover:bg-mint-500 text-gray-900 font-bold py-3 px-6 rounded-xl transition shadow-lg shadow-mint-100 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Tambah Kategori
        </button>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-mint-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-mint-50 text-mint-800 text-sm uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-4 font-bold">Nama Kategori</th>
                        <th class="px-6 py-4 font-bold">Jumlah Barang</th>
                        <th class="px-6 py-4 font-bold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-mint-50">
                    @foreach($kategoris as $k)
                    <tr class="hover:bg-mint-50/50 transition">
                        <td class="px-6 py-4 font-semibold text-gray-800">{{ $k->nama }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $k->barangs->count() }} Item</td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center gap-3">
                                <button @click="editMode = true; openModal = true; currentKategori = {id: '{{ $k->id }}', nama: '{{ $k->nama }}'}" class="text-blue-500 hover:text-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <button @click="
                                    Swal.fire({
                                        title: 'Hapus Kategori?',
                                        text: 'Aksi ini tidak dapat dibatalkan!',
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#f87171',
                                        cancelButtonColor: '#7ed9b1',
                                        confirmButtonText: 'Ya, Hapus!',
                                        cancelButtonText: 'Batal'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            $refs['deleteForm' + {{ $k->id }}].submit();
                                        }
                                    })
                                " class="text-red-500 hover:text-red-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                                <form x-ref="deleteForm{{ $k->id }}" action="{{ route('kategori.destroy', $k->id) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
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
                <h3 class="text-xl font-bold text-gray-900" x-text="editMode ? 'Edit Kategori' : 'Tambah Kategori Baru'"></h3>
            </div>
            <form :action="editMode ? '{{ url('admin/kategori') }}/' + currentKategori.id : '{{ route('kategori.store') }}'" method="POST" class="p-8 space-y-6">
                @csrf
                <template x-if="editMode">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Kategori</label>
                    <input type="text" name="nama" x-model="currentKategori.nama" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-mint-400 outline-none transition" placeholder="Contoh: Makanan, Minuman, dsb.">
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
