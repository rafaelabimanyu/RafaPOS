@extends('layouts.app')

@section('title', 'Kasir - Transaksi Baru')

@section('content')
<div x-data="posSystem()" class="grid grid-cols-1 lg:grid-cols-3 gap-8 h-full">
    <!-- Daftar Barang -->
    <div class="lg:col-span-2 flex flex-col h-full overflow-hidden">
        <div class="bg-white p-4 rounded-t-2xl border border-mint-100 flex items-center gap-4">
            <div class="relative flex-1">
                <input type="text" x-model="search" placeholder="Cari nama barang atau kategori..." class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-mint-400 outline-none transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 absolute left-4 top-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
        <div class="bg-white border-x border-b border-mint-100 p-6 flex-1 overflow-y-auto rounded-b-2xl">
            <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                <template x-for="barang in filteredBarangs" :key="barang.id">
                    <div @click="addToCart(barang)" class="bg-mint-50/30 border border-mint-100 rounded-2xl p-4 cursor-pointer hover:shadow-lg hover:border-mint-400 transition group relative overflow-hidden">
                        <div class="mb-3">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-mint-600 bg-mint-100 px-2 py-0.5 rounded-full" x-text="barang.kategori"></span>
                        </div>
                        <h4 class="font-bold text-gray-800 text-lg mb-1" x-text="barang.nama"></h4>
                        <p class="text-mint-700 font-bold">Rp <span x-text="formatNumber(barang.harga_jual)"></span></p>
                        <p class="text-xs text-gray-400 mt-2">Stok: <span x-text="barang.stok"></span></p>
                        
                        <div class="absolute right-[-10px] bottom-[-10px] opacity-0 group-hover:opacity-100 transition transform translate-y-4 group-hover:translate-y-0">
                            <div class="bg-mint-400 p-4 rounded-tl-2xl">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <!-- Keranjang Belanja -->
    <div class="lg:col-span-1 flex flex-col h-full overflow-hidden">
        <div class="bg-white rounded-2xl shadow-sm border border-mint-100 flex flex-col h-full overflow-hidden">
            <div class="p-6 border-b border-mint-100">
                <h3 class="font-bold text-gray-800 text-lg">Keranjang Belanja</h3>
            </div>
            
            <div class="flex-1 overflow-y-auto p-6 space-y-4">
                <template x-for="(item, index) in cart" :key="item.id">
                    <div class="flex items-center justify-between gap-4 bg-gray-50 p-4 rounded-xl">
                        <div class="flex-1">
                            <h5 class="font-bold text-gray-800 text-sm" x-text="item.nama"></h5>
                            <p class="text-xs text-gray-500">@ Rp <span x-text="formatNumber(item.harga)"></span></p>
                        </div>
                        <div class="flex items-center gap-2">
                            <button @click="decreaseQty(index)" class="w-6 h-6 rounded-full bg-white border border-gray-200 flex items-center justify-center hover:bg-red-50 hover:text-red-500">-</button>
                            <span class="font-bold text-sm w-4 text-center" x-text="item.jumlah"></span>
                            <button @click="increaseQty(index)" class="w-6 h-6 rounded-full bg-white border border-gray-200 flex items-center justify-center hover:bg-mint-50 hover:text-mint-600">+</button>
                        </div>
                        <div class="text-right min-w-[80px]">
                            <p class="font-bold text-gray-800 text-sm">Rp <span x-text="formatNumber(item.harga * item.jumlah)"></span></p>
                        </div>
                    </div>
                </template>
                <div x-show="cart.length === 0" class="h-full flex flex-col items-center justify-center text-gray-400 py-20 italic">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4 opacity-20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    Keranjang Kosong
                </div>
            </div>

            <div class="p-6 bg-mint-50/50 border-t border-mint-100 space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Total Harga</span>
                    <span class="text-2xl font-black text-gray-900">Rp <span x-text="formatNumber(totalPrice)"></span></span>
                </div>
                
                <form action="{{ route('kasir.process') }}" method="POST">
                    @csrf
                    <template x-for="(item, index) in cart" :key="item.id">
                        <div>
                            <input type="hidden" :name="'items['+index+'][id]'" :value="item.id">
                            <input type="hidden" :name="'items['+index+'][jumlah]'" :value="item.jumlah">
                            <input type="hidden" :name="'items['+index+'][harga]'" :value="item.harga">
                        </div>
                    </template>
                    <input type="hidden" name="total_harga" :value="totalPrice">

                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Bayar</label>
                        <div class="relative">
                            <span class="absolute left-4 top-3 text-gray-400 font-bold text-sm">Rp</span>
                            <input type="number" name="bayar" x-model="bayar" required class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-mint-400 outline-none transition font-bold text-lg" placeholder="0">
                        </div>
                    </div>

                    <div class="flex justify-between items-center mb-6" x-show="bayar >= totalPrice">
                        <span class="text-gray-600">Kembalian</span>
                        <span class="text-lg font-bold text-mint-700">Rp <span x-text="formatNumber(bayar - totalPrice)"></span></span>
                    </div>

                    <button type="submit" :disabled="cart.length === 0 || bayar < totalPrice" class="w-full bg-mint-400 hover:bg-mint-500 disabled:opacity-50 disabled:cursor-not-allowed text-gray-900 font-black py-4 rounded-xl transition shadow-lg shadow-mint-100 text-lg uppercase tracking-widest">
                        Proses Pembayaran
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function posSystem() {
        return {
            search: '',
            barangs: @json($barangs),
            cart: [],
            bayar: 0,
            get filteredBarangs() {
                if (this.search === '') return this.barangs;
                return this.barangs.filter(b => 
                    b.nama.toLowerCase().includes(this.search.toLowerCase()) || 
                    b.kategori.toLowerCase().includes(this.search.toLowerCase())
                );
            },
            get totalPrice() {
                return this.cart.reduce((sum, item) => sum + (item.harga * item.jumlah), 0);
            },
            addToCart(barang) {
                const existing = this.cart.find(item => item.id === barang.id);
                if (existing) {
                    if (existing.jumlah < barang.stok) {
                        existing.jumlah++;
                    } else {
                        alert('Stok tidak mencukupi!');
                    }
                } else {
                    this.cart.push({
                        id: barang.id,
                        nama: barang.nama,
                        harga: barang.harga_jual,
                        jumlah: 1
                    });
                }
            },
            increaseQty(index) {
                const item = this.cart[index];
                const originalBarang = this.barangs.find(b => b.id === item.id);
                if (item.jumlah < originalBarang.stok) {
                    item.jumlah++;
                } else {
                    alert('Stok tidak mencukupi!');
                }
            },
            decreaseQty(index) {
                if (this.cart[index].jumlah > 1) {
                    this.cart[index].jumlah--;
                } else {
                    this.cart.splice(index, 1);
                }
            },
            formatNumber(num) {
                return new Intl.NumberFormat('id-ID').format(num);
            }
        }
    }
</script>
@endsection
