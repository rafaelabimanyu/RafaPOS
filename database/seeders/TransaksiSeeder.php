<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Barang;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        $petugas = User::where('role', 'petugas')->get();
        $barangs = Barang::all();

        for ($i = 0; $i < 60; $i++) {
            $user = $petugas->random();
            $total = 0;
            
            // Random date within last 7 days
            $createdAt = Carbon::now()->subDays(rand(0, 6))->subHours(rand(0, 23))->subMinutes(rand(0, 59));

            $transaksi = Transaksi::create([
                'user_id' => $user->id,
                'kode_transaksi' => 'TRX-' . strtoupper(Str::random(8)),
                'total_harga' => 0, 
                'diskon' => 0,
                'total_akhir' => 0,
                'bayar' => 0,
                'kembalian' => 0,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);

            $numItems = rand(1, 4);
            for ($j = 0; $j < $numItems; $j++) {
                $barang = $barangs->random();
                $qty = rand(1, 3);
                $subtotal = $barang->harga_jual * $qty;
                $total += $subtotal;

                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'barang_id' => $barang->id,
                    'jumlah' => $qty,
                    'harga_satuan' => $barang->harga_jual,
                    'subtotal' => $subtotal,
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ]);
            }

            $diskon = (rand(0, 10) > 8) ? (rand(1, 5) * 1000) : 0; // 20% chance of discount
            $totalAkhir = $total - $diskon;
            $bayar = ceil($totalAkhir / 5000) * 5000;

            $transaksi->update([
                'total_harga' => $total,
                'diskon' => $diskon,
                'total_akhir' => $totalAkhir,
                'bayar' => $bayar,
                'kembalian' => $bayar - $totalAkhir,
            ]);
        }
    }
}
