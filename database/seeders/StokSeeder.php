<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stok;
use App\Models\Barang;

class StokSeeder extends Seeder
{
    public function run(): void
    {
        $barangs = Barang::all();
        foreach ($barangs as $barang) {
            Stok::create([
                'barang_id' => $barang->id,
                'tipe' => 'masuk',
                'jumlah' => $barang->stok,
                'keterangan' => 'Stok awal sistem',
            ]);
        }
    }
}
