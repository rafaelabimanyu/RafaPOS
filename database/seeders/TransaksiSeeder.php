<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Barang;
use App\Models\User;
use Illuminate\Support\Str;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        $petugas = User::where('role', 'petugas')->get();
        $barangs = Barang::all();

        for ($i = 0; $i < 10; $i++) {
            $user = $petugas->random();
            $total = 0;
            
            $transaksi = Transaksi::create([
                'user_id' => $user->id,
                'kode_transaksi' => 'TRX-' . strtoupper(Str::random(8)),
                'total_harga' => 0, // update later
                'bayar' => 0,
                'kembalian' => 0,
            ]);

            $numItems = rand(1, 3);
            for ($j = 0; $j < $numItems; $j++) {
                $barang = $barangs->random();
                $qty = rand(1, 2);
                $subtotal = $barang->harga_jual * $qty;
                $total += $subtotal;

                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'barang_id' => $barang->id,
                    'jumlah' => $qty,
                    'harga_satuan' => $barang->harga_jual,
                    'subtotal' => $subtotal,
                ]);
            }

            $bayar = ceil($total / 5000) * 5000; // round up to nearest 5000
            $transaksi->update([
                'total_harga' => $total,
                'bayar' => $bayar,
                'kembalian' => $bayar - $total,
            ]);
        }
    }
}
